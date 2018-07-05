<?php
/**
 * Ipedia Faculties (ipedia-faculties)
 * @var $this FacultyController
 * @var $model IpediaFaculties
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 19 April 2017, 09:51 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Faculties'=>array('manage'),
		$model->faculty_id=>array('view','id'=>$model->faculty_id),
		'Update',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>