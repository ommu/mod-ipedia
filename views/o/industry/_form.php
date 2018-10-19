<?php
/**
 * Ipedia Industries (ipedia-industries)
 * @var $this IndustryController
 * @var $model IpediaIndustries
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 14:42 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.yii-traits.system.OActiveForm', array(
	'id'=>'ipedia-industries-form',
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
			<?php echo $form->labelEx($model,'industry_name_i'); ?>
			<div class="desc">
				<?php if(!$model->isNewRecord && !$model->getErrors())
					$model->industry_name_i = $model->view->industry_name;
				echo $form->textField($model,'industry_name_i', array('maxlength'=>64,'class'=>'span-8')); ?>
				<?php echo $form->error($model,'industry_name_i'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'industry_desc'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'industry_desc', array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'industry_desc'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
				
		<?php if(!$model->isNewRecord) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'industry_major_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'industry_major_i', array('maxlength'=>32,'class'=>'span-6'));
				$url = Yii::app()->controller->createUrl('o/industrymajor/add', array('type'=>'ipedia'));
				$industry = $model->industry_id;
				$tagId = 'IpediaIndustries_industry_major_i';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'industry_major_i',
					'source' => Yii::app()->controller->createUrl('o/major/suggest', array('data'=>'industry','id'=>$model->industry_id)),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$.ajax({
								type: 'post',
								url: '$url',
								data: { industry_id: '$industry', major_id: ui.item.id, major: ui.item.value },
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
				echo $form->error($model,'industry_major_i');?>
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
		
		<div class="clearfix">
			<?php echo $form->labelEx($model,'industry_company_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'industry_company_i', array('maxlength'=>32,'class'=>'span-6'));
				$url = Yii::app()->controller->createUrl('o/companyindustry/add', array('type'=>'ipedia'));
				$industry = $model->industry_id;
				$tagId = 'IpediaIndustries_industry_company_i';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'industry_company_i',
					'source' => Yii::app()->controller->createUrl('o/company/suggest', array('data'=>'industry','id'=>$model->industry_id)),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$.ajax({
								type: 'post',
								url: '$url',
								data: { industry_id: '$industry', company_id: ui.item.id, company: ui.item.value },
								dataType: 'json',
								success: function(response) {
									$('form #$tagId').val('');
									$('form #company-suggest').append(response.data);
								}
							});

						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->error($model,'industry_company_i');?>
				<div id="company-suggest" class="suggest clearfix">
					<?php
					$companies = $model->companies;
					if(!empty($companies)) {
						foreach($companies as $key => $val) {?>
						<div><?php echo $val->company->view->company_name;?><?php echo $val->publish == 0 ? ' '.Yii::t('phrase', '(Unpublish)') : ''?></div>
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


