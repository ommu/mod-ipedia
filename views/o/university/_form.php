<?php
/**
 * Ipedia Universities (ipedia-universities)
 * @var $this UniversityController
 * @var $model IpediaUniversities
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 10:20 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.yii-traits.system.OActiveForm', array(
	'id'=>'ipedia-universities-form',
	'enableAjaxValidation'=>true,
)); ?>

<div class="dialog-content">
	<fieldset>

		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'university_name_i'); ?>
			<div class="desc">
				<?php if(!$model->isNewRecord && !$model->getErrors())
					$model->university_name_i = $model->view->university_name;
				//echo $form->textField($model,'university_name_i', array('class'=>'span-8'));
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'university_name_i',
					'source' => Yii::app()->controller->createUrl('o/directory/suggest', array('data'=>'university')),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$('#IpediaUniversities_university_name_i').val(ui.item.value);
						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-8',
					),
				)); ?>
				<?php echo $form->error($model,'university_name_i'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'acreditation'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'acreditation', array('maxlength'=>1,'class'=>'span-3')); ?>
				<?php echo $form->error($model,'acreditation'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
				
		<?php if(!$model->isNewRecord) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'university_major_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'university_major_i', array('maxlength'=>32,'class'=>'span-6'));
				$url = Yii::app()->controller->createUrl('o/universitymajor/add', array('type'=>'ipedia'));
				$university = $model->university_id;
				$tagId = 'IpediaUniversities_university_major_i';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'university_major_i',
					'source' => Yii::app()->controller->createUrl('o/major/suggest', array('data'=>'university','id'=>$model->university_id)),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$.ajax({
								type: 'post',
								url: '$url',
								data: { university_id: '$university', major_id: ui.item.id, major: ui.item.value },
								dataType: 'json',
								success: function(response) {
									$('form #$tagId').val('');
									$('form #major-suggest').append(response.data);
								}
							});

						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->error($model,'university_major_i');?>
				<div id="major-suggest" class="suggest clearfix">
					<?php
					$majors = $model->majors;
					if(!empty($majors)) {
						foreach($majors as $key => $val) {?>
						<div><?php echo $val->major->major_name;?><?php echo $val->publish == 0 ? ' '.Yii::t('phrase', '(Unpublish)') : ''?></div>
					<?php }
					}?>
				</div>
			</div>
		</div>
		<?php }?>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') , array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>


