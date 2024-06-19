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

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Universities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company->company_name, 'url' => ['view', 'id' => $model->university_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Detail'), 'url' => Url::to(['view', 'id' => $model->university_id]), 'icon' => 'eye', 'htmlOptions' => ['class' => 'btn btn-info']],
	['label' => Yii::t('app', 'Update'), 'url' => Url::to(['update', 'id' => $model->university_id]), 'icon' => 'pencil', 'htmlOptions' => ['class' => 'btn btn-primary']],
	['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id' => $model->university_id]), 'htmlOptions' => ['data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'class' => 'btn btn-danger'], 'icon' => 'trash'],
];
?>

<div class="ipedia-universities-update">

<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

</div>