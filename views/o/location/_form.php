<?php
/**
 * Ipedia Directory Locations (ipedia-directory-location)
 * @var $this LocationController
 * @var $model IpediaDirectoryLocation
 * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 15:37 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */
?>

<?php $form=$this->beginWidget('application.libraries.core.components.system.OActiveForm', array(
	'id'=>'ipedia-directory-location-form',
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

		<?php if($model->isNewRecord && $directory == null) {?>
			<div class="clearfix">
				<?php echo $form->labelEx($model,'directory_name_i'); ?>
				<div class="desc">
					<?php if(!$model->isNewRecord && !$model->getErrors())
						$model->directory_name_i = $model->view->directory_name;
					//echo $form->textField($model,'directory_name_i', array('class'=>'span-8'));
					$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
						'model' => $model,
						'attribute' => 'directory_name_i',
						'source' => Yii::app()->controller->createUrl('o/directory/suggest'),
						'options' => array(
							//'delay '=> 50,
							'minLength' => 1,
							'showAnim' => 'fold',
							'select' => "js:function(event, ui) {
								$('#IpediaDirectoryLocation_directory_name_i').val(ui.item.value);
								$('#IpediaDirectoryLocation_directory_id').val(ui.item.id);
							}"
						),
						'htmlOptions' => array(
							'class'	=> 'span-8',
						),
					));
					echo $form->hiddenField($model,'directory_id');?>
					<?php echo $form->error($model,'directory_name_i'); ?>
					<?php /*<div class="small-px silent"></div>*/?>
				</div>
			</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'address'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'address', array('rows'=>6, 'cols'=>50, 'class'=>'span-10 smaller')); ?>
				<?php echo $form->error($model,'address'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'city_name_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'city_id', array('maxlength'=>11));
				if(!$model->getErrors())
					$model->city_name_i = $model->view->city_name;
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'city_name_i',
					'source' => Yii::app()->createUrl('zonecity/suggest'),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$('#IpediaDirectoryLocation_city_name_i').val(ui.item.value);
							$('#IpediaDirectoryLocation_city_id').val(ui.item.id);
						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->hiddenField($model,'city_id');?>
				<?php echo $form->error($model,'city_name_i'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'district_name_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'district_id', array('maxlength'=>11));
				if(!$model->getErrors())
					$model->district_name_i = $model->view->district_name;
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'district_name_i',
					'source' => Yii::app()->createUrl('zonedistrict/suggest'),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$('#IpediaDirectoryLocation_district_name_i').val(ui.item.value);
							$('#IpediaDirectoryLocation_district_id').val(ui.item.id);
						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->hiddenField($model,'district_id'); ?>
				<?php echo $form->error($model,'district_name_i'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'village_name_i'); ?>
			<div class="desc">
				<?php //echo $form->textField($model,'village_id', array('maxlength'=>11));
				if(!$model->getErrors())
					$model->village_name_i = $model->view->village_name;
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'village_name_i',
					'source' => Yii::app()->createUrl('zonevillage/suggest'),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$('#IpediaDirectoryLocation_village_name_i').val(ui.item.value);
							$('#IpediaDirectoryLocation_village_id').val(ui.item.id);
						}"
					),
					'htmlOptions' => array(
						'class'	=> 'span-6',
					),
				));
				echo $form->hiddenField($model,'village_id'); ?>
				<?php echo $form->error($model,'village_name_i'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'headquarters'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'headquarters'); ?>
				<?php echo $form->labelEx($model,'headquarters'); ?>
				<?php echo $form->error($model,'headquarters'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

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


