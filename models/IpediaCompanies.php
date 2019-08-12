<?php
/**
 * IpediaCompanies
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 7 February 2019, 19:54 WIB
 * @modified date 12 February 2019, 11:44 WIB
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
use ommu\ipedia\models\view\IpediaCompanies as IpediaCompaniesView;

class IpediaCompanies extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = ['modified_date', 'modifiedDisplayname', 'updated_date'];

	public $memberDisplayname;
	public $creationDisplayname;
	public $modifiedDisplayname;
	public $isMember;
	public $isUniversity;

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
			[['company_name'], 'required'],
			[['publish', 'member_id', 'creation_id', 'modified_id'], 'integer'],
			[['company_name'], 'string'],
			[['member_id'], 'safe'],
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
			'member_id' => Yii::t('app', 'Member ID'),
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
			'isMember' => Yii::t('app', 'Member'),
			'isUniversity' => Yii::t('app', 'University'),
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
	public function getIndustries($count=false, $publish=1)
	{
		if($count == false) {
			return $this->hasMany(IpediaCompanyIndustry::className(), ['company_id' => 'company_id'])
				->alias('industries')
				->andOnCondition([sprintf('%s.publish', 'industries') => $publish]);
		}

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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUniversities($count=false, $publish=1)
	{
		if($count == false) {
			return $this->hasMany(IpediaUniversities::className(), ['company_id' => 'company_id'])
				->alias('universities')
				->andOnCondition([sprintf('%s.publish', 'universities') => $publish]);
		}

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
	 * @return \yii\db\ActiveQuery
	 */
	public function getView()
	{
		return $this->hasOne(IpediaCompaniesView::className(), ['company_id' => 'company_id']);
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

		if(!(Yii::$app instanceof \app\components\Application))
			return;

		$this->templateColumns['_no'] = [
			'header' => Yii::t('app', 'No'),
			'class' => 'yii\grid\SerialColumn',
			'contentOptions' => ['class'=>'center'],
		];
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
					// return $model->creationDisplayname;
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
					// return $model->modifiedDisplayname;
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
			'value' => function($model, $key, $index, $column) {
				$industries = $model->getIndustries(true);
				return Html::a($industries, ['company-industry/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} industries', ['count'=>$industries])]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['isUniversity'] = [
			'attribute' => 'isUniversity',
			'value' => function($model, $key, $index, $column) {
				return $this->filterYesNo($model->isUniversity);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class'=>'center'],
		];
		$this->templateColumns['isMember'] = [
			'attribute' => 'isMember',
			'value' => function($model, $key, $index, $column) {
				return $this->filterYesNo($model->isMember);
			},
			'filter' => $this->filterYesNo(),
			'contentOptions' => ['class'=>'center'],
		];
		if(!Yii::$app->request->get('trash')) {
			$this->templateColumns['publish'] = [
				'attribute' => 'publish',
				'value' => function($model, $key, $index, $column) {
					$url = Url::to(['publish', 'id'=>$model->primaryKey]);
					return in_array($model->publish, [0,1]) ? $this->quickAction($url, $model->publish) : self::getPublish($model->publish);
				},
				'filter' => self::getPublish(),
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
			$model = self::find();
			if(is_array($column))
				$model->select($column);
			else
				$model->select([$column]);
			$model = $model->where(['company_id' => $id])->one();
			return is_array($column) ? $model : $model->$column;
			
		} else {
			$model = self::findOne($id);
			return $model;
		}
	}

	/**
	 * function getPublish
	 */
	public static function getPublish($value=null)
	{
		$items = array(
			'0' => Yii::t('app', 'Unpublish'),
			'1' => Yii::t('app', 'Publish'),
			// '2' => Yii::t('app', 'Trash'),
			'3' => Yii::t('app', 'Checked'),
		);

		if($value !== null)
			return $items[$value];
		else
			return $items;
	}

	/**
	 * User get information
	 */
	public function getIsMember($memberId)
	{
		return $memberId ? 1 : 0;
	}

	/**
	 * User get information
	 */
	public function getIsUniversity($universities)
	{
		return $universities ? 1 : 0;
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
		$this->isMember = $this->getIsMember($this->member_id);
		$this->isUniversity = $this->getIsUniversity($this->universities);
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
