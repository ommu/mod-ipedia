<?php
/**
 * ViewIpediaIndustries
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 14:37 WIB
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
 * This is the model class for table "_view_ipedia_industries".
 *
 * The followings are the available columns in table '_view_ipedia_industries':
 * @property string $industry_id
 * @property string $industry_name
 * @property string $majors
 * @property string $major_all
 * @property string $companies
 * @property string $company_all
 */
class ViewIpediaIndustries extends CActiveRecord
{
	public $defaultColumns = array();

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ViewIpediaIndustries the static model class
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
		return '_view_ipedia_industries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('industry_id', 'length', 'max'=>11),
			array('industry_name', 'length', 'max'=>64),
			array('majors, companies', 'length', 'max'=>23),
			array('major_all, company_all', 'length', 'max'=>21),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('industry_id, industry_name, majors, major_all, companies, company_all', 'safe', 'on'=>'search'),
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
			'industry_id' => Yii::t('attribute', 'Industry'),
			'industry_name' => Yii::t('attribute', 'Industry Name'),
			'majors' => Yii::t('attribute', 'Majors'),
			'major_all' => Yii::t('attribute', 'Major All'),
			'companies' => Yii::t('attribute', 'Companies'),
			'company_all' => Yii::t('attribute', 'Company All'),
		);
		/*
			'Industry' => 'Industry',
			'Industry Name' => 'Industry Name',
			'Majors' => 'Majors',
			'Major All' => 'Major All',
			'Companies' => 'Companies',
			'Company All' => 'Company All',
		
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

		$criteria->compare('t.industry_id',strtolower($this->industry_id),true);
		$criteria->compare('t.industry_name',strtolower($this->industry_name),true);
		$criteria->compare('t.majors',strtolower($this->majors),true);
		$criteria->compare('t.major_all',strtolower($this->major_all),true);
		$criteria->compare('t.companies',strtolower($this->companies),true);
		$criteria->compare('t.company_all',strtolower($this->company_all),true);

		if(!isset($_GET['ViewIpediaIndustries_sort']))
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
			$this->defaultColumns[] = 'industry_id';
			$this->defaultColumns[] = 'industry_name';
			$this->defaultColumns[] = 'majors';
			$this->defaultColumns[] = 'major_all';
			$this->defaultColumns[] = 'companies';
			$this->defaultColumns[] = 'company_all';
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
			$this->defaultColumns[] = 'industry_id';
			$this->defaultColumns[] = 'industry_name';
			$this->defaultColumns[] = 'majors';
			$this->defaultColumns[] = 'major_all';
			$this->defaultColumns[] = 'companies';
			$this->defaultColumns[] = 'company_all';
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
	/*
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			// Create action
		}
		return true;
	}
	*/

	/**
	 * after validate attributes
	 */
	/*
	protected function afterValidate()
	{
		parent::afterValidate();
			// Create action
		return true;
	}
	*/
	
	/**
	 * before save attributes
	 */
	/*
	protected function beforeSave() {
		if(parent::beforeSave()) {
		}
		return true;	
	}
	*/
	
	/**
	 * After save attributes
	 */
	/*
	protected function afterSave() {
		parent::afterSave();
		// Create action
	}
	*/

	/**
	 * Before delete attributes
	 */
	/*
	protected function beforeDelete() {
		if(parent::beforeDelete()) {
			// Create action
		}
		return true;
	}
	*/

	/**
	 * After delete attributes
	 */
	/*
	protected function afterDelete() {
		parent::afterDelete();
		// Create action
	}
	*/

}