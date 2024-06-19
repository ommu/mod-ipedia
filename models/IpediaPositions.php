<?php
/**
 * IpediaPositions
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 8 February 2019, 15:35 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "ommu_ipedia_positions".
 *
 * The followings are the available columns in table "ommu_ipedia_positions":
 * @property integer $position_id
 * @property integer $publish
 * @property string $position_name
 * @property string $position_desc
 * @property string $position_task
 * @property string $position_jobdesc
 * @property string $position_knowledge
 * @property string $creation_date
 * @property integer $creation_id
 * @property string $modified_date
 * @property integer $modified_id
 * @property string $updated_date
 *
 * The followings are the available model relations:
 * @property IpediaPositionSkill[] $skills
 * @property Users $creation
 * @property Users $modified
 *
 */

namespace ommu\ipedia\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Users;

class IpediaPositions extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	public $creationDisplayname;
	public $modifiedDisplayname;

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'ommu_ipedia_positions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['position_name', 'position_desc', 'position_task', 'position_jobdesc', 'position_knowledge'], 'required'],
			[['publish', 'creation_id', 'modified_id'], 'integer'],
			[['position_desc', 'position_task', 'position_jobdesc', 'position_knowledge'], 'string'],
			[['position_name'], 'string', 'max' => 64],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'position_id' => Yii::t('app', 'Position'),
			'publish' => Yii::t('app', 'Publish'),
			'position_name' => Yii::t('app', 'Position Name'),
			'position_desc' => Yii::t('app', 'Position Desc'),
			'position_task' => Yii::t('app', 'Position Task'),
			'position_jobdesc' => Yii::t('app', 'Position Jobdesc'),
			'position_knowledge' => Yii::t('app', 'Position Knowledge'),
			'creation_date' => Yii::t('app', 'Creation Date'),
			'creation_id' => Yii::t('app', 'Creation'),
			'modified_date' => Yii::t('app', 'Modified Date'),
			'modified_id' => Yii::t('app', 'Modified'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'skills' => Yii::t('app', 'Skills'),
			'creationDisplayname' => Yii::t('app', 'Creation'),
			'modifiedDisplayname' => Yii::t('app', 'Modified'),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSkills($count=false, $publish=1)
	{
        if ($count == false) {
            return $this->hasMany(IpediaPositionSkill::className(), ['position_id' => 'position_id'])
                ->alias('skills')
                ->andOnCondition([sprintf('%s.publish', 'skills') => $publish]);
        }

		$model = IpediaPositionSkill::find()
            ->alias('t')
            ->where(['t.position_id' => $this->position_id]);
        if ($publish == 0) {
            $model->unpublish();
        } else if ($publish == 1) {
            $model->published();
        } else if ($publish == 2) {
            $model->deleted();
        }

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
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\query\IpediaPositions the active query used by this AR class.
	 */
	public static function find()
	{
		return new \ommu\ipedia\models\query\IpediaPositions(get_called_class());
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
			'contentOptions' => ['class' => 'text-center'],
		];
		$this->templateColumns['position_name'] = [
			'attribute' => 'position_name',
			'value' => function($model, $key, $index, $column) {
				return $model->position_name;
			},
		];
		$this->templateColumns['position_desc'] = [
			'attribute' => 'position_desc',
			'value' => function($model, $key, $index, $column) {
				return $model->position_desc;
			},
		];
		$this->templateColumns['position_task'] = [
			'attribute' => 'position_task',
			'value' => function($model, $key, $index, $column) {
				return $model->position_task;
			},
		];
		$this->templateColumns['position_jobdesc'] = [
			'attribute' => 'position_jobdesc',
			'value' => function($model, $key, $index, $column) {
				return $model->position_jobdesc;
			},
		];
		$this->templateColumns['position_knowledge'] = [
			'attribute' => 'position_knowledge',
			'value' => function($model, $key, $index, $column) {
				return $model->position_knowledge;
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
		$this->templateColumns['modified_date'] = [
			'attribute' => 'modified_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->modified_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'modified_date'),
		];
		$this->templateColumns['modifiedDisplayname'] = [
			'attribute' => 'modifiedDisplayname',
			'value' => function($model, $key, $index, $column) {
				return isset($model->modified) ? $model->modified->displayname : '-';
				// return $model->modifiedDisplayname;
			},
			'visible' => !Yii::$app->request->get('modified') ? true : false,
		];
		$this->templateColumns['updated_date'] = [
			'attribute' => 'updated_date',
			'value' => function($model, $key, $index, $column) {
				return Yii::$app->formatter->asDatetime($model->updated_date, 'medium');
			},
			'filter' => $this->filterDatepicker($this, 'updated_date'),
		];
		$this->templateColumns['skills'] = [
			'attribute' => 'skills',
			'value' => function($model, $key, $index, $column) {
				$skills = $model->getSkills(true);
				return Html::a($skills, ['skill/manage', 'position' => $model->primaryKey, 'publish' => 1], ['title' => Yii::t('app', '{count} skills', ['count' => $skills])]);
			},
			'filter' => false,
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'html',
		];
		$this->templateColumns['publish'] = [
			'attribute' => 'publish',
			'value' => function($model, $key, $index, $column) {
				$url = Url::to(['publish', 'id' => $model->primaryKey]);
				return in_array($model->publish, [0,1]) ? $this->quickAction($url, $model->publish) : self::getPublish($model->publish);
			},
			'filter' => self::getPublish(),
			'contentOptions' => ['class' => 'text-center'],
			'format' => 'raw',
			'visible' => !Yii::$app->request->get('trash') ? true : false,
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
            $model = $model->where(['position_id' => $id])->one();
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

        if ($value !== null) {
            return $items[$value];
        } else {
            return $items;
        }
	}

	/**
	 * after find attributes
	 */
	public function afterFind()
	{
		parent::afterFind();

		// $this->creationDisplayname = isset($this->creation) ? $this->creation->displayname : '-';
		// $this->modifiedDisplayname = isset($this->modified) ? $this->modified->displayname : '-';
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
            } else {
                if ($this->modified_id == null) {
                    $this->modified_id = !Yii::$app->user->isGuest ? Yii::$app->user->id : null;
                }
            }
        }
        return true;
	}
}
