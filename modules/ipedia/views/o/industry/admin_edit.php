<?php
/**
 * Ipedia Industries (ipedia-industries)
 * @var $this IndustryController
 * @var $model IpediaIndustries
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 14:42 WIB
 * @link https://github.com/ommu/iPedia
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Industries'=>array('manage'),
		$model->industry_id=>array('view','id'=>$model->industry_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>