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
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('position_id'); ?><br/>
			<?php echo $form->textField($model,'position_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('position_name'); ?><br/>
			<?php echo $form->textField($model,'position_name',array('size'=>60,'maxlength'=>64)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('position_desc'); ?><br/>
			<?php echo $form->textArea($model,'position_desc',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('position_task'); ?><br/>
			<?php echo $form->textArea($model,'position_task',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('position_jobdesc'); ?><br/>
			<?php echo $form->textArea($model,'position_jobdesc',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('position_knowledge'); ?><br/>
			<?php echo $form->textArea($model,'position_knowledge',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_id'); ?><br/>
			<?php echo $form->textField($model,'creation_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_date'); ?><br/>
			<?php echo $form->textField($model,'modified_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('modified_id'); ?><br/>
			<?php echo $form->textField($model,'modified_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton(Yii::t('phrase', 'Search')); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>
