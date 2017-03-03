<?php
/**
 * Ipedia Industries (ipedia-industries)
 * @var $this IndustryController
 * @var $data IpediaIndustries
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 14:42 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->industry_id), array('view', 'id'=>$data->industry_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_id')); ?>:</b>
	<?php echo CHtml::encode($data->tag_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry_desc')); ?>:</b>
	<?php echo CHtml::encode($data->industry_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_date')); ?>:</b>
	<?php echo CHtml::encode($data->creation_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creation_id')); ?>:</b>
	<?php echo CHtml::encode($data->creation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_date')); ?>:</b>
	<?php echo CHtml::encode($data->modified_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />

	*/ ?>

</div>