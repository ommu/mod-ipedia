<?php
/**
 * Ipedia Faculties (ipedia-faculties)
 * @var $this FacultyController
 * @var $model IpediaFaculties
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 19 April 2017, 09:51 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Faculties'=>array('manage'),
		Yii::t('phrase', 'Create'),
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>