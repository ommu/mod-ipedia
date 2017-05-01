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
				
	<?php if(!$model->isNewRecord) {?>
	<div class="clearfix">
		<?php echo $form->labelEx($model,'position_skill_i'); ?>
		<div class="desc">
			<?php //echo $form->textField($model,'position_skill_i',array('maxlength'=>32,'class'=>'span-6'));
			$url = Yii::app()->controller->createUrl('o/positionskill/add', array('type'=>'ipedia'));
			$position = $model->position_id;
			$tagId = 'IpediaPositions_position_skill_i';
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $model,
				'attribute' => 'position_skill_i',
				'source' => Yii::app()->controller->createUrl('o/skill/suggest', array('data'=>'position','id'=>$model->position_id)),
				'options' => array(
					//'delay '=> 50,
					'minLength' => 1,
					'showAnim' => 'fold',
					'select' => "js:function(event, ui) {
						$.ajax({
							type: 'post',
							url: '$url',
							data: { position_id: '$position', skill_id: ui.item.id, skill: ui.item.value },
							dataType: 'json',
							success: function(response) {
								$('form #$tagId').val('');
								$('form #skill-suggest').append(response.data);
							}
						});

					}"
				),
				'htmlOptions' => array(
					'class'	=> 'span-6',
				),
			));
			echo $form->error($model,'position_skill_i');?>
			<div id="skill-suggest" class="suggest clearfix">
				<?php
				$skills = $model->skills;
				if(!empty($skills)) {
					foreach($skills as $key => $val) {?>
					<div><?php echo $val->skill->view->skill_name;?><?php echo $val->publish == 0 ? ' '.Yii::t('phrase', '(Unpublish)') : ''?></div>
				<?php }
				}?>
			</div>
		</div>
	</div>
	<?php }?>

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


