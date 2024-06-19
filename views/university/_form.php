<?php
/**
 * Ipedia Universities (ipedia-universities)
 * @var $this app\components\View
 * @var $this ommu\ipedia\controllers\UniversityController
 * @var $model ommu\ipedia\models\IpediaUniversities
 * @var $form app\components\widgets\ActiveForm
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 25 June 2019, 14:17 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

use yii\helpers\Html;
use app\components\widgets\ActiveForm;
?>

<div class="ipedia-universities-form">

<?php $form = ActiveForm::begin([
	'options' => ['class' => 'form-horizontal form-label-left'],
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
	'fieldConfig' => [
		'errorOptions' => [
			'encode' => false,
		],
	],
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'company_id')
	->textInput(['type' => 'number', 'min' => '1'])
	->label($model->getAttributeLabel('company_id')); ?>

<?php echo $form->field($model, 'education_type')
	->textarea(['rows' => 6, 'cols' => 50])
	->label($model->getAttributeLabel('education_type')); ?>

<?php 
if ($model->isNewRecord && !$model->getErrors()) {
    $model->publish = 1;
}
echo $form->field($model, 'publish')
	->checkbox()
	->label($model->getAttributeLabel('publish')); ?>

<hr/>

<?php echo $form->field($model, 'submitButton')
	->submitButton(); ?>

<?php ActiveForm::end(); ?>

</div>