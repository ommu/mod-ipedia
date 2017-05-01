<?php
/**
 * Ipedia Positions (ipedia-positions)
 * @var $this PositionController
 * @var $model IpediaPositions
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 11:12 WIB
 * @link https://github.com/ommu/iPedia
 * @contact (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Positions'=>array('manage'),
		$model->position_id=>array('view','id'=>$model->position_id),
		'Update',
	);
?>

<div class="form" name="post-on">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
