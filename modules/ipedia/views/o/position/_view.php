<?php
/**
 * Ipedia Positions (ipedia-positions)
 * @var $this PositionController
 * @var $data IpediaPositions
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 11:12 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->position_id), array('view', 'id'=>$data->position_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_name')); ?>:</b>
	<?php echo CHtml::encode($data->position_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_desc')); ?>:</b>
	<?php echo CHtml::encode($data->position_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_task')); ?>:</b>
	<?php echo CHtml::encode($data->position_task); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_jobdesc')); ?>:</b>
	<?php echo CHtml::encode($data->position_jobdesc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position_knowledge')); ?>:</b>
	<?php echo CHtml::encode($data->position_knowledge); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />

	*/ ?>

</div>