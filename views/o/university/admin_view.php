<?php
/**
 * Ipedia Universities (ipedia-universities)
 * @var $this UniversityController
 * @var $model IpediaUniversities
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 10:20 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Universities'=>array('manage'),
		$model->university_id,
	);
?>

<div class="dialog-content">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'university_id',
			'value'=>$model->university_id,
		),
		array(
			'name'=>'publish',
			'value'=>$this->quickAction(Yii::app()->controller->createUrl('publish', array('id'=>$model->university_id)), $model->publish),
			'type'=>'raw',
		),
		array(
			'name'=>'directory_id',
			'value'=>$model->directory_id != 0 ? $model->view->university_name : '-',
		),
		array(
			'name'=>'acreditation',
			'value'=>$model->acreditation != '' ? $model->acreditation : '-',
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
