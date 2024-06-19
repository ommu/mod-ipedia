<?php
/**
 * Ipedia Universities (ipedia-universities)
 * @var $this app\components\View
 * @var $this ommu\ipedia\controllers\UniversityController
 * @var $model ommu\ipedia\models\IpediaUniversities
 * @var $searchModel ommu\ipedia\models\search\IpediaUniversities
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
use app\components\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use ommu\cat=university\models\IpediaCompanies;

$this->params['breadcrumbs'][] = $this->title;

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Add University'), 'url' => Url::to(['create']), 'icon' => 'plus-square', 'htmlOptions' => ['class' => 'btn btn-success']],
];
$this->params['menu']['option'] = [
	//['label' => Yii::t('app', 'Search'), 'url' => 'javascript:void(0);'],
	['label' => Yii::t('app', 'Grid Option'), 'url' => 'javascript:void(0);'],
];
?>

<div class="ipedia-universities-manage">
<?php Pjax::begin(); ?>

<?php if ($company != null) {
$model = $company;
echo DetailView::widget([
	'model' => $model,
	'options' => [
		'class' => 'table table-striped detail-view',
	],
	'attributes' => [
		[
			'attribute' => 'memberDisplayname',
			'value' => function ($model) {
				$memberDisplayname = isset($model->member) ? $model->member->displayname : '-';
                if ($memberDisplayname != '-') {
                    return Html::a($memberDisplayname, ['member/view', 'id' => $model->member_id], ['title' => $memberDisplayname, 'class' => 'modal-btn']);
                }
				return $memberDisplayname;
			},
			'format' => 'html',
		],
		[
			'attribute' => 'company_name',
			'value' => $model->company_name ? $model->company_name : '-',
		],
		[
			'attribute' => 'directoryName',
			'value' => function ($model) {
				$directoryName = isset($model->directory) ? $model->directory->directory_name : '-';
                if ($directoryName != '-') {
                    return Html::a($directoryName, ['directory/view', 'id' => $model->directory_id], ['title' => $directoryName, 'class' => 'modal-btn']);
                }
				return $directoryName;
			},
			'format' => 'html',
		],
	],
]);
}?>

<?php //echo $this->render('_search', ['model' => $searchModel]); ?>

<?php echo $this->render('_option_form', ['model' => $searchModel, 'gridColumns' => $searchModel->activeDefaultColumns($columns), 'route' => $this->context->route]); ?>

<?php
$columnData = $columns;
array_push($columnData, [
	'class' => 'app\components\grid\ActionColumn',
	'header' => Yii::t('app', 'Option'),
	'urlCreator' => function($action, $model, $key, $index) {
        if ($action == 'view') {
            return Url::to(['view', 'id' => $key]);
        }
        if ($action == 'update') {
            return Url::to(['update', 'id' => $key]);
        }
        if ($action == 'delete') {
            return Url::to(['delete', 'id' => $key]);
        }
	},
	'buttons' => [
		'view' => function ($url, $model, $key) {
			return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'Detail')]);
		},
		'update' => function ($url, $model, $key) {
			return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'Update')]);
		},
		'delete' => function ($url, $model, $key) {
			return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
				'title' => Yii::t('app', 'Delete'),
				'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'data-method'  => 'post',
			]);
		},
	],
	'template' => '{view} {update} {delete}',
]);

echo GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => $columnData,
]); ?>

<?php Pjax::end(); ?>
</div>