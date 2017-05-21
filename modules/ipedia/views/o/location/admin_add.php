<?php
/**
 * Ipedia Directory Locations (ipedia-directory-location)
 * @var $this LocationController
 * @var $model IpediaDirectoryLocation
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 15:37 WIB
 * @link https://github.com/ommu/mod-ipedia
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Directory Locations'=>array('manage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'directory'=>$directory,
)); ?>