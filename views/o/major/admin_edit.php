<?php
/**
 * Ipedia Majors (ipedia-majors)
 * @var $this MajorController
 * @var $model IpediaMajors
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 11:12 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Majors'=>array('manage'),
		$model->major_id=>array('view','id'=>$model->major_id),
		Yii::t('phrase', 'Update'),
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>