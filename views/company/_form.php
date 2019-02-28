<?php
/**
 * Ipedia Companies (ipedia-companies)
 * @var $this app\components\View
 * @var $this ommu\ipedia\controllers\CompanyController
 * @var $model ommu\ipedia\models\IpediaCompanies
 * @var $form app\components\ActiveForm
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 12 February 2019, 11:16 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

use yii\helpers\Html;
use app\components\ActiveForm;
use ommu\ipedia\models\IpediaCompanies;
?>

<div class="ipedia-companies-form">

<?php $form = ActiveForm::begin([
	'options' => ['class'=>'form-horizontal form-label-left'],
	'enableClientValidation' => true,
	'enableAjaxValidation' => false,
	//'enableClientScript' => true,
]); ?>

<?php //echo $form->errorSummary($model);?>

<?php echo $form->field($model, 'company_name')
	->textInput()
	->label($model->getAttributeLabel('company_name')); ?>

<?php echo $form->field($model, 'member_id')
	->textInput(['type'=>'number', 'min'=>'1'])
	->label($model->getAttributeLabel('member_id')); ?>

<?php $publish = IpediaCompanies::getPublish();
echo $form->field($model, 'publish')
	->dropDownList($publish, ['prompt' => ''])
	->label($model->getAttributeLabel('publish')); ?>

<div class="ln_solid"></div>
<div class="form-group row">
	<div class="col-md-6 col-sm-9 col-xs-12 col-12 offset-sm-3">
		<?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
	</div>
</div>

<?php ActiveForm::end(); ?>

</div>