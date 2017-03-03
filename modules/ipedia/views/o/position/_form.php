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
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'ipedia-positions-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'position_name'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'position_name',array('maxlength'=>64,'class'=>'span-6')); ?>
			<?php echo $form->error($model,'position_name'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'position_desc'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'position_desc',array('rows'=>6, 'cols'=>50,'class'=>'span-10 medium'));
			$this->widget('application.extensions.imperavi.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>position_desc,
				// Redactor options
				'options'=>array(
					//'lang'=>'fi',
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			)); ?>
			<?php echo $form->error($model,'position_desc'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'position_task'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'position_task',array('rows'=>6, 'cols'=>50,'class'=>'span-10 medium'));
			$this->widget('application.extensions.imperavi.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>position_task,
				// Redactor options
				'options'=>array(
					//'lang'=>'fi',
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			)); ?>
			<?php echo $form->error($model,'position_task'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'position_jobdesc'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'position_jobdesc',array('rows'=>6, 'cols'=>50,'class'=>'span-10 medium'));
			$this->widget('application.extensions.imperavi.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>position_jobdesc,
				// Redactor options
				'options'=>array(
					//'lang'=>'fi',
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			)); ?>
			<?php echo $form->error($model,'position_jobdesc'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'position_knowledge'); ?>
		<div class="desc">
			<?php //echo $form->textArea($model,'position_knowledge',array('rows'=>6, 'cols'=>50,'class'=>'span-10 medium'));
			$this->widget('application.extensions.imperavi.ImperaviRedactorWidget', array(
				'model'=>$model,
				'attribute'=>position_knowledge,
				// Redactor options
				'options'=>array(
					//'lang'=>'fi',
					'buttons'=>array(
						'html', 'formatting', '|', 
						'bold', 'italic', 'deleted', '|',
						'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
						'link', '|',
					),
				),
				'plugins' => array(
					'fontcolor' => array('js' => array('fontcolor.js')),
					'fullscreen' => array('js' => array('fullscreen.js')),
				),
			)); ?>
			<?php echo $form->error($model,'position_knowledge'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'publish'); ?>
		<div class="desc">
			<?php echo $form->checkBox($model,'publish'); ?>
			<?php echo $form->error($model,'publish'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save'), array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>

</fieldset>
<?php $this->endWidget(); ?>


