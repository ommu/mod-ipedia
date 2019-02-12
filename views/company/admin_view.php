<?php
/**
 * Ipedia Companies (ipedia-companies)
 * @var $this app\components\View
 * @var $this ommu\ipedia\controllers\CompanyController
 * @var $model ommu\ipedia\models\IpediaCompanies
 *
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 12 February 2019, 11:16 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->company_name;

$this->params['menu']['content'] = [
	['label' => Yii::t('app', 'Back To Manage'), 'url' => Url::to(['manage']), 'icon' => 'table'],
	['label' => Yii::t('app', 'Detail'), 'url' => Url::to(['view', 'id'=>$model->company_id]), 'icon' => 'eye'],
	['label' => Yii::t('app', 'Update'), 'url' => Url::to(['update', 'id'=>$model->company_id]), 'icon' => 'pencil'],
	['label' => Yii::t('app', 'Delete'), 'url' => Url::to(['delete', 'id'=>$model->company_id]), 'htmlOptions' => ['data-confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'), 'data-method'=>'post'], 'icon' => 'trash'],
];
?>

<div class="ipedia-companies-view">

<?php echo DetailView::widget([
	'model' => $model,
	'options' => [
		'class'=>'table table-striped detail-view',
	],
	'attributes' => [
		'company_id',
		[
			'attribute' => 'publish',
			'value' => $this->quickAction(Url::to(['publish', 'id'=>$model->primaryKey]), $model->publish, '0=unpublish, 1=publish, 2=trash, 3=admin_checked'),
			'format' => 'raw',
		],
		[
			'attribute' => 'memberDisplayname',
			'value' => function ($model) {
				$memberDisplayname = isset($model->member) ? $model->member->displayname : '-';
				if($memberDisplayname != '-')
					return Html::a($memberDisplayname, ['member/view', 'id'=>$model->member_id], ['title'=>$memberDisplayname]);
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
				if($directoryName != '-')
					return Html::a($directoryName, ['directory/view', 'id'=>$model->directory_id], ['title'=>$directoryName]);
				return $directoryName;
			},
			'format' => 'html',
		],
		[
			'attribute' => 'creation_date',
			'value' => Yii::$app->formatter->asDatetime($model->creation_date, 'medium'),
		],
		[
			'attribute' => 'creationDisplayname',
			'value' => isset($model->creation) ? $model->creation->displayname : '-',
		],
		[
			'attribute' => 'modified_date',
			'value' => Yii::$app->formatter->asDatetime($model->modified_date, 'medium'),
		],
		[
			'attribute' => 'modifiedDisplayname',
			'value' => isset($model->modified) ? $model->modified->displayname : '-',
		],
		[
			'attribute' => 'updated_date',
			'value' => Yii::$app->formatter->asDatetime($model->updated_date, 'medium'),
		],
		[
			'attribute' => 'achievements',
			'value' => Html::a($model->achievements, ['achievement/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} achievements', ['count'=>$model->achievements])]),
			'format' => 'html',
		],
		[
			'attribute' => 'experiences',
			'value' => Html::a($model->experiences, ['experience/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} experiences', ['count'=>$model->experiences])]),
			'format' => 'html',
		],
		[
			'attribute' => 'organizations',
			'value' => Html::a($model->organizations, ['organization/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} organizations', ['count'=>$model->organizations])]),
			'format' => 'html',
		],
		[
			'attribute' => 'referees',
			'value' => Html::a($model->referees, ['referee/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} referees', ['count'=>$model->referees])]),
			'format' => 'html',
		],
		[
			'attribute' => 'trainings',
			'value' => Html::a($model->trainings, ['training/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} trainings', ['count'=>$model->trainings])]),
			'format' => 'html',
		],
		[
			'attribute' => 'industries',
			'value' => Html::a($model->industries, ['industry/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} industries', ['count'=>$model->industries])]),
			'format' => 'html',
		],
		[
			'attribute' => 'universities',
			'value' => Html::a($model->universities, ['university/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} universities', ['count'=>$model->universities])]),
			'format' => 'html',
		],
		[
			'attribute' => 'companies',
			'value' => Html::a($model->companies, ['company/manage', 'company'=>$model->primaryKey], ['title'=>Yii::t('app', '{count} companies', ['count'=>$model->companies])]),
			'format' => 'html',
		],
		[
			'attribute' => 'projects',
			'value' => Html::a($model->projects, ['project/manage', 'company'=>$model->primaryKey, 'publish'=>1], ['title'=>Yii::t('app', '{count} projects', ['count'=>$model->projects])]),
			'format' => 'html',
		],
	],
]); ?>

</div>