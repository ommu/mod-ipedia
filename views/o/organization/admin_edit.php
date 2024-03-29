<?php
/**
 * Ipedia Organizations (ipedia-organizations)
 * @var $this OrganizationController
 * @var $model IpediaOrganizations
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 10:19 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Organizations'=>array('manage'),
		$model->organization_id=>array('view','id'=>$model->organization_id),
		Yii::t('phrase', 'Update'),
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>