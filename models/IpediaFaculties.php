<?php
/**
 * IpediaFaculties
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 19 April 2017, 02:17 WIB
 * @link https://github.com/ommu/mod-ipedia
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
 * This is the model class for table "ommu_ipedia_faculties".
 *
 * The followings are the available columns in table 'ommu_ipedia_faculties':
 * @property string $faculty_id
 * @property integer $publish
 * @property string $another_id
 * @property string $faculty_desc
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property IpediaAnothers $another
 * @property IpediaUniversityMajor[] $IpediaUniversityMajors
 */
class IpediaFaculties extends CActiveRecord
{
	use GridViewTrait;

	public $defaultColumns = array();
	public $faculty_name_i;
	
	// Variable Search
	public $creation_search;
	public $modified_search;
	public $major_search;
	public $university_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IpediaFaculties the static model class
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
		return 'ommu_ipedia_faculties';
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
				faculty_name_i', 'required'),
			array('
				faculty_name_i', 'vFacultyName'),
			array('publish', 'numerical', 'integerOnly'=>true),
			array('another_id, creation_id, modified_id', 'length', 'max'=>11),
			array('another_id, faculty_desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('faculty_id, publish, another_id, faculty_desc, creation_date, creation_id, modified_date, modified_id,
				faculty_name_i, creation_search, modified_search, major_search, university_search', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'ViewIpediaFaculties', 'faculty_id'),
			'another' => array(self::BELONGS_TO, 'IpediaAnothers', 'another_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'ommu_ipedia_university_majors' => array(self::HAS_MANY, 'OmmuIpediaUniversityMajor', 'faculty_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'faculty_id' => Yii::t('attribute', 'Faculty'),
			'publish' => Yii::t('attribute', 'Publish'),
			'another_id' => Yii::t('attribute', 'Another'),
			'faculty_desc' => Yii::t('attribute', 'Description'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'faculty_name_i' => Yii::t('attribute', 'Faculty'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
			'major_search' => Yii::t('attribute', 'Majors'),
			'university_search' => Yii::t('attribute', 'Universities'),
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
				'alias' => 'view',
			),
			'creation' => array(
				'alias' => 'creation',
				'select' => 'displayname'
			),
			'modified' => array(
				'alias' => 'modified',
				'select' => 'displayname'
			),
		);

		$criteria->compare('t.faculty_id', strtolower($this->faculty_id), true);
		if(Yii::app()->getRequest()->getParam('type') == 'publish')
			$criteria->compare('t.publish', 1);
		elseif(Yii::app()->getRequest()->getParam('type') == 'unpublish')
			$criteria->compare('t.publish', 0);
		elseif(Yii::app()->getRequest()->getParam('type') == 'trash')
			$criteria->compare('t.publish', 2);
		else {
			$criteria->addInCondition('t.publish', array(0,1));
			$criteria->compare('t.publish', $this->publish);
		}
		if(Yii::app()->getRequest()->getParam('another'))
			$criteria->compare('t.another_id', Yii::app()->getRequest()->getParam('another'));
		else
			$criteria->compare('t.another_id', $this->another_id);
		$criteria->compare('t.faculty_desc', strtolower($this->faculty_desc), true);
		if($this->creation_date != null && !in_array($this->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')))
			$criteria->compare('date(t.creation_date)', date('Y-m-d', strtotime($this->creation_date)));
		if(Yii::app()->getRequest()->getParam('creation'))
			$criteria->compare('t.creation_id', Yii::app()->getRequest()->getParam('creation'));
		else
			$criteria->compare('t.creation_id', $this->creation_id);
		if($this->modified_date != null && !in_array($this->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')))
			$criteria->compare('date(t.modified_date)', date('Y-m-d', strtotime($this->modified_date)));
		if(Yii::app()->getRequest()->getParam('modified'))
			$criteria->compare('t.modified_id', Yii::app()->getRequest()->getParam('modified'));
		else
			$criteria->compare('t.modified_id', $this->modified_id);
		
		$criteria->compare('view.faculty_name', strtolower($this->faculty_name_i), true);
		$criteria->compare('creation.displayname', strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname', strtolower($this->modified_search), true);
		$criteria->compare('view.majors', $this->major_search);
		$criteria->compare('view.universities', $this->university_search);

		if(!Yii::app()->getRequest()->getParam('IpediaFaculties_sort'))
			$criteria->order = 't.faculty_id DESC';

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
			//$this->defaultColumns[] = 'faculty_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'another_id';
			$this->defaultColumns[] = 'faculty_desc';
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
			if(!Yii::app()->getRequest()->getParam('another')) {
				$this->defaultColumns[] = array(
					'name' => 'faculty_name_i',
					'value' => '$data->view->faculty_name',
				);
			}
			$this->defaultColumns[] = 'faculty_desc';
			$this->defaultColumns[] = array(
				'name' => 'creation_search',
				'value' => '$data->creation->displayname',
			);
			$this->defaultColumns[] = array(
				'name' => 'creation_date',
				'value' => 'Yii::app()->dateFormatter->formatDateTime($data->creation_date, \'medium\', false)',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'filter' => $this->filterDatepicker($this, 'creation_date'),
			);
			$this->defaultColumns[] = array(
				'name' => 'major_search',
				'value' => '$data->view->majors ? $data->view->majors : 0',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			$this->defaultColumns[] = array(
				'name' => 'university_search',
				'value' => '$data->view->universities ? $data->view->universities : 0',
				'htmlOptions' => array(
					'class' => 'center',
				),
				'type' => 'raw',
			);
			if(!Yii::app()->getRequest()->getParam('type')) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl(\'publish\', array(\'id\'=>$data->faculty_id)), $data->publish, 1)',
					'htmlOptions' => array(
						'class' => 'center',
					),
					'filter' => $this->filterYesNo(),
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
			$model = self::model()->findByPk($id, array(
				'select' => $column,
			));
 			if(count(explode(',', $column)) == 1)
 				return $model->$column;
 			else
 				return $model;
			
		} else {
			$model = self::model()->findByPk($id);
			return $model;
		}
	}

	/**
	 * Get company name validation
	 */
	public function vFacultyName()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array(
			'another' => array(
				'alias' => 'another',
				'select' => 'another_name'
			),
		);
		$criteria->compare('another.another_name', strtolower(trim($this->faculty_name_i)));
		$model = self::model()->find($criteria);
		if($model != null)
			$this->addError('faculty_name_i', Yii::t('phrase', 'Faculty sudah terdaftar'));
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
			$criteria->compare('another_name', strtolower(trim($this->faculty_name_i)));
			$model = IpediaAnothers::model()->find($criteria);
			if($model != null)
				$this->another_id = $model->another_id;
			else {
				$another=new IpediaAnothers;
				$another->another_name = $this->faculty_name_i;
				if($another->save())
					$this->another_id = $another->another_id;
			}			
		}
		return true;	
	}

}