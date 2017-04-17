<?php
/**
 * IpediaPositions
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:34 WIB
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
 * This is the model class for table "ommu_ipedia_positions".
 *
 * The followings are the available columns in table 'ommu_ipedia_positions':
 * @property string $position_id
 * @property integer $publish
 * @property string $position_name
 * @property string $position_desc
 * @property string $position_task
 * @property string $position_jobdesc
 * @property string $position_knowledge
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuCvExperiences[] $ommuCvExperiences
 * @property OmmuCvReferenceReferee[] $ommuCvReferenceReferees
 * @property OmmuIpediaPositionSkill[] $ommuIpediaPositionSkills
 * @property OmmuVacancies[] $ommuVacancies
 */
class IpediaPositions extends CActiveRecord
{
	public $defaultColumns = array();
	public $position_skill_i;
	
	// Variable Search
	public $creation_search;
	public $modified_search;
	public $position_desc_search;
	public $position_task_search;
	public $position_jobdesc_search;
	public $position_knowledge_search;
	public $skill_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IpediaPositions the static model class
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
		return 'ommu_ipedia_positions';
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
			array('publish', 'numerical', 'integerOnly'=>true),
			array('position_name', 'length', 'max'=>64),
			array('creation_id, modified_id', 'length', 'max'=>11),
			array('position_desc, position_task, position_jobdesc, position_knowledge,
				position_skill_i', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('position_id, publish, position_name, position_desc, position_task, position_jobdesc, position_knowledge, creation_date, creation_id, modified_date, modified_id,
				creation_search, modified_search, position_desc_search, position_task_search, position_jobdesc_search, position_knowledge_search, skill_search', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'ViewIpediaPositions', 'position_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'skills' => array(self::HAS_MANY, 'IpediaPositionSkill', 'position_id'),
			'ommuCvExperiences_relation' => array(self::HAS_MANY, 'OmmuCvExperiences', 'position_id'),
			'ommuCvReferenceReferees_relation' => array(self::HAS_MANY, 'OmmuCvReferenceReferee', 'position_id'),
			'ommuVacancies_relation' => array(self::HAS_MANY, 'OmmuVacancies', 'position_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'position_id' => Yii::t('attribute', 'Position'),
			'publish' => Yii::t('attribute', 'Publish'),
			'position_name' => Yii::t('attribute', 'Position'),
			'position_desc' => Yii::t('attribute', 'Description'),
			'position_task' => Yii::t('attribute', 'Task'),
			'position_jobdesc' => Yii::t('attribute', 'Jobdesc'),
			'position_knowledge' => Yii::t('attribute', 'Knowledge'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'position_skill_i' => Yii::t('attribute', 'Skill'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
			'position_desc_search' => Yii::t('attribute', 'Description'),
			'position_task_search' => Yii::t('attribute', 'Task'),
			'position_jobdesc_search' => Yii::t('attribute', 'Jobdesc'),
			'position_knowledge_search' => Yii::t('attribute', 'Knowledge'),
			'skill_search' => Yii::t('attribute', 'Skill'),
		);
		/*
			'Position' => 'Position',
			'Publish' => 'Publish',
			'Position Name' => 'Position Name',
			'Position Desc' => 'Position Desc',
			'Position Task' => 'Position Task',
			'Position Jobdesc' => 'Position Jobdesc',
			'Position Knowledge' => 'Position Knowledge',
			'Creation Date' => 'Creation Date',
			'Creation' => 'Creation',
			'Modified Date' => 'Modified Date',
			'Modified' => 'Modified',
		
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
		
		// Custom Search
		$criteria->with = array(
			'view' => array(
				'alias'=>'view',
			),
			'creation' => array(
				'alias'=>'creation',
				'select'=>'displayname'
			),
			'modified' => array(
				'alias'=>'modified',
				'select'=>'displayname'
			),
		);

		$criteria->compare('t.position_id',$this->position_id);
		if(isset($_GET['type']) && $_GET['type'] == 'publish')
			$criteria->compare('t.publish',1);
		elseif(isset($_GET['type']) && $_GET['type'] == 'unpublish')
			$criteria->compare('t.publish',0);
		elseif(isset($_GET['type']) && $_GET['type'] == 'trash')
			$criteria->compare('t.publish',2);
		else {
			$criteria->addInCondition('t.publish',array(0,1));
			$criteria->compare('t.publish',$this->publish);
		}
		$criteria->compare('t.position_name',strtolower($this->position_name),true);
		$criteria->compare('t.position_desc',strtolower($this->position_desc),true);
		$criteria->compare('t.position_task',strtolower($this->position_task),true);
		$criteria->compare('t.position_jobdesc',strtolower($this->position_jobdesc),true);
		$criteria->compare('t.position_knowledge',strtolower($this->position_knowledge),true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.creation_date)',date('Y-m-d', strtotime($this->creation_date)));
		if(isset($_GET['creation']))
			$criteria->compare('t.creation_id',$_GET['creation']);
		else
			$criteria->compare('t.creation_id',$this->creation_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00', '0000-00-00')))
			$criteria->compare('date(t.modified_date)',date('Y-m-d', strtotime($this->modified_date)));
		if(isset($_GET['modified']))
			$criteria->compare('t.modified_id',$_GET['modified']);
		else
			$criteria->compare('t.modified_id',$this->modified_id);

		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);
		$criteria->compare('view.position_desc',$this->position_desc_search);
		$criteria->compare('view.position_task',$this->position_task_search);
		$criteria->compare('view.position_jobdesc',$this->position_jobdesc_search);
		$criteria->compare('view.position_knowledge',$this->position_knowledge_search);
		$criteria->compare('view.skills',$this->skill_search);		

		if(!isset($_GET['IpediaPositions_sort']))
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
			//$this->defaultColumns[] = 'position_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'position_name';
			$this->defaultColumns[] = 'position_desc';
			$this->defaultColumns[] = 'position_task';
			$this->defaultColumns[] = 'position_jobdesc';
			$this->defaultColumns[] = 'position_knowledge';
			$this->defaultColumns[] = 'creation_date';
			$this->defaultColumns[] = 'creation_id';
			$this->defaultColumns[] = 'modified_date';
			$this->defaultColumns[] = 'modified_id';
		}

		return $this->defaultColumns;
	}

	/**
	 * Set default columns to display
	 */
	protected function afterConstruct() {
		if(count($this->defaultColumns) == 0) {
			/*
			$this->defaultColumns[] = array(
				'class' => 'CCheckBoxColumn',
				'name' => 'id',
				'selectableRows' => 2,
				'checkBoxHtmlOptions' => array('name' => 'trash_id[]')
			);
			*/
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			$this->defaultColumns[] = array(
				'name' => 'position_name',
				'value' => '$data->position_name',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation->displayname',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Utility::dateFormat($data->creation_date)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => Yii::app()->controller->widget('application.components.system.CJuiDatePicker', array(
					'model'=>$this,
					'attribute'=>'creation_date',
					'language' => 'en',
					'i18nScriptFile' => 'jquery-ui-i18n.min.js',
					//'mode'=>'datetime',
					'htmlOptions' => array(
						'id' => 'creation_date_filter',
					),
					'options'=>array(
						'showOn' => 'focus',
						'dateFormat' => 'dd-mm-yy',
						'showOtherMonths' => true,
						'selectOtherMonths' => true,
						'changeMonth' => true,
						'changeYear' => true,
						'showButtonPanel' => true,
					),
				), true),
			);
			$this->defaultColumns[] = array(
				'name' => 'skill_search',
				'value' => 'CHtml::link($data->view->skills, Yii::app()->controller->createUrl("o/positionskill/manage",array(\'position\'=>$data->position_id,\'type\'=>\'publish\')))',
				'htmlOptions' => array(
					'class' => 'center',
				),	
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'position_desc_search',
				'value' => '$data->view->position_desc == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'position_task_search',
				'value' => '$data->view->position_task == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'position_jobdesc_search',
				'value' => '$data->view->position_jobdesc == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'position_knowledge_search',
				'value' => '$data->view->position_knowledge == 1 ? Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/publish.png\') : Chtml::image(Yii::app()->theme->baseUrl.\'/images/icons/unpublish.png\')',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter'=>array(
					1=>Yii::t('phrase', 'Yes'),
					0=>Yii::t('phrase', 'No'),
				),
				'type' => 'raw',
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->position_id)), $data->publish, 1)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter'=>array(
						1=>Yii::t('phrase', 'Yes'),
						0=>Yii::t('phrase', 'No'),
					),
					'type' => 'raw',
				);
			}
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

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {		
			if($this->isNewRecord)
				$this->creation_id = Yii::app()->user->id;	
			else
				$this->modified_id = Yii::app()->user->id;
		}
		return true;
	}

}