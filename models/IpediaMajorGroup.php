<?php
/**
 * IpediaMajorGroup
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 24 June 2019, 23:26 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "ommu_ipedia_major_group".
 *
 * The followings are the available columns in table "ommu_ipedia_major_group":
 * @property integer $id
 * @property string $group_name
 * @property string $creation_date
 * @property integer $creation_id
 *
 * The followings are the available model relations:
 * @property IpediaMajorGroupItem[] $majors
 * @property Users $creation
 *
 */

namespace ommu\ipedia\models;

use Yii;
use yii\helpers\Html;
use app\models\Users;

class IpediaMajorGroup extends \app\components\ActiveRecord
{
	public $gridForbiddenColumn = [];

	public $creationDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_ipedia_major_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['group_name'], 'required'],
			[['creation_id'], 'integer'],
			[['group_name'], 'string', 'max' => 64],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'group_name' => Yii::t('app', 'Group Name'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'majors' => Yii::t('app', 'Majors'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMajors($count=false)
	{
        if ($count == false) {
            return $this->hasMany(IpediaMajorGroupItem::className(), ['group_id' => 'id']);
        }

		$model = IpediaMajorGroupItem::find()
            ->alias('t')
            ->where(['t.group_id' => $this->id]);
		$majors = $model->count();

		return $majors ? $majors : 0;
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
	 * @return \ommu\ipedia\models\query\IpediaMajorGroup the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\ipedia\models\query\IpediaMajorGroup(get_called_class());
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
		parent::init();

        if (!(Yii::$app instanceof \app\components\Application)) {
            return;
        }

        if (!$this->hasMethod('search')) {
            return;
        }

		$this->templateColumns['_no'] = [
			'header' => '#',
			'class' => 'app\components\grid\SerialColumn',
			'contentOptions' => ['class'=>'text-center'],
		];
		$this->templateColumns['group_name'] = [
			'attribute' => 'group_name',
			'value' => function($model, $key, $index, $column) {
				return $model->group_name;
			},
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
		$this->templateColumns['majors'] = [
			'attribute' => 'majors',
			'value' => function($model, $key, $index, $column) {
				$majors = $model->getMajors(true);
				return Html::a($majors, ['item/manage', 'group'=>$model->primaryKey], ['title'=>Yii::t('app', '{count} majors', ['count'=>$majors])]);
			},
			'filter' => false,
			'contentOptions' => ['class'=>'text-center'],
			'format' => 'html',
		];
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
        if ($column != null) {
            $model = self::find();
            if (is_array($column)) {
                $model->select($column);
            } else {
                $model->select([$column]);
            }
            $model = $model->where(['id' => $id])->one();
            return is_array($column) ? $model : $model->$column;

        } else {
            $model = self::findOne($id);
            return $model;
        }
	}

	/**
	 * function getGroup
	 */
	public static function getGroup($array=true)
	{
		$model = self::find()->alias('t')
			->select(['t.id', 't.group_name']);
		$model = $model->orderBy('t.group_name ASC')->all();

        if ($array == true) {
            return \yii\helpers\ArrayHelper::map($model, 'id', 'group_name');
        }

		return $model;
	}

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
	}

	/**
	 * before validate attributes
	 */
	public function beforeValidate()
	{
        if (parent::beforeValidate()) {
            if ($this->isNewRecord) {
                if ($this->creation_id == null) {
                    $this->creation_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            }
        }
        return true;
	}
}
