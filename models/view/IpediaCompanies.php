<?php
/**
 * IpediaCompanies
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 12 February 2019, 15:34 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 * This is the model class for table "_view_ipedia_companies".
 *
 * The followings are the available columns in table "_view_ipedia_companies":
 * @property integer $company_id
 * @property integer $member
 * @property integer $university
 * @property string $industries
 * @property integer $industry_all
 *
 */

namespace ommu\ipedia\models\view;

use Yii;
use yii\helpers\Url;

class IpediaCompanies extends \app\components\ActiveRecord
{
	use \ommu\traits\UtilityTrait;

	public $gridForbiddenColumn = [];

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return '_view_ipedia_companies';
	}

	/**
	 * @return string the primarykey column
	 */
	public static function primaryKey()
	{
		return ['company_id'];
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[['company_id', 'member', 'university', 'industry_all'], 'integer'],
			[['industries'], 'number'],
		];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'company_id' => Yii::t('app', 'Company'),
			'member' => Yii::t('app', 'Member'),
			'university' => Yii::t('app', 'University'),
			'industries' => Yii::t('app', 'Industries'),
			'industry_all' => Yii::t('app', 'Industry All'),
		];
	}

	/**
	 * Set default columns to display
	 */
	public function init()
	{
		parent::init();

		if(!(Yii::$app instanceof \app\components\Application))
			return;

		$this->templateColumns['_no'] = [
			'header' => Yii::t('app', 'No'),
			'class' => 'yii\grid\SerialColumn',
			'contentOptions' => ['class'=>'center'],
		];
		$this->templateColumns['company_id'] = [
			'attribute' => 'company_id',
			'value' => function($model, $key, $index, $column) {
				return $model->company_id;
			},
		];
		$this->templateColumns['member'] = [
			'attribute' => 'member',
			'value' => function($model, $key, $index, $column) {
				return $model->member;
			},
		];
		$this->templateColumns['university'] = [
			'attribute' => 'university',
			'value' => function($model, $key, $index, $column) {
				return $model->university;
			},
		];
		$this->templateColumns['industries'] = [
			'attribute' => 'industries',
			'value' => function($model, $key, $index, $column) {
				return $model->industries;
			},
		];
		$this->templateColumns['industry_all'] = [
			'attribute' => 'industry_all',
			'value' => function($model, $key, $index, $column) {
				return $model->industry_all;
			},
		];
	}

	/**
	 * User get information
	 */
	public static function getInfo($id, $column=null)
	{
		if($column != null) {
			$model = self::find();
			if(is_array($column))
				$model->select($column);
			else
				$model->select([$column]);
			$model = $model->where(['company_id' => $id])->one();
			return is_array($column) ? $model : $model->$column;
			
		} else {
			$model = self::findOne($id);
			return $model;
		}
	}
}
