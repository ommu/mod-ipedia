<?php
/**
 * PositionskillController
 * @var $this PositionskillController
 * @var $model IpediaPositionSkill
 * @var $form CActiveForm
 *
 * Reference start
 * TOC :
 *	Index
 *	Add
 *	Manage
 *	View
 *	Runaction
 *	Delete
 *	Publish
 *
 *	LoadModel
 *	performAjaxValidation
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2017 Ommu Platform (www.ommu.co)
 * @created date 3 March 2017, 15:38 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 *----------------------------------------------------------------------------------------------------------
 */

class PositionskillController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index';

	/**
	 * Initialize admin page theme
	 */
	public function init() 
	{
		if(!Yii::app()->user->isGuest) {
			if(in_array(Yii::app()->user->level, array(1,2))) {
				$arrThemes = $this->currentTemplate('admin');
				Yii::app()->theme = $arrThemes['folder'];
				$this->layout = $arrThemes['layout'];
			}
		} else
			$this->redirect(Yii::app()->createUrl('site/login'));
	}

	/**
	 * @return array action filters
	 */
	public function filters() 
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() 
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level)',
				//'expression'=>'isset(Yii::app()->user->level) && (Yii::app()->user->level != 1)',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('add','manage','view','runaction','delete','publish'),
				'users'=>array('@'),
				'expression'=>'isset(Yii::app()->user->level) && in_array(Yii::app()->user->level, array(1,2))',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() 
	{
		$this->redirect(array('manage'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd() 
	{
		$model=new IpediaPositionSkill;
		
		$condition = 0;
		if(isset($_POST['position_id'], $_POST['skill_id'], $_POST['position']))
			$condition = 1;
		if(isset($_POST['position_id'], $_POST['skill_id'], $_POST['skill']))
			$condition = 2;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if($condition != 0) {
			$model->position_id = $_POST['position_id'];
			$model->skill_id = $_POST['skill_id'];
			if($condition == 1)
				$model->position_name_i = $_POST['position'];
			if($condition == 2)
				$model->skill_name_i = $_POST['skill'];

			if($model->save()) {
				if(Yii::app()->getRequest()->getParam('type') == 'ipedia')
					$url = Yii::app()->controller->createUrl('delete', array('id'=>$model->id,'type'=>'ipedia'));
				else 
					$url = Yii::app()->controller->createUrl('delete', array('id'=>$model->id));
				if($condition == 1)
					$desc_name = $model->publish == 0 ? $model->position->position_name.' '.Yii::t('phrase', '(Unpublish)') : $model->position->position_name;
				if($condition == 2)
					$desc_name = $model->publish == 0 ? $model->skill->view->skill_name.' '.Yii::t('phrase', '(Unpublish)') : $model->skill->view->skill_name;
				echo CJSON::encode(array(
					'data' => '<div>'.$desc_name.'</div>',
				));
			}
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionManage() 
	{
		$model=new IpediaPositionSkill('search');
		$model->unsetAttributes();	// clear any default values
		if(isset($_GET['IpediaPositionSkill'])) {
			$model->attributes=$_GET['IpediaPositionSkill'];
		}

		$columns = $model->getGridColumn($this->gridColumnTemp());

		$this->pageTitle = Yii::t('phrase', 'Ipedia Position Skills Manage');
		$this->pageDescription = '';
		$this->pageMeta = '';
		$this->render('/o/position_skill/admin_manage', array(
			'model'=>$model,
			'columns' => $columns,
		));
	}	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) 
	{
		$model=$this->loadModel($id);
		
		$this->dialogDetail = true;
		$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
		$this->dialogWidth = 600;

		$this->pageTitle = Yii::t('phrase', 'View Ipedia Position Skills');
		$this->pageDescription = '';
		$this->pageMeta = $setting->meta_keyword;
		$this->render('/o/position_skill/admin_view', array(
			'model'=>$model,
		));
	}	

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionRunaction() {
		$id       = $_POST['trash_id'];
		$criteria = null;
		$actions  = Yii::app()->getRequest()->getParam('action');

		if(count($id) > 0) {
			$criteria = new CDbCriteria;
			$criteria->addInCondition('id', $id);

			if($actions == 'publish') {
				IpediaPositionSkill::model()->updateAll(array(
					'publish' => 1,
				),$criteria);
			} elseif($actions == 'unpublish') {
				IpediaPositionSkill::model()->updateAll(array(
					'publish' => 0,
				),$criteria);
			} elseif($actions == 'trash') {
				IpediaPositionSkill::model()->updateAll(array(
					'publish' => 2,
				),$criteria);
			} elseif($actions == 'delete') {
				IpediaPositionSkill::model()->deleteAll($criteria);
			}
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!Yii::app()->getRequest()->getParam('ajax')) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('manage'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) 
	{
		$model=$this->loadModel($id);
		
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				if($model->delete()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-ipedia-position-skill',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'IpediaPositionSkill success deleted.').'</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = Yii::t('phrase', 'IpediaPositionSkill Delete.');
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('/o/position_skill/admin_delete');
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionPublish($id) 
	{
		$model=$this->loadModel($id);
		
		if($model->publish == 1) {
			$title = Yii::t('phrase', 'Unpublish');
			$replace = 0;
		} else {
			$title = Yii::t('phrase', 'Publish');
			$replace = 1;
		}

		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			if(isset($id)) {
				//change value active or publish
				$model->publish = $replace;

				if($model->update()) {
					echo CJSON::encode(array(
						'type' => 5,
						'get' => Yii::app()->controller->createUrl('manage'),
						'id' => 'partial-ipedia-position-skill',
						'msg' => '<div class="errorSummary success"><strong>'.Yii::t('phrase', 'IpediaPositionSkill success updated.').'</strong></div>',
					));
				}
			}

		} else {
			$this->dialogDetail = true;
			$this->dialogGroundUrl = Yii::app()->controller->createUrl('manage');
			$this->dialogWidth = 350;

			$this->pageTitle = $title;
			$this->pageDescription = '';
			$this->pageMeta = '';
			$this->render('/o/position_skill/admin_publish', array(
				'title'=>$title,
				'model'=>$model,
			));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) 
	{
		$model = IpediaPositionSkill::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, Yii::t('phrase', 'The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) 
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ipedia-position-skill-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
