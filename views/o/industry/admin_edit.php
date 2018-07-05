<?php
/**
 * Ipedia Industries (ipedia-industries)
 * @var $this IndustryController
 * @var $model IpediaIndustries
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 14:42 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Industries'=>array('manage'),
		$model->industry_id=>array('view','id'=>$model->industry_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>