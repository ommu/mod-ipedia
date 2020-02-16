<?php
/**
 * IpediaMajorGroupItem
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 25 June 2019, 00:19 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "ommu_ipedia_major_group_item".
 *
 * The followings are the available columns in table "ommu_ipedia_major_group_item":
 * @property integer $id
 * @property integer $group_id
 * @property integer $major_id
 * @property string $creation_date
 * @property integer $creation_id
 *
 * The followings are the available model relations:
 * @property IpediaMajorGroup $group
 * @property IpediaMajors $major
 * @property Users $creation
 *
 */

namespace ommu\ipedia\models;

use Yii;
use ommu\users\models\Users;

class IpediaMajorGroupItem extends \app\components\ActiveRecord
{
	public $gridForbiddenColumn = [];

	public $groupName;
	public $majorName;
	public $creationDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_ipedia_major_group_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['group_id', 'major_id'], 'required'],
			[['group_id', 'major_id', 'creation_id'], 'integer'],
			[['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => IpediaMajorGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
			[['major_id'], 'exist', 'skipOnError' => true, 'targetClass' => IpediaMajors::className(), 'targetAttribute' => ['major_id' => 'major_id']],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'group_id' => Yii::t('app', 'Group'),
			'major_id' => Yii::t('app', 'Major'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'groupName' => Yii::t('app', 'Group'),
			'majorName' => Yii::t('app', 'Major'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGroup()
	{
		return $this->hasOne(IpediaMajorGroup::className(), ['id' => 'group_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMajor()
	{
		return $this->hasOne(IpediaMajors::className(), ['major_id' => 'major_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreation()
	{
		return $this->hasOne(Users::className(), ['user_id' => 'creation_id']);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\query\IpediaMajorGroupItem the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\ipedia\models\query\IpediaMajorGroupItem(get_called_class());
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
			'contentOptions' => ['class'=>'text-center'],
		];
		$this->templateColumns['group_id'] = [
			'attribute' => 'group_id',
			'value' => function($model, $key, $index, $column) {
				return isset($model->group) ? $model->group->group_name : '-';
				// return $model->groupName;
			},
			'filter' => IpediaMajorGroup::getGroup(),
			'visible' => !Yii::$app->request->get('group') ? true : false,
		];
		$this->templateColumns['majorName'] = [
			'attribute' => 'majorName',
			'value' => function($model, $key, $index, $column) {
				return isset($model->major) ? $model->major->major_name : '-';
				// return $model->majorName;
			},
			'visible' => !Yii::$app->request->get('major') ? true : false,
		];
		$this->templateColumns['creation_date'] = [
			'attribute' => 'creation_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->creation_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'creation_date'),
		];
		$this->templateColumns['creationDisplayname'] = [
			'attribute' => 'creationDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->creation) ? $model->creation->displayname : '-';
				// return $model->creationDisplayname;
			},
			'visible' => !Yii::$app->request->get('creation') ? true : false,
		];
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
			$model = $model->where(['id' => $id])->one();
			return is_array($column) ? $model : $model->$column;
			
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

		// $this->groupName = isset($this->group) ? $this->group->group_name : '-';
		// $this->majorName = isset($this->major) ? $this->major->major_name : '-';
		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
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
			}
		}
		return true;
	}
}
