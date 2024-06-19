<?php
/**
 * IpediaUniversities
 *
 * IpediaUniversities represents the model behind the search form about `ommu\ipedia\models\IpediaUniversities`.
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 25 June 2019, 14:17 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ommu\ipedia\models\IpediaUniversities as IpediaUniversitiesModel;

class IpediaUniversities extends IpediaUniversitiesModel
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['university_id', 'publish', 'company_id', 'creation_id', 'modified_id'], 'integer'],
			[['education_type', 'creation_date', 'modified_date', 'updated_date', 'companyName', 'creationDisplayname', 'modifiedDisplayname'], 'safe'],
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
            $query = IpediaUniversitiesModel::find()->alias('t');
        } else {
            $query = IpediaUniversitiesModel::find()->alias('t')->select($column);
        }
		$query->joinWith([
			'company company', 
			'creation creation', 
			'modified modified'
		]);

		$query->groupBy(['university_id']);

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
		$attributes['companyName'] = [
			'asc' => ['company.company_name' => SORT_ASC],
			'desc' => ['company.company_name' => SORT_DESC],
		];
		$attributes['creationDisplayname'] = [
			'asc' => ['creation.displayname' => SORT_ASC],
			'desc' => ['creation.displayname' => SORT_DESC],
		];
		$attributes['modifiedDisplayname'] = [
			'asc' => ['modified.displayname' => SORT_ASC],
			'desc' => ['modified.displayname' => SORT_DESC],
		];
		$dataProvider->setSort([
			'attributes' => $attributes,
			'defaultOrder' => ['university_id' => SORT_DESC],
		]);

        if (Yii::$app->request->get('university_id')) {
            unset($params['university_id']);
        }
		$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		// grid filtering conditions
		$query->andFilterWhere([
			't.university_id' => $this->university_id,
			't.company_id' => isset($params['company']) ? $params['company'] : $this->company_id,
			'cast(t.creation_date as date)' => $this->creation_date,
			't.creation_id' => isset($params['creation']) ? $params['creation'] : $this->creation_id,
			'cast(t.modified_date as date)' => $this->modified_date,
			't.modified_id' => isset($params['modified']) ? $params['modified'] : $this->modified_id,
			'cast(t.updated_date as date)' => $this->updated_date,
		]);

        if (isset($params['trash'])) {
            $query->andFilterWhere(['NOT IN', 't.publish', [0,1]]);
        } else {
            if (!isset($params['publish']) || (isset($params['publish']) && $params['publish'] == '')) {
                $query->andFilterWhere(['IN', 't.publish', [0,1]]);
            } else {
                $query->andFilterWhere(['t.publish' => $this->publish]);
            }
        }

		$query->andFilterWhere(['like', 't.education_type', $this->education_type])
			->andFilterWhere(['like', 'company.company_name', $this->companyName])
			->andFilterWhere(['like', 'creation.displayname', $this->creationDisplayname])
			->andFilterWhere(['like', 'modified.displayname', $this->modifiedDisplayname]);

		return $dataProvider;
	}
}
