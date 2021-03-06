<?php
/**
 * IpediaCompanies
 *
 * IpediaCompanies represents the model behind the search form about `ommu\ipedia\models\IpediaCompanies`.
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 12 February 2019, 11:28 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ommu\ipedia\models\IpediaCompanies as IpediaCompaniesModel;

class IpediaCompanies extends IpediaCompaniesModel
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['company_id', 'publish', 'member_id', 'creation_id', 'modified_id'], 'integer'],
			[['company_name', 'creation_date', 'modified_date', 'updated_date',
				'memberDisplayname', 'creationDisplayname', 'modifiedDisplayname', 'isMember', 'isUniversity'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Tambahkan fungsi beforeValidate ini pada model search untuk menumpuk validasi pd model induk. 
	 * dan "jangan" tambahkan parent::beforeValidate, cukup "return true" saja.
	 * maka validasi yg akan dipakai hanya pd model ini, semua script yg ditaruh di beforeValidate pada model induk
	 * tidak akan dijalankan.
	 */
	public function beforeValidate() {
		return true;
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params, $column=null)
	{
        if (!($column && is_array($column))) {
            $query = IpediaCompaniesModel::find()->alias('t');
        } else {
            $query = IpediaCompaniesModel::find()->alias('t')->select($column);
        }
		$query->joinWith([
			'member member', 
			'creation creation', 
			'modified modified', 
			'view view',
		]);

		$query->groupBy(['company_id']);

        // add conditions that should always apply here
		$dataParams = [
			'query' => $query,
		];
        // disable pagination agar data pada api tampil semua
        if (isset($params['pagination']) && $params['pagination'] == 0) {
            $dataParams['pagination'] = false;
        }
		$dataProvider = new ActiveDataProvider($dataParams);

		$attributes = array_keys($this->getTableSchema()->columns);
		$attributes['memberDisplayname'] = [
			'asc' => ['member.displayname' => SORT_ASC],
			'desc' => ['member.displayname' => SORT_DESC],
		];
		$attributes['creationDisplayname'] = [
			'asc' => ['creation.displayname' => SORT_ASC],
			'desc' => ['creation.displayname' => SORT_DESC],
		];
		$attributes['modifiedDisplayname'] = [
			'asc' => ['modified.displayname' => SORT_ASC],
			'desc' => ['modified.displayname' => SORT_DESC],
		];
		$attributes['isMember'] = [
			'asc' => ['view.member' => SORT_ASC],
			'desc' => ['view.member' => SORT_DESC],
		];
		$attributes['isUniversity'] = [
			'asc' => ['view.university' => SORT_ASC],
			'desc' => ['view.university' => SORT_DESC],
		];
		$attributes['industries'] = [
			'asc' => ['view.industries' => SORT_ASC],
			'desc' => ['view.industries' => SORT_DESC],
		];
		$dataProvider->setSort([
			'attributes' => $attributes,
			'defaultOrder' => ['company_id' => SORT_DESC],
		]);

		$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		// grid filtering conditions
		$query->andFilterWhere([
			't.company_id' => $this->company_id,
			't.member_id' => isset($params['member']) ? $params['member'] : $this->member_id,
			'cast(t.creation_date as date)' => $this->creation_date,
			't.creation_id' => isset($params['creation']) ? $params['creation'] : $this->creation_id,
			'cast(t.modified_date as date)' => $this->modified_date,
			't.modified_id' => isset($params['modified']) ? $params['modified'] : $this->modified_id,
			'cast(t.updated_date as date)' => $this->updated_date,
			'view.member' => $this->isMember,
			'view.university' => $this->isUniversity,
		]);

        if (isset($params['trash'])) {
            $query->andFilterWhere(['NOT IN', 't.publish', [0,1,3]]);
        } else {
            if (!isset($params['publish']) || (isset($params['publish']) && $params['publish'] == '')) {
                $query->andFilterWhere(['IN', 't.publish', [0,1,3]]);
            } else {
                $query->andFilterWhere(['t.publish' => $this->publish]);
            }
        }

		$query->andFilterWhere(['like', 't.company_name', $this->company_name])
			->andFilterWhere(['like', 'member.displayname', $this->memberDisplayname])
			->andFilterWhere(['like', 'creation.displayname', $this->creationDisplayname])
			->andFilterWhere(['like', 'modified.displayname', $this->modifiedDisplayname]);

		return $dataProvider;
	}
}
