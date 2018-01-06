<?php
/**
 * IpediaUniversityMajor
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:36 WIB
 * @link https://github.com/ommu/ommu-ipedia
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
 * This is the model class for table "ommu_ipedia_university_major".
 *
 * The followings are the available columns in table 'ommu_ipedia_university_major':
 * @property string $id
 * @property integer $publish
 * @property string $university_id
 * @property string $faculty_id
 * @property string $major_id
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property IpediaUniversities $university
 * @property IpediaMajors $major
 */
class IpediaUniversityMajor extends CActiveRecord
{
	public $defaultColumns = array();
	public $university_name_i;
	public $faculty_name_i;
	public $major_name_i;
	
	// Variable Search
	public $creation_search;
	public $modified_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IpediaUniversityMajor the static model class
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
		return 'ommu_ipedia_university_major';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('university_id, faculty_id, major_id', 'required'),
			array('publish', 'numerical', 'integerOnly'=>true),
			array('university_id, faculty_id, major_id, creation_id, modified_id', 'length', 'max'=>11),
			array('
				university_name_i, faculty_name_i, major_name_i', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, publish, university_id, faculty_id, major_id, creation_date, creation_id, modified_date, modified_id,
				university_name_i, faculty_name_i, major_name_i, creation_search, modified_search', 'safe', 'on'=>'search'),
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
			'university' => array(self::BELONGS_TO, 'IpediaUniversities', 'university_id'),
			'faculty' => array(self::BELONGS_TO, 'IpediaFaculties', 'faculty_id'),
			'major' => array(self::BELONGS_TO, 'IpediaMajors', 'major_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attribute', 'ID'),
			'publish' => Yii::t('attribute', 'Publish'),
			'university_id' => Yii::t('attribute', 'University'),
			'faculty_id' => Yii::t('attribute', 'Faculty'),
			'major_id' => Yii::t('attribute', 'Major'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'university_name_i' => Yii::t('attribute', 'University'),
			'faculty_name_i' => Yii::t('attribute', 'Faculty'),
			'major_name_i' => Yii::t('attribute', 'Major'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
		);
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
			'university.view' => array(
				'alias'=>'university_v',
				'select'=>'university_name'
			),
			'faculty.view' => array(
				'alias'=>'faculty_v',
				'select'=>'faculty_name'
			),
			'major' => array(
				'alias'=>'major',
				'select'=>'major_name'
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

		$criteria->compare('t.id',strtolower($this->id),true);
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
		if(isset($_GET['university']))
			$criteria->compare('t.university_id',$_GET['university']);
		else
			$criteria->compare('t.university_id',$this->university_id);
		if(isset($_GET['faculty']))
			$criteria->compare('t.faculty_id',$_GET['faculty']);
		else
			$criteria->compare('t.faculty_id',$this->faculty_id);
		if(isset($_GET['major']))
			$criteria->compare('t.major_id',$_GET['major']);
		else
			$criteria->compare('t.major_id',$this->major_id);
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
		
		$criteria->compare('university_v.university_name',strtolower($this->university_name_i), true);
		$criteria->compare('faculty_v.faculty_name',strtolower($this->faculty_name_i), true);
		$criteria->compare('major.major_name',strtolower($this->major_name_i), true);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);

		if(!isset($_GET['IpediaUniversityMajor_sort']))
			$criteria->order = 't.id DESC';

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
			//$this->defaultColumns[] = 'id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'university_id';
			$this->defaultColumns[] = 'faculty_id';
			$this->defaultColumns[] = 'major_id';
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
			if(!isset($_GET['university'])) {
				$this->defaultColumns[] = array(
					'name' => 'university_name_i',
					'value' => '$data->university->view->university_name',
				);
			}
			if(!isset($_GET['faculty'])) {
				$this->defaultColumns[] = array(
					'name' => 'faculty_name_i',
					'value' => '$data->faculty->view->faculty_name',
				);
			}
			if(!isset($_GET['major'])) {
				$this->defaultColumns[] = array(
					'name' => 'major_name_i',
					'value' => '$data->major->major_name',
				);
			}
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
				'filter' => Yii::app()->controller->widget('application.libraries.core.components.system.CJuiDatePicker', array(
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
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->id)), $data->publish, 1)',
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
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if($this->isNewRecord) {
				if($this->university_id == 0) {
					$university = IpediaUniversities::model()->with('view')->find(array(
						'select' => 't.university_id',
						'condition' => 'view.university_name = :university',
						'params' => array(
							':university' => strtolower(trim($this->university_name_i)),
						),
					));
					if($university != null)
						$this->university_id = $university->university_id;
					else {
						$data = new IpediaUniversities;
						$data->university_name_i = $this->university_name_i;
						if($data->save())
							$this->university_id = $data->university_id;
					}
				}
				
				if($this->faculty_id == 0) {
					$faculty = IpediaFaculties::model()->with('view')->find(array(
						'select' => 't.faculty_id',
						'condition' => 'view.faculty_name = :faculty',
						'params' => array(
							':faculty' => strtolower(trim($this->faculty_name_i)),
						),
					));
					if($faculty != null)
						$this->faculty_id = $faculty->faculty_id;
					else {
						$data = new IpediaFaculties;
						$data->faculty_name_i = $this->faculty_name_i;
						if($data->save())
							$this->faculty_id = $data->faculty_id;
					}
				}
				
				if($this->major_id == 0) {
					$major = IpediaMajors::model()->find(array(
						'select' => 't.major_id, t.major_name',
						'condition' => 't.major_name = :major',
						'params' => array(
							':major' => strtolower(trim($this->major_name_i)),
						),
					));
					if($major != null)
						$this->major_id = $major->major_id;
					else {
						$data = new IpediaMajors;
						$data->major_name = $this->major_name_i;
						if($data->save())
							$this->major_id = $data->major_id;
					}					
				}
			}
		}
		return true;
	}

}