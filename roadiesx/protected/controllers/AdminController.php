<?php
	
class AdminController extends Controller {
	public $layout = '//layouts/admin_column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'infuseMoney', 'analytics'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex() {		
		$this->redirect(array('events/index'));
	}
	
	public function actionInfuseMoney() {
		$model = new MoneyInfuseForm;
		if(isset($_POST['MoneyInfuseForm']))
		{
			$model->attributes=$_POST['MoneyInfuseForm'];
			if($model->save(true,$model->attributes ))
				$this->redirect(array('events/index'));
		}
		
		$this->render('/site/infuseMoney',array('model'=>$model));
	}
	
	public function actionAnalytics() {
		$this->render('/site/analytics');
	}
	
} 

?>