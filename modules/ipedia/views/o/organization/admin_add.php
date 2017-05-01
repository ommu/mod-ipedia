<?php
/**
 * Ipedia Organizations (ipedia-organizations)
 * @var $this OrganizationController
 * @var $model IpediaOrganizations
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 10:19 WIB
 * @link https://github.com/ommu/iPedia
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Organizations'=>array('manage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>