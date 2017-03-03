<?php
/**
 * Ipedia Positions (ipedia-positions)
 * @var $this PositionController
 * @var $model IpediaPositions
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 11:12 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Positions'=>array('manage'),
		$model->position_id,
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
			'name'=>'position_id',
			'value'=>$model->position_id,
			//'value'=>$model->position_id != '' ? $model->position_id : '-',
		),
		array(
			'name'=>'publish',
			'value'=>$model->publish == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),
			//'value'=>$model->publish,
		),
		array(
			'name'=>'position_name',
			'value'=>$model->position_name,
			//'value'=>$model->position_name != '' ? $model->position_name : '-',
		),
		array(
			'name'=>'position_desc',
			'value'=>$model->position_desc != '' ? $model->position_desc : '-',
			//'value'=>$model->position_desc != '' ? CHtml::link($model->position_desc, Yii::app()->request->baseUrl.'/public/visit/'.$model->position_desc, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'position_task',
			'value'=>$model->position_task != '' ? $model->position_task : '-',
			//'value'=>$model->position_task != '' ? CHtml::link($model->position_task, Yii::app()->request->baseUrl.'/public/visit/'.$model->position_task, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'position_jobdesc',
			'value'=>$model->position_jobdesc != '' ? $model->position_jobdesc : '-',
			//'value'=>$model->position_jobdesc != '' ? CHtml::link($model->position_jobdesc, Yii::app()->request->baseUrl.'/public/visit/'.$model->position_jobdesc, array('target' => '_blank')) : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'position_knowledge',
			'value'=>$model->position_knowledge != '' ? $model->position_knowledge : '-',
			//'value'=>$model->position_knowledge != '' ? CHtml::link($model->position_knowledge, Yii::app()->request->baseUrl.'/public/visit/'.$model->position_knowledge, array('target' => '_blank')) : '-',
			'type'=>'raw',
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
