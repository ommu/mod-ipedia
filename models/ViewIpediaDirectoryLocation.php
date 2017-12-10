<?php
/**
 * ViewIpediaDirectoryLocation
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 6 March 2017, 12:27 WIB
 * @link https://github.com/ommu/ommu-ipedia
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
 * This is the model class for table "_view_ipedia_directory_location".
 *
 * The followings are the available columns in table '_view_ipedia_directory_location':
 * @property string $location_id
 * @property string $directory_name
 * @property string $village_name
 * @property string $district_name
 * @property string $city_name
 * @property string $province_name
 * @property string $country_name
 */
class ViewIpediaDirectoryLocation extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewIpediaDirectoryLocation the static model class
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
		return '_view_ipedia_directory_location';
	}

	/**
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'location_id';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location_id', 'length', 'max'=>11),
			array('village_name, district_name, city_name, province_name, country_name', 'length', 'max'=>64),
			array('directory_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('village_name, district_name, location_id, directory_name, city_name, province_name, country_name', 'safe', 'on'=>'search'),
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
			'location_id' => Yii::t('attribute', 'Location'),
			'directory_name' => Yii::t('attribute', 'Directory Name'),
			'village_name' => Yii::t('attribute', 'Village Name'),
			'district_name' => Yii::t('attribute', 'District Name'),
			'city_name' => Yii::t('attribute', 'City Name'),
			'province_name' => Yii::t('attribute', 'Province Name'),
			'country_name' => Yii::t('attribute', 'Country Name'),
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

		$criteria->compare('t.location_id',$this->location_id);
		$criteria->compare('t.directory_name',strtolower($this->directory_name),true);
		$criteria->compare('t.village_name',strtolower($this->village_name),true);
		$criteria->compare('t.district_name',strtolower($this->district_name),true);
		$criteria->compare('t.city_name',strtolower($this->city_name),true);
		$criteria->compare('t.province_name',strtolower($this->province_name),true);
		$criteria->compare('t.country_name',strtolower($this->country_name),true);

		if(!isset($_GET['ViewIpediaDirectoryLocation_sort']))
			$criteria->order = 't. DESC';

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
			$this->defaultColumns[] = 'location_id';
			$this->defaultColumns[] = 'directory_name';
			$this->defaultColumns[] = 'village_name';
			$this->defaultColumns[] = 'district_name';
			$this->defaultColumns[] = 'city_name';
			$this->defaultColumns[] = 'province_name';
			$this->defaultColumns[] = 'country_name';
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
			//$this->defaultColumns[] = 'location_id';
			$this->defaultColumns[] = 'directory_name';
			$this->defaultColumns[] = 'village_name';
			$this->defaultColumns[] = 'district_name';
			$this->defaultColumns[] = 'city_name';
			$this->defaultColumns[] = 'province_name';
			$this->defaultColumns[] = 'country_name';
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