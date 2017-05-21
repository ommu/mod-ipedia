<?php
/**
 * Ipedia Majors (ipedia-majors)
 * @var $this MajorController
 * @var $model IpediaMajors
 * @var $form CActiveForm
 * version: 0.0.1
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 3 March 2017, 11:12 WIB
 * @link https://github.com/ommu/mod-ipedia
 * @contact (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'ipedia-majors-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<div class="dialog-content">
	<fieldset>
		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'major_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'major_name',array('maxlength'=>64, 'class'=>'span-7')); ?>
				<?php echo $form->error($model,'major_name'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'major_desc'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'major_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'major_desc'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
				
		<?php if(!$model->isNewRecord) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'major_university_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'major_university_i',array('maxlength'=>32,'class'=>'span-6'));
				$url = Yii::app()->controller->createUrl('o/universitymajor/add', array('type'=>'ipedia'));
				$major = $model->major_id;
				$tagId = 'IpediaMajors_major_university_i';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'major_university_i',
					'source' => Yii::app()->controller->createUrl('o/university/suggest', array('data'=>'major','id'=>$model->major_id)),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$.ajax({
								type: 'post',
								url: '$url',
								data: { major_id: '$major', university_id: ui.item.id, university: ui.item.value },
								dataType: 'json',
								success: function(response) {
									$('form #$tagId').val('');
									$('form #university-suggest').append(response.data);
								}
							});

						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->error($model,'major_university_i');?>
				<div id="university-suggest" class="suggest clearfix">
					<?php
					$universities = $model->universities;
					if(!empty($universities)) {
						foreach($universities as $key => $val) {?>
						<div><?php echo $val->university->view->university_name;?><?php echo $val->publish == 0 ? ' '.Yii::t('phrase', '(Unpublish)') : ''?></div>
					<?php }
					}?>
				</div>
			</div>
		</div>
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'major_industry_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'major_industry_i',array('maxlength'=>32,'class'=>'span-6'));
				$url = Yii::app()->controller->createUrl('o/industrymajor/add', array('type'=>'ipedia'));
				$major = $model->major_id;
				$tagId = 'IpediaMajors_major_industry_i';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'major_industry_i',
					'source' => Yii::app()->controller->createUrl('o/industry/suggest', array('data'=>'major','id'=>$model->major_id)),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$.ajax({
								type: 'post',
								url: '$url',
								data: { major_id: '$major', industry_id: ui.item.id, industry: ui.item.value },
								dataType: 'json',
								success: function(response) {
									$('form #$tagId').val('');
									$('form #industry-suggest').append(response.data);
								}
							});

						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->error($model,'major_industry_i');?>
				<div id="industry-suggest" class="suggest clearfix">
					<?php
					$industries = $model->industries;
					if(!empty($industries)) {
						foreach($industries as $key => $val) {?>
						<div><?php echo $val->industry->view->industry_name;?><?php echo $val->publish == 0 ? ' '.Yii::t('phrase', '(Unpublish)') : ''?></div>
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
	<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('phrase', 'Create') : Yii::t('phrase', 'Save') ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button(Yii::t('phrase', 'Cancel'), array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>


