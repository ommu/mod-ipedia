<?php
/**
 * Ipedia Companies (ipedia-companies)
 * @var $this CompanyController
 * @var $model IpediaCompanies
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (opensource.ommu.co)
 * @created date 2 March 2017, 16:41 WIB
 * @link https://github.com/ommu/ommu-ipedia
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.core.components.system.OActiveForm', array(
	'id'=>'ipedia-companies-form',
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
			<?php echo $form->labelEx($model,'company_name_i'); ?>
			<div class="desc">
				<?php if(!$model->isNewRecord && !$model->getErrors())
					$model->company_name_i = $model->view->company_name;
				//echo $form->textField($model,'company_name_i',array('class'=>'span-8'));
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'company_name_i',
					'source' => Yii::app()->controller->createUrl('o/directory/suggest', array('data'=>'company')),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$('#IpediaCompanies_company_name_i').val(ui.item.value);
						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-8',
					),
				));?>
				<?php echo $form->error($model,'company_name_i'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>
				
		<?php if(!$model->isNewRecord) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'company_industry_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'company_industry_i',array('maxlength'=>32,'class'=>'span-6'));
				$url = Yii::app()->controller->createUrl('o/companyindustry/add', array('type'=>'ipedia'));
				$company = $model->company_id;
				$tagId = 'IpediaCompanies_company_industry_i';
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'company_industry_i',
					'source' => Yii::app()->controller->createUrl('o/industry/suggest', array('data'=>'company','id'=>$model->company_id)),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$.ajax({
								type: 'post',
								url: '$url',
								data: { company_id: '$company', industry_id: ui.item.id, industry: ui.item.value },
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
				echo $form->error($model,'company_industry_i');?>
				<div id="industry-suggest" class="suggest clearfix">
					<?php
					$industries = $model->industries;
					if(!empty($industries)) {
						foreach($industries as $key => $val) {?>
						<div><?php echo $val->industry->view->industry_name;?><?php echo $val->publish == 0 ? ' '.Yii::t('phrase', '(Unpublish)') : ''?></div>
					<?php }
					}?>
				</div>
				<?php if($model->isNewRecord) {?><span class="small-px">tambahkan tanda koma (,) jika ingin menambahkan keyword lebih dari satu</span><?php }?>
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


