<?php
/**
 * IpediaUniversities
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:35 WIB
 * @link https://github.com/ommu/mod-ipedia
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
 * This is the model class for table "ommu_ipedia_universities".
 *
 * The followings are the available columns in table 'ommu_ipedia_universities':
 * @property string $university_id
 * @property integer $publish
 * @property string $directory_id
 * @property string $acreditation
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property CvEducations[] $CvEducations
 * @property IpediaDirectories $directory
 * @property IpediaUniversityMajor[] $IpediaUniversityMajors
 * @property VacancyUniversity[] $VacancyUniversities
 */
class IpediaUniversities extends CActiveRecord
{
	public $defaultColumns = array();
	public $university_name_i;
	public $university_faculty_i;
	public $university_major_i;
	
	// Variable Search
	public $creation_search;
	public $modified_search;
	public $faculty_search;
	public $major_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IpediaUniversities the static model class
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
		return 'ommu_ipedia_universities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('
				university_name_i', 'required'),
			array('
				university_name_i', 'vUniversityName'),
			array('publish', 'numerical', 'integerOnly'=>true),
			array('directory_id, creation_id, modified_id', 'length', 'max'=>11),
			array('acreditation', 'length', 'max'=>1),
			array('directory_id, acreditation,
				university_faculty_i, university_major_i', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('university_id, publish, directory_id, acreditation, creation_date, creation_id, modified_date, modified_id,
				university_name_i creation_search, modified_search, faculty_search, major_search,', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'ViewIpediaUniversities', 'university_id'),
			'directory' => array(self::BELONGS_TO, 'IpediaDirectories', 'directory_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'majors' => array(self::HAS_MANY, 'IpediaUniversityMajor', 'university_id'),
			'ommuCvEducations_relation' => array(self::HAS_MANY, 'OmmuCvEducations', 'university_id'),
			'ommuVacancyUniversities_relation' => array(self::HAS_MANY, 'OmmuVacancyUniversity', 'university_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'university_id' => Yii::t('attribute', 'University'),
			'publish' => Yii::t('attribute', 'Publish'),
			'directory_id' => Yii::t('attribute', 'Directory'),
			'acreditation' => Yii::t('attribute', 'Acreditation'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'university_name_i' => Yii::t('attribute', 'University'),
			'university_faculty_i' => Yii::t('attribute', 'Faculty'),
			'university_major_i' => Yii::t('attribute', 'Major'),
			'faculty_search' => Yii::t('attribute', 'Faculties'),
			'major_search' => Yii::t('attribute', 'Majors'),
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

		$criteria->compare('t.university_id',$this->university_id);
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
		if(isset($_GET['directory']))
			$criteria->compare('t.directory_id',$_GET['directory']);
		else
			$criteria->compare('t.directory_id',$this->directory_id);
		$criteria->compare('t.acreditation',strtolower($this->acreditation),true);
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
		
		$criteria->compare('view.university_name',strtolower($this->university_name_i), true);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);
		$criteria->compare('view.faculties',$this->faculty_search);
		$criteria->compare('view.majors',$this->major_search);

		if(!isset($_GET['IpediaUniversities_sort']))
			$criteria->order = 't.university_id DESC';

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
			//$this->defaultColumns[] = 'university_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'directory_id';
			$this->defaultColumns[] = 'acreditation';
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
			if(!isset($_GET['directory'])) {
				$this->defaultColumns[] = array(
					'name' => 'university_name_i',
					'value' => '$data->view->university_name',
				);
			}
			$this->defaultColumns[] = array(
				'name' => 'acreditation',
				'value' => '$data->acreditation',
				'htmlOptions' => array(
					'class' => 'center',
				),
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
			$this->defaultColumns[] = array(
				'name' => 'faculty_search',
				'value' => '$data->view->faculties ? $data->view->faculties : 0',
				'htmlOptions' => array(
					'class' => 'center',
				),	
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'major_search',
				'value' => 'CHtml::link($data->view->majors ? $data->view->majors : 0, Yii::app()->controller->createUrl("o/universitymajor/manage",array(\'university\'=>$data->university_id,\'type\'=>\'publish\')))',
				'htmlOptions' => array(
					'class' => 'center',
				),	
				'type' => 'raw',
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->university_id)), $data->publish, 1)',
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
	 * Get company name validation
	 */
	public function vUniversityName()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array(
			'directory' => array(
				'alias'=>'directory',
				'select'=>'directory_name'
			),
		);
		$criteria->compare('directory.directory_name', strtolower(trim($this->university_name_i)));
		$model = self::model()->find($criteria);
		if($model != null)
			$this->addError('university_name_i', Yii::t('phrase', 'University sudah terdaftar'));
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
			$criteria=new CDbCriteria;
			$criteria->compare('directory_name', strtolower(trim($this->university_name_i)));
			$model = IpediaDirectories::model()->find($criteria);
			if($model != null)
				$this->directory_id = $model->directory_id;
			else {
				$directory=new IpediaDirectories;
				$directory->directory_name = $this->university_name_i;
				if($directory->save())
					$this->directory_id = $directory->directory_id;
			}			
		}
		return true;	
	}

}