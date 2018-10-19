<?php
/**
 * Ipedia Directory Locations (ipedia-directory-location)
 * @var $this LocationController
 * @var $model IpediaDirectoryLocation
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 15:37 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Directory Locations'=>array('manage'),
		$model->location_id,
	);
?>

<div class="dialog-content">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'location_id',
			'value'=>$model->location_id,
		),
		array(
			'name'=>'publish',
			'value'=>$this->quickAction(Yii::app()->controller->createUrl('publish', array('id'=>$model->location_id)), $model->publish),
			'type'=>'raw',
		),
		array(
			'name'=>'headquarters',
			'value'=>$model->headquarters == '1' ? CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : CHtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			'type'=>'raw',
		),
		array(
			'name'=>'directory_id',
			'value'=>$model->directory_id != 0 ? $model->directory->directory_name : '-',
		),
		array(
			'name'=>'address',
			'value'=>$model->address != '' ? $model->address : '-',
		),
		array(
			'name'=>'village_id',
			'value'=>$model->village_id != 0 ? $model->view->village_name : '-',
		),
		array(
			'name'=>'district_id',
			'value'=>$model->district_id != 0 ? $model->view->district_name : '-',
		),
		array(
			'name'=>'city_id',
			'value'=>$model->city_id != 0 ? $model->view->city_name : '-',
		),
		array(
			'name'=>'province_id',
			'value'=>$model->province_id != 0 ? $model->view->province_name : '-',
		),
		array(
			'name'=>'country_id',
			'value'=>$model->country_id != 0 ? $model->view->country_name : '-',
		),
		array(
			'name'=>'creation_date',
			'value'=>!in_array($model->creation_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')) ? $this->dateFormat($model->creation_date) : '-',
		),
		array(
			'name'=>'creation_search',
			'value'=>$model->creation_id != 0 ? $model->creation->displayname : '-',
		),
		array(
			'name'=>'modified_date',
			'value'=>!in_array($model->modified_date, array('0000-00-00 00:00:00','1970-01-01 00:00:00','0002-12-02 07:07:12','-0001-11-30 00:00:00')) ? $this->dateFormat($model->modified_date) : '-',
		),
		array(
			'name'=>'modified_search',
			'value'=>$model->modified_id != 0 ? $model->modified->displayname : '-',
		),
	),
)); ?>
</div>
<div class="dialog-submit">
	<?php echo CHtml::button(Yii::t('phrase', 'Close'), array('id'=>'closed')); ?>
</div>
