<?php
/**
 * Ipedia Companies (ipedia-companies)
 * @var $this CompanyController
 * @var $model IpediaCompanies
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 16:41 WIB
 * @link https://github.com/ommu/ommu-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Companies'=>array('manage'),
		$model->company_id=>array('view','id'=>$model->company_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>