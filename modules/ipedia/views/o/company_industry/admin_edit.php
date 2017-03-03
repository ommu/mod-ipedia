<?php
/**
 * Ipedia Company Industries (ipedia-company-industry)
 * @var $this CompanyindustryController
 * @var $model IpediaCompanyIndustry
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 15:37 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Company Industries'=>array('manage'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('/o/company_industry/_form', array('model'=>$model)); ?>
</div>