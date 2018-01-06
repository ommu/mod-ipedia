<?php
/**
 * Ipedia Anothers (ipedia-anothers)
 * @var $this AnotherController
 * @var $model IpediaAnothers
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 19 April 2017, 09:50 WIB
 * @link https://github.com/ommu/ommu-ipedia
 *
 */

	$this->breadcrumbs=array(
		'Ipedia Anothers'=>array('manage'),
		'Create',
	);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>