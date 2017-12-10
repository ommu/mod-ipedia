<?php
/**
 * Ipedia Directories (ipedia-directories)
 * @var $this DirectoryController
 * @var $model IpediaDirectories
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 16:42 WIB
 * @link https://github.com/ommu/ommu-ipedia
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Directories'=>array('manage'),
		$model->directory_id=>array('view','id'=>$model->directory_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>