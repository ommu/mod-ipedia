<?php
/**
 * ViewIpediaIndustries
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 2 March 2017, 14:37 WIB
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
	 * @return string the primarykey column
	 */
	public function primaryKey()
	{
		return 'industry_id';
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
			'majors' => array(self::HAS_MANY, 'IpediaIndustryMajor', 'industry_id'),
			'companies' => array(self::HAS_MANY, 'IpediaCompanyIndustry', 'industry_id'),
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

		$criteria->compare('t.industry_id', $this->industry_id);
		$criteria->compare('t.industry_name', strtolower($this->industry_name), true);
		$criteria->compare('t.majors', $this->majors);
		$criteria->compare('t.major_all', $this->major_all);
		$criteria->compare('t.companies', $this->companies);
		$criteria->compare('t.company_all', $this->company_all);

		if(!Yii::app()->getRequest()->getParam('ViewIpediaIndustries_sort'))
			$criteria->order = 't.industry_id DESC';

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
			$this->defaultColumns[] = array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			);
			//$this->defaultColumns[] = 'industry_id';
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

}