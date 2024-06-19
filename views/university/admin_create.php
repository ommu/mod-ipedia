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
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>

<div class="ipedia-universities-create">

<?php echo $this->render('_form', [
	'model' => $model,
]); ?>

</div>
