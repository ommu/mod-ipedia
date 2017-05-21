<?php
/**
 * IpediaCompanies
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:31 WIB
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
 * This is the model class for table "ommu_ipedia_companies".
 *
 * The followings are the available columns in table 'ommu_ipedia_companies':
 * @property string $company_id
 * @property integer $publish
 * @property string $directory_id
 * @property string $creation_date
 * @property string $creation_id
 * @property string $modified_date
 * @property string $modified_id
 *
 * The followings are the available model relations:
 * @property OmmuCvExperiences[] $ommuCvExperiences
 * @property OmmuCvReferenceReferee[] $ommuCvReferenceReferees
 * @property OmmuCvTrainings[] $ommuCvTrainings
 * @property OmmuIpediaDirectories $directory
 * @property OmmuIpediaCompanyIndustry[] $ommuIpediaCompanyIndustries
 * @property OmmuMemberCompany[] $ommuMemberCompanies
 */
class IpediaCompanies extends CActiveRecord
{
	public $defaultColumns = array();
	public $company_name_i;
	public $company_industry_i;
	
	// Variable Search
	public $creation_search;
	public $modified_search;
	public $industry_search;

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IpediaCompanies the static model class
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
		return 'ommu_ipedia_companies';
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
				company_name_i', 'required'),
			array('
				company_name_i', 'vCompanyName'),
			array('publish', 'numerical', 'integerOnly'=>true),
			array('directory_id, creation_id, modified_id', 'length', 'max'=>11),
			array('directory_id,
				company_industry_i', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('company_id, publish, directory_id, creation_date, creation_id, modified_date, modified_id,
				company_name_i, creation_search, modified_search, industry_search', 'safe', 'on'=>'search'),
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
			'view' => array(self::BELONGS_TO, 'ViewIpediaCompanies', 'company_id'),
			'directory' => array(self::BELONGS_TO, 'IpediaDirectories', 'directory_id'),
			'creation' => array(self::BELONGS_TO, 'Users', 'creation_id'),
			'modified' => array(self::BELONGS_TO, 'Users', 'modified_id'),
			'industries' => array(self::HAS_MANY, 'IpediaCompanyIndustry', 'company_id'),
			'companies' => array(self::HAS_MANY, 'MemberCompany', 'company_id'),
			'ommuCvExperiences_relation' => array(self::HAS_MANY, 'OmmuCvExperiences', 'company_id'),
			'ommuCvReferenceReferees_relation' => array(self::HAS_MANY, 'OmmuCvReferenceReferee', 'company_id'),
			'ommuCvTrainings_relation' => array(self::HAS_MANY, 'OmmuCvTrainings', 'company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'company_id' => Yii::t('attribute', 'Company'),
			'publish' => Yii::t('attribute', 'Publish'),
			'directory_id' => Yii::t('attribute', 'Directory'),
			'creation_date' => Yii::t('attribute', 'Creation Date'),
			'creation_id' => Yii::t('attribute', 'Creation'),
			'modified_date' => Yii::t('attribute', 'Modified Date'),
			'modified_id' => Yii::t('attribute', 'Modified'),
			'company_name_i' => Yii::t('attribute', 'Company'),
			'company_industry_i' => Yii::t('attribute', 'Industry'),
			'creation_search' => Yii::t('attribute', 'Creation'),
			'modified_search' => Yii::t('attribute', 'Modified'),
			'industry_search' => Yii::t('attribute', 'Industries'),
		);
		/*
			'Company' => 'Company',
			'Publish' => 'Publish',
			'Directory' => 'Directory',
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

		$criteria->compare('t.company_id',$this->company_id);
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
		
		$criteria->compare('view.company_name',strtolower($this->company_name_i), true);
		$criteria->compare('creation.displayname',strtolower($this->creation_search), true);
		$criteria->compare('modified.displayname',strtolower($this->modified_search), true);
		$criteria->compare('view.industries',$this->industry_search);

		if(!isset($_GET['IpediaCompanies_sort']))
			$criteria->order = 't.company_id DESC';

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
			//$this->defaultColumns[] = 'company_id';
			$this->defaultColumns[] = 'publish';
			$this->defaultColumns[] = 'directory_id';
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
					'name' => 'company_name_i',
					'value' => '$data->view->company_name',
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
				'name' => 'industry_search',
				'value' => 'CHtml::link($data->view->industries ? $data->view->industries : 0, Yii::app()->controller->createUrl("o/companyindustry/manage",array(\'company\'=>$data->company_id,\'type\'=>\'publish\')))',
				'htmlOptions' => array(
					'class' => 'center',
				),	
				'type' => 'raw',
			);
			if(!isset($_GET['type'])) {
				$this->defaultColumns[] = array(
					'name' => 'publish',
					'value' => 'Utility::getPublish(Yii::app()->controller->createUrl("publish",array("id"=>$data->company_id)), $data->publish, 1)',
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
	public function vCompanyName()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array(
			'directory' => array(
				'alias'=>'directory',
				'select'=>'directory_name'
			),
		);
		$criteria->compare('directory.directory_name', strtolower(trim($this->company_name_i)));
		$model = self::model()->find($criteria);
		if($model != null)
			$this->addError('company_name_i', Yii::t('phrase', 'Company sudah terdaftar'));
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
			$criteria->compare('directory_name', strtolower(trim($this->company_name_i)));
			$model = IpediaDirectories::model()->find($criteria);
			if($model != null)
				$this->directory_id = $model->directory_id;
			else {
				$directory=new IpediaDirectories;
				$directory->directory_name = $this->company_name_i;
				if($directory->save())
					$this->directory_id = $directory->directory_id;
			}			
		}
		return true;	
	}

}