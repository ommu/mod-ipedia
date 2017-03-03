<?php
/**
 * Ipedia Organizations (ipedia-organizations)
 * @var $this OrganizationController
 * @var $data IpediaOrganizations
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 10:19 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('organization_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->organization_id), array('view', 'id'=>$data->organization_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish')); ?>:</b>
	<?php echo CHtml::encode($data->publish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('directory_id')); ?>:</b>
	<?php echo CHtml::encode($data->directory_id); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_id')); ?>:</b>
	<?php echo CHtml::encode($data->modified_id); ?>
	<br />


</div>