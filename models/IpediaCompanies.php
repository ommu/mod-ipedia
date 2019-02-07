<?php
/**
 * IpediaCompanies
 * 
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 7 February 2019, 19:54 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "ommu_ipedia_companies".
 *
 * The followings are the available columns in table "ommu_ipedia_companies":
 * @property integer $company_id
 * @property integer $publish
 * @property integer $directory_id
 * @property integer $member_id
 * @property string $creation_date
 * @property integer $creation_id
 * @property string $modified_date
 * @property integer $modified_id
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property CvAchievements[] $achievements
 * @property CvExperiences[] $experiences
 * @property CvOrganizations[] $organizations
 * @property CvReferenceReferee[] $referees
 * @property CvTrainings[] $trainings
 * @property IpediaDirectories $directory
 * @property Members $member
 * @property IpediaCompanyIndustry[] $industries
 * @property IpediaUniversities[] $universities
 * @property MemberCompany[] $companies
 * @property Projects[] $projects
 * @property Users $creation
 * @property Users $modified
 *
 */

namespace ommu\ipedia\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use ommu\users\models\Users;

class IpediaCompanies extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $directoryName;
	public $memberUsername;
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
			[['directory_id', 'member_id'], 'required'],
			[['publish', 'directory_id', 'member_id', 'creation_id', 'modified_id'], 'integer'],
			[['directory_id'], 'exist', 'skipOnError' => true, 'targetClass' => IpediaDirectories::className(), 'targetAttribute' => ['directory_id' => 'directory_id']],
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
			'directory_id' => Yii::t('app', 'Directory'),
			'member_id' => Yii::t('app', 'Member'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'modified_date' => Yii::t('app', 'Modified Date'),
			'modified_id' => Yii::t('app', 'Modified'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'achievements' => Yii::t('app', 'Achievements'),
			'experiences' => Yii::t('app', 'Experiences'),
			'organizations' => Yii::t('app', 'Organizations'),
			'referees' => Yii::t('app', 'Referees'),
			'trainings' => Yii::t('app', 'Trainings'),
			'industries' => Yii::t('app', 'Industries'),
			'universities' => Yii::t('app', 'Universities'),
			'companies' => Yii::t('app', 'Companies'),
			'projects' => Yii::t('app', 'Projects'),
			'directoryName' => Yii::t('app', 'Directory'),
			'memberUsername' => Yii::t('app', 'Member'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
			'modifiedDisplayname' => Yii::t('app', 'Modified'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAchievements($count=true, $publish=1)
	{
		if($count == true) {
			$model = CvAchievements::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(CvAchievements::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', CvAchievements::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getExperiences($count=true, $publish=1)
	{
		if($count == true) {
			$model = CvExperiences::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(CvExperiences::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', CvExperiences::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrganizations($count=true, $publish=1)
	{
		if($count == true) {
			$model = CvOrganizations::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(CvOrganizations::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', CvOrganizations::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getReferees($count=true, $publish=1)
	{
		if($count == true) {
			$model = CvReferenceReferee::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(CvReferenceReferee::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', CvReferenceReferee::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTrainings($count=true, $publish=1)
	{
		if($count == true) {
			$model = CvTrainings::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(CvTrainings::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', CvTrainings::tableName()) => $publish]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDirectory()
	{
		return $this->hasOne(IpediaDirectories::className(), ['directory_id' => 'directory_id']);
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
	public function getCompanies($count=true)
	{
		if($count == true) {
			$model = MemberCompany::find()
				->where(['company_id' => $this->company_id]);

			return $model->count();
		}

		return $this->hasMany(MemberCompany::className(), ['company_id' => 'company_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProjects($count=true, $publish=1)
	{
		if($count == true) {
			$model = Projects::find()
				->where(['company_id' => $this->company_id]);
			if($publish == 0)
				$model->unpublish();
			elseif($publish == 1)
				$model->published();
			elseif($publish == 2)
				$model->deleted();

			return $model->count();
		}

		return $this->hasMany(Projects::className(), ['company_id' => 'company_id'])
			->andOnCondition([sprintf('%s.publish', Projects::tableName()) => $publish]);
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
		if(!Yii::$app->request->get('directory')) {
			$this->templateColumns['directoryName'] = [
				'attribute' => 'directoryName',
				'value' => function($model, $key, $index, $column) {
					return isset($model->directory) ? $model->directory->directory_name : '-';
				},
			];
		}
		if(!Yii::$app->request->get('member')) {
			$this->templateColumns['memberUsername'] = [
				'attribute' => 'memberUsername',
				'value' => function($model, $key, $index, $column) {
					return isset($model->member) ? $model->member->displayname : '-';
				},
			];
		}
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
		$this->templateColumns['achievements'] = [
			'attribute' => 'achievements',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->achievements, ['achievement/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} achievements', ['count'=>$model->achievements])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['experiences'] = [
			'attribute' => 'experiences',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->experiences, ['experience/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} experiences', ['count'=>$model->experiences])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['organizations'] = [
			'attribute' => 'organizations',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->organizations, ['organization/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} organizations', ['count'=>$model->organizations])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['referees'] = [
			'attribute' => 'referees',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->referees, ['referee/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} referees', ['count'=>$model->referees])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['trainings'] = [
			'attribute' => 'trainings',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->trainings, ['training/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} trainings', ['count'=>$model->trainings])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
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
		$this->templateColumns['companies'] = [
			'attribute' => 'companies',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->companies, ['company/manage', 'company'=>$model->primaryKey], ['title'=>Yii::t('app', '{count} companies', ['count'=>$model->companies])]);
			},
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['projects'] = [
			'attribute' => 'projects',
			'filter' => false,
			'value' => function($model, $key, $index, $column) {
				return Html::a($model->projects, ['project/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} projects', ['count'=>$model->projects])]);
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

		// $this->directoryName = isset($this->directory) ? $this->directory->directory_name : '-';
		// $this->memberUsername = isset($this->member) ? $this->member->displayname : '-';
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
