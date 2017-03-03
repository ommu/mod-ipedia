<?php
/**
 * ViewIpediaPositions
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:39 WIB
 * @link https://github.com/ommu/iPedia
 * @contact (+62)856-299-4114
 *
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 *
 * --------------------------------------------------------------------------------------
 *
 * This is the model class for table "_view_ipedia_positions".
 *
 * The followings are the available columns in table '_view_ipedia_positions':
 * @property string $position_id
 * @property string $position_name
 * @property string $position_desc
 * @property string $position_task
 * @property string $position_jobdesc
 * @property string $position_knowledge
 * @property string $skills
 * @property string $skill_all
 */
class ViewIpediaPositions extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewIpediaPositions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '_view_ipedia_positions';
	}

	/**
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'position_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position_name', 'required'),
			array('position_desc, position_task, position_jobdesc, position_knowledge', 'length', 'max'=>1),
			array('position_id', 'length', 'max'=>11),
			array('position_name', 'length', 'max'=>64),
			array('skills', 'length', 'max'=>23),
			array('skill_all', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('position_id, position_name, skills, skill_all', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'position_id' => Yii::t('attribute', 'Position'),
			'position_name' => Yii::t('attribute', 'Position Name'),
			'position_desc' => Yii::t('attribute', 'Position Desc'),
			'position_task' => Yii::t('attribute', 'Position Task'),
			'position_jobdesc' => Yii::t('attribute', 'Position Jobdesc'),
			'position_knowledge' => Yii::t('attribute', 'Position Knowledge'),
			'skills' => Yii::t('attribute', 'Skills'),
			'skill_all' => Yii::t('attribute', 'Skill All'),
		);
		/*
			'Position' => 'Position',
			'Position Name' => 'Position Name',
			'Skills' => 'Skills',
			'Skill All' => 'Skill All',
		
		*/
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.position_id',$this->position_id);
		$criteria->compare('t.position_name',strtolower($this->position_name),true);
		$criteria->compare('t.position_desc',$this->position_desc);
		$criteria->compare('t.position_task',$this->position_task);
		$criteria->compare('t.position_jobdesc',$this->position_jobdesc);
		$criteria->compare('t.position_knowledge',$this->position_knowledge);
		$criteria->compare('t.skills',$this->skills);
		$criteria->compare('t.skill_all',$this->skill_all);

		if(!isset($_GET['ViewIpediaPositions_sort']))
			$criteria->order = 't.position_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>30,
			),
		));
	}


	/**
	 * Get column for CGrid View
	 */
	public function getGridColumn($columns=null) {
		if($columns !== null) {
			foreach($columns as $val) {
				/*
				if(trim($val) == 'enabled') {
					$this->defaultColumns[] = array(
						'name'  => 'enabled',
						'value' => '$data->enabled == 1? "Ya": "Tidak"',
					);
				}
				*/
				$this->defaultColumns[] = $val;
			}
		} else {
			$this->defaultColumns[] = 'position_id';
			$this->defaultColumns[] = 'position_name';
			$this->defaultColumns[] = 'position_desc';
			$this->defaultColumns[] = 'position_task';
			$this->defaultColumns[] = 'position_jobdesc';
			$this->defaultColumns[] = 'position_knowledge';
			$this->defaultColumns[] = 'skills';
			$this->defaultColumns[] = 'skill_all';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			//$this->defaultColumns[] = 'position_id';
			$this->defaultColumns[] = 'position_name';
			$this->defaultColumns[] = 'position_desc';
			$this->defaultColumns[] = 'position_task';
			$this->defaultColumns[] = 'position_jobdesc';
			$this->defaultColumns[] = 'position_knowledge';
			$this->defaultColumns[] = 'skills';
			$this->defaultColumns[] = 'skill_all';
		}
		parent::afterConstruct();
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::model()->findByPk($id,array(
				'select' => $column
			));
			return $model->$column;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;			
		}
	}

}