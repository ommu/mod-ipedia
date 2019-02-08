<?php
/**
 * IpediaCompanies
 * 
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 7 February 2019, 19:54 WIB
 * @modified date 8 February 2019, 10:53 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "ommu_ipedia_companies".
 *
 * The followings are the available columns in table "ommu_ipedia_companies":
 * @property integer $company_id
 * @property integer $publish
 * @property integer $member_id
 * @property string $company_name
 * @property string $creation_date
 * @property integer $creation_id
 * @property string $modified_date
 * @property integer $modified_id
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property Members $member
 * @property IpediaCompanyIndustry[] $industries
 * @property IpediaUniversities[] $universities
 * @property Users $creation
 * @property Users $modified
 *
 */

namespace ommu\ipedia\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use ommu\users\models\Users;
use ommu\member\models\Members;

class IpediaCompanies extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $memberDisplayname;
	public $creationDisplayname;
	public $modifiedDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_ipedia_companies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['member_id', 'company_name'], 'required'],
			[['publish', 'member_id', 'creation_id', 'modified_id'], 'integer'],
			[['company_name'], 'string'],
			[['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['member_id' => 'member_id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'company_id' => Yii::t('app', 'Company'),
			'publish' => Yii::t('app', 'Publish'),
			'member_id' => Yii::t('app', 'Member'),
			'company_name' => Yii::t('app', 'Company Name'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'modified_date' => Yii::t('app', 'Modified Date'),
			'modified_id' => Yii::t('app', 'Modified'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'industries' => Yii::t('app', 'Industries'),
			'universities' => Yii::t('app', 'Universities'),
			'memberDisplayname' => Yii::t('app', 'Member'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
			'modifiedDisplayname' => Yii::t('app', 'Modified'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMember()
	{
		return $this->hasOne(Members::className(), ['member_id' => 'member_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIndustries($count=true, $publish=1)
	{
		if($count == true) {
			$model = IpediaCompanyIndustry::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(IpediaCompanyIndustry::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', IpediaCompanyIndustry::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUniversities($count=true, $publish=1)
	{
		if($count == true) {
			$model = IpediaUniversities::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(IpediaUniversities::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', IpediaUniversities::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreation()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'creation_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getModified()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'modified_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\query\IpediaCompanies the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\ipedia\models\query\IpediaCompanies(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
		parent::init();

		$this->templateColumns['_no'] = [
			'header' => Yii::t('app', 'No'),
			'class'  => 'yii\grid\SerialColumn',
			'contentOptions' => ['class'=>'center'],
		];
		if(!Yii::$app->request->get('member')) {
			$this->templateColumns['memberDisplayname'] = [
				'attribute' => 'memberDisplayname',
				'value' => function($model, $key, $index, $column) {
					return isset($model->member) ? $model->member->displayname : '-';
				},
			];
		}
		$this->templateColumns['company_name'] = [
			'attribute' => 'company_name',
			'value' => function($model, $key, $index, $column) {
				return $model->company_name;
			},
		];
		$this->templateColumns['creation_date'] = [
			'attribute' => 'creation_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->creation_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'creation_date'),
		];
		if(!Yii::$app->request->get('creation')) {
			$this->templateColumns['creationDisplayname'] = [
				'attribute' => 'creationDisplayname',
				'value' => function($model, $key, $index, $column) {
					return isset($model->creation) ? $model->creation->displayname : '-';
				},
			];
		}
		$this->templateColumns['modified_date'] = [
			'attribute' => 'modified_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->modified_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'modified_date'),
		];
		if(!Yii::$app->request->get('modified')) {
			$this->templateColumns['modifiedDisplayname'] = [
				'attribute' => 'modifiedDisplayname',
				'value' => function($model, $key, $index, $column) {
					return isset($model->modified) ? $model->modified->displayname : '-';
				},
			];
		}
		$this->templateColumns['updated_date'] = [
			'attribute' => 'updated_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->updated_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'updated_date'),
		];
		$this->templateColumns['industries'] = [
			'attribute' => 'industries',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->industries, ['industry/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} industries', ['count'=>$model->industries])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['universities'] = [
			'attribute' => 'universities',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->universities, ['university/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} universities', ['count'=>$model->universities])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		if(!Yii::$app->request->get('trash')) {
			$this->templateColumns['publish'] = [
				'attribute' => 'publish',
				'filter' => $this->filterYesNo(),
				'value' => function($model, $key, $index, $column) {
					$url = Url::to(['publish', 'id'=>$model->primaryKey]);
					return $this->quickAction($url, $model->publish, '0=unpublish, 1=publish, 2=trash, 3=admin_checked');
				},
				'contentOptions' => ['class'=>'center'],
				'format' => 'raw',
			];
		}
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::find()
				->select([$column])
				->where(['company_id' => $id])
				->one();
			return $model->$column;
			
		} else {
			$model = self::findOne($id);
			return $model;
		}
	}

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

		// $this->memberDisplayname = isset($this->member) ? $this->member->displayname : '-';
		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
		// $this->modifiedDisplayname = isset($this->modified) ? $this->modified->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
		if(parent::beforeValidate()) {
			if($this->isNewRecord) {
				if($this->creation_id == null)
					$this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			} else {
				if($this->modified_id == null)
					$this->modified_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
			}
		}
		return true;
	}
}
