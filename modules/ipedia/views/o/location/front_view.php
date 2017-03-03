<?php
/**
 * Ipedia Directory Locations (ipedia-directory-location)
 * @var $this LocationController
 * @var $model IpediaDirectoryLocation
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 15:37 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Directory Locations'=>array('manage'),
		$model->location_id,
	);
?>

<?php //begin.Messages ?>
<?php
if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>
<?php //end.Messages ?>

<?php $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'location_id',
			'value'=>$model->location_id,
			//'value'=>$model->location_id != '' ? $model->location_id : '-',
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->publish,
		),
		array(
			'name'=>'directory_id',
			'value'=>$model->directory_id,
			//'value'=>$model->directory_id != '' ? $model->directory_id : '-',
		),
		array(
			'name'=>'headquarters',
			'value'=>$model->headquarters,
			//'value'=>$model->headquarters != '' ? $model->headquarters : '-',
		),
		array(
			'name'=>'address',
			'value'=>$model->address != '' ? $model->address : '-',
			//'value'=>$model->address != '' ? CHtml::link($model->address, Yii::app()->request->baseUrl.'/public/visit/'.$model->address, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'country_id',
			'value'=>$model->country_id,
			//'value'=>$model->country_id != '' ? $model->country_id : '-',
		),
		array(
			'name'=>'province_id',
			'value'=>$model->province_id,
			//'value'=>$model->province_id != '' ? $model->province_id : '-',
		),
		array(
			'name'=>'city_id',
			'value'=>$model->city_id,
			//'value'=>$model->city_id != '' ? $model->city_id : '-',
		),
		array(
			'name'=>'district_id',
			'value'=>$model->district_id,
			//'value'=>$model->district_id != '' ? $model->district_id : '-',
		),
		array(
			'name'=>'village_id',
			'value'=>$model->village_id,
			//'value'=>$model->village_id != '' ? $model->village_id : '-',
		),
		array(
			'name'=>'creation_date',
			'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->creation_date, true) : '-',
		),
		array(
			'name'=>'creation_id',
			'value'=>$model->creation_id,
			//'value'=>$model->creation_id != 0 ? $model->creation_id : '-',
		),
		array(
			'name'=>'modified_date',
			'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00')) ? Utility::dateFormat($model->modified_date, true) : '-',
		),
		array(
			'name'=>'modified_id',
			'value'=>$model->modified_id,
			//'value'=>$model->modified_id != 0 ? $model->modified_id : '-',
		),
	),
)); ?>

<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
