<?php
/**
 * Ipedia Universities (ipedia-universities)
 * @var $this app\components\View
 * @var $this ommu\ipedia\controllers\UniversityController
 * @var $model ommu\ipedia\models\IpediaUniversities
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 25 June 2019, 14:17 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Universities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->company->company_name;

if (!$small) {
    $this->params['menu']['content'] = [
        ['label' => Yii::t('app', 'Detail'), 'url' => Url::to(['view', 'id' => $model->university_id]), 'icon' => 'eye', 'htmlOptions' => ['class' => 'btn btn-info']],
        ['label' => Yii::t('app', 'Update'), 'url' => Url::to(['update', 'id' => $model->university_id]), 'icon' => 'pencil', 'htmlOptions' => ['class' => 'btn btn-primary']],
        ['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id' => $model->university_id]), 'htmlOptions' => ['data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method' => 'post', 'class' => 'btn btn-danger'], 'icon' => 'trash'],
    ];
} ?>

<div class="ipedia-universities-view">

<?php
$attributes = [
	'university_id',
	[
		'attribute' => 'publish',
		'value' => $model->quickAction(Url::to(['publish', 'id' => $model->primaryKey]), $model->publish, '0=unpublish, 1=publish, 2=trash, 3=admin_checked'),
		'format' => 'raw',
		'visible' => !$small,
	],
	[
		'attribute' => 'companyName',
		'value' => function ($model) {
			$companyName = isset($model->company) ? $model->company->company_name : '-';
            if ($companyName != '-') {
                return Html::a($companyName, ['company/view', 'id' => $model->company_id], ['title' => $companyName, 'class' => 'modal-btn']);
            }
			return $companyName;
		},
		'format' => 'html',
	],
	[
		'attribute' => 'education_type',
		'value' => serialize($model->education_type),
	],
	[
		'attribute' => 'creation_date',
		'value' => Yii::$app->formatter->asDatetime($model->creation_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'creationDisplayname',
		'value' => isset($model->creation) ? $model->creation->displayname : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'modified_date',
		'value' => Yii::$app->formatter->asDatetime($model->modified_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => 'modifiedDisplayname',
		'value' => isset($model->modified) ? $model->modified->displayname : '-',
		'visible' => !$small,
	],
	[
		'attribute' => 'updated_date',
		'value' => Yii::$app->formatter->asDatetime($model->updated_date, 'medium'),
		'visible' => !$small,
	],
	[
		'attribute' => '',
		'value' => Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->primaryKey], ['title' => Yii::t('app', 'Update'), 'class' => 'btn btn-primary btn-sm']),
		'format' => 'html',
		'visible' => !$small && Yii::$app->request->isAjax ? true : false,
	],
];

echo DetailView::widget([
	'model' => $model,
	'options' => [
		'class' => 'table table-striped detail-view',
	],
	'attributes' => $attributes,
]); ?>

</div>