<?php
/**
 * Ipedia Skills (ipedia-skills)
 * @var $this SkillController
 * @var $model IpediaSkills
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 13:45 WIB
 * @link https://github.com/ommu/iPedia
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Skills'=>array('manage'),
		$model->skill_id=>array('view','id'=>$model->skill_id),
		'Update',
	);
?>

<div class="form">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
