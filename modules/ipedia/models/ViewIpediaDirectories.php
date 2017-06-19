<?php
/**
 * ViewIpediaDirectories
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:37 WIB
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
 * This is the model class for table "_view_ipedia_directories".
 *
 * The followings are the available columns in table '_view_ipedia_directories':
 * @property string $directory_id
 * @property string $directory_name
 * @property string $companies
 * @property string $company_id
 * @property string $organizations
 * @property string $organization_id
 * @property string $universities
 * @property string $university_id
 * @property string $locations
 * @property string $location_all
 */
class ViewIpediaDirectories extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewIpediaDirectories the static model class
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
		return '_view_ipedia_directories';
	}

	/**
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'directory_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('directory_id, company_id, organization_id, university_id', 'length', 'max'=>11),
			array('locations', 'length', 'max'=>23),
			array('location_all', 'length', 'max'=>21),
			array('directory_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('directory_id, directory_name, company_id, organization_id, university_id, locations, location_all', 'safe', 'on'=>'search'),
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
			'directory_id' => Yii::t('attribute', 'Directory'),
			'directory_name' => Yii::t('attribute', 'Directory Name'),
			'companies' => Yii::t('attribute', 'Companies'),
			'company_id' => Yii::t('attribute', 'Company'),
			'organizations' => Yii::t('attribute', 'Organizations'),
			'organization_id' => Yii::t('attribute', 'Organization'),
			'universities' => Yii::t('attribute', 'Universities'),
			'university_id' => Yii::t('attribute', 'University'),
			'locations' => Yii::t('attribute', 'Locations'),
			'location_all' => Yii::t('attribute', 'Location All'),
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

		$criteria->compare('t.directory_id',$this->directory_id);
		$criteria->compare('t.directory_name',strtolower($this->directory_name),true);
		$criteria->compare('t.companies',$this->companies);
		$criteria->compare('t.company_id',$this->company_id);
		$criteria->compare('t.organizations',$this->organizations);
		$criteria->compare('t.organization_id',$this->organization_id);
		$criteria->compare('t.universities',$this->universities);
		$criteria->compare('t.university_id',$this->university_id);
		$criteria->compare('t.locations',$this->locations);
		$criteria->compare('t.location_all',$this->location_all);

		if(!isset($_GET['ViewIpediaDirectories_sort']))
			$criteria->order = 't.directory_id DESC';

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
			$this->defaultColumns[] = 'directory_id';
			$this->defaultColumns[] = 'directory_name';
			$this->defaultColumns[] = 'companies';
			$this->defaultColumns[] = 'company_id';
			$this->defaultColumns[] = 'organizations';
			$this->defaultColumns[] = 'organization_id';
			$this->defaultColumns[] = 'universities';
			$this->defaultColumns[] = 'university_id';
			$this->defaultColumns[] = 'locations';
			$this->defaultColumns[] = 'location_all';
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
			//$this->defaultColumns[] = 'directory_id';
			$this->defaultColumns[] = 'directory_name';
			$this->defaultColumns[] = 'locations';
			$this->defaultColumns[] = 'companies';
			$this->defaultColumns[] = 'company_id';
			$this->defaultColumns[] = 'organizations';
			$this->defaultColumns[] = 'organization_id';
			$this->defaultColumns[] = 'universities';
			$this->defaultColumns[] = 'university_id';
			$this->defaultColumns[] = 'location_all';
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