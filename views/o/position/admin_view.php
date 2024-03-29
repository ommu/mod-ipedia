<?php
/**
 * Ipedia Positions (ipedia-positions)
 * @var $this PositionController
 * @var $model IpediaPositions
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 11:12 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Positions'=>array('manage'),
		$model->position_id,
	);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'position_id',
			'value'=>$model->position_id,
		),
		array(
			'name'=>'publish',
			'value'=>$this->quickAction(Yii::app()->controller->createUrl('publish', array('id'=>$model->position_id)), $model->publish),
			'type'=>'raw',
		),
		array(
			'name'=>'position_name',
			'value'=>$model->position_name != '' ? $model->position_name : '-',
		),
		array(
			'name'=>'position_desc',
			'value'=>$model->position_desc != '' ? $model->position_desc : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'position_task',
			'value'=>$model->position_task != '' ? $model->position_task : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'position_jobdesc',
			'value'=>$model->position_jobdesc != '' ? $model->position_jobdesc : '-',
			'type'=>'raw',
		),
		array(
			'name'=>'position_knowledge',
			'value'=>$model->position_knowledge != '' ? $model->position_knowledge : '-',
			'type'=>'raw',
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