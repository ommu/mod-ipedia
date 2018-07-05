<?php
/**
 * Ipedia Directories (ipedia-directories)
 * @var $this DirectoryController
 * @var $model IpediaDirectories
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 2 March 2017, 16:42 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Directories'=>array('manage'),
		$model->directory_id=>array('view','id'=>$model->directory_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>