<?php
/**
 * IpediaMajors
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 24 June 2019, 19:48 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "ommu_ipedia_majors".
 *
 * The followings are the available columns in table "ommu_ipedia_majors":
 * @property integer $major_id
 * @property integer $publish
 * @property integer $another_id
 * @property string $major_name
 * @property string $major_desc
 * @property string $creation_date
 * @property integer $creation_id
 * @property string $modified_date
 * @property integer $modified_id
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property IpediaIndustryMajor[] $industries
 * @property IpediaMajorGroupItem[] $groups
 * @property IpediaAnothers $another
 * @property IpediaUniversityMajor[] $universities
 * @property Users $creation
 * @property Users $modified
 *
 */

namespace ommu\ipedia\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use ommu\users\models\Users;

class IpediaMajors extends \app\components\ActiveRecord
{
	public $gridForbiddenColumn = [];

	public $anotherName;
	public $creationDisplayname;
	public $modifiedDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_ipedia_majors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['major_name'], 'required'],
			[['publish', 'another_id', 'creation_id', 'modified_id'], 'integer'],
			[['major_desc'], 'string'],
			[['another_id', 'major_desc'], 'safe'],
			[['major_name'], 'string', 'max' => 64],
			[['another_id'], 'exist', 'skipOnError' => true, 'targetClass' => IpediaAnothers::className(), 'targetAttribute' => ['another_id' => 'another_id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'major_id' => Yii::t('app', 'Major'),
			'publish' => Yii::t('app', 'Publish'),
			'another_id' => Yii::t('app', 'Another'),
			'major_name' => Yii::t('app', 'Major Name'),
			'major_desc' => Yii::t('app', 'Major Desc'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'modified_date' => Yii::t('app', 'Modified Date'),
			'modified_id' => Yii::t('app', 'Modified'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'industries' => Yii::t('app', 'Industries'),
			'groups' => Yii::t('app', 'Groups'),
			'universities' => Yii::t('app', 'Universities'),
			'anotherName' => Yii::t('app', 'Another'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
			'modifiedDisplayname' => Yii::t('app', 'Modified'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIndustries($count=false, $publish=1)
	{
		if($count == false)
			return $this->hasMany(IpediaIndustryMajor::className(), ['major_id' => 'major_id'])
			->alias('industries')
			->andOnCondition([sprintf('%s.publish', 'industries') => $publish]);

		$model = IpediaIndustryMajor::find()
			->alias('t')
			->where(['t.major_id' => $this->major_id]);
		if($publish == 0)
			$model->unpublish();
		elseif($publish == 1)
			$model->published();
		elseif($publish == 2)
			$model->deleted();
		$industries = $model->count();

		return $industries ? $industries : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGroups($count=false)
	{
		if($count == false)
			return $this->hasMany(IpediaMajorGroupItem::className(), ['major_id' => 'major_id']);

		$model = IpediaMajorGroupItem::find()
			->alias('t')
			->where(['t.major_id' => $this->major_id]);
		$groups = $model->count();

		return $groups ? $groups : 0;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAnother()
	{
		return $this->hasOne(IpediaAnothers::className(), ['another_id' => 'another_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUniversities($count=false, $publish=1)
	{
		if($count == false)
			return $this->hasMany(IpediaUniversityMajor::className(), ['major_id' => 'major_id'])
			->alias('universities')
			->andOnCondition([sprintf('%s.publish', 'universities') => $publish]);

		$model = IpediaUniversityMajor::find()
			->alias('t')
			->where(['t.major_id' => $this->major_id]);
		if($publish == 0)
			$model->unpublish();
		elseif($publish == 1)
			$model->published();
		elseif($publish == 2)
			$model->deleted();
		$universities = $model->count();

		return $universities ? $universities : 0;
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
	 * @return \ommu\ipedia\models\query\IpediaMajors the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\ipedia\models\query\IpediaMajors(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
		parent::init();

		if(!(Yii::$app instanceof \app\components\Application))
			return;

		if(!$this->hasMethod('search'))
			return;

		$this->templateColumns['_no'] = [
			'header' => '#',
			'class' => 'yii\grid\SerialColumn',
			'contentOptions' => ['class'=>'center'],
		];
		if(!Yii::$app->request->get('another')) {
			$this->templateColumns['anotherName'] = [
				'attribute' => 'anotherName',
				'value' => function($model, $key, $index, $column) {
					return isset($model->another) ? $model->another->another_name : '-';
					// return $model->anotherName;
				},
			];
		}
		$this->templateColumns['major_name'] = [
			'attribute' => 'major_name',
			'value' => function($model, $key, $index, $column) {
				return $model->major_name;
			},
		];
		$this->templateColumns['major_desc'] = [
			'attribute' => 'major_desc',
			'value' => function($model, $key, $index, $column) {
				return $model->major_desc;
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
				return Html::a($industries, ['o/industry/manage', 'major'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} industries', ['count'=>$industries])]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['groups'] = [
			'attribute' => 'groups',
			'value' => function($model, $key, $index, $column) {
				$groups = $model->getGroups(true);
				return Html::a($groups, ['o/major-group/manage', 'major'=>$model->primaryKey], ['title'=>Yii::t('app', '{count} groups', ['count'=>$groups])]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		$this->templateColumns['universities'] = [
			'attribute' => 'universities',
			'value' => function($model, $key, $index, $column) {
				$universities = $model->getUniversities(true);
				return Html::a($universities, ['o/university/manage', 'major'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} universities', ['count'=>$universities])]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'center'],
			'format' => 'html',
		];
		if(!Yii::$app->request->get('trash')) {
			$this->templateColumns['publish'] = [
				'attribute' => 'publish',
				'value' => function($model, $key, $index, $column) {
					$url = Url::to(['publish', 'id'=>$model->primaryKey]);
					return $this->quickAction($url, $model->publish, '"0=unpublish, 1=publish, 2=trash, 3=admin_checked"');
				},
				'filter' => $this->filterYesNo(),
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
			$model = $model->where(['major_id' => $id])->one();
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
			'2' => Yii::t('app', 'Trash'),
			'3' => Yii::t('app', 'Admin_checked'),
		);

		if($value !== null)
			return $items[$value];
		else
			return $items;
	}

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

		// $this->anotherName = isset($this->another) ? $this->another->another_name : '-';
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
