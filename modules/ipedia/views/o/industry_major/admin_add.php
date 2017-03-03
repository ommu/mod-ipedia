<?php
/**
 * Ipedia Industry Majors (ipedia-industry-major)
 * @var $this IndustrymajorController
 * @var $model IpediaIndustryMajor
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 15:38 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Industry Majors'=>array('manage'),
		'Create',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/o/industry_major/_form', array('model'=>$model)); ?>
</div>
