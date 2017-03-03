<?php
/**
 * Ipedia Industries (ipedia-industries)
 * @var $this IndustryController
 * @var $model IpediaIndustries
 * @var $dataProvider CActiveDataProvider
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 14:42 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Industries',
	);
?>

<?php $this->widget('application.components.system.FListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'pager' => array(
		'header' => '',
	), 
	'summaryText' => '',
	'itemsCssClass' => 'items clearfix',
	'pagerCssClass'=>'pager clearfix',
)); ?>
