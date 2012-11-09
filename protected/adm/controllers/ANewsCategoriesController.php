<?php

class ANewsCategoriesController extends AController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow',
                'actions' => array('index','view'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
            ),
            array('allow',
                'actions' => array('update','active'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
            ),
            array('allow',
                'actions' => array('create','active'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
            ),
            array('allow',
                'actions' => array('admin','delete'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"del")',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ANewsCategories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ANewsCategories']))
		{
			$model->attributes=$_POST['ANewsCategories'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ANewsCategories']))
		{
			$model->attributes=$_POST['ANewsCategories'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ANewsCategories');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
    public function actionActive(){
        $id = Yii::app()->getRequest()->getParam('id');
        $status = Yii::app()->getRequest()->getParam('status');
            $status_new = ($status==1)?0:1;
            $value = ($status_new ==1)?('<span class="active">'.Yii::t('app','actived').'</span>'):('<span class="inactive">'.Yii::t('app','inactived').'</span>');
            
            //$sql = "Update {{categorynews}} SET status = '$status_new' WHERE id =".$id;
            //$command = Yii::app()->db->createCommand($sql);
            $excu_active = ANewsCategories::model()->updateByPk($id,array('status'=>$status_new),new CDbCriteria(array('condition'=>'id = :id', 'params'=>array('id'=>$id))));
            //Post::model()->updateByPk($pks, new CDbCriteria(array('condition'=>'author_id = :author_id', 'params'=>array('author_id'=>$myId))));
            if($excu_active){
                $arrReturn = array('status' => true,'msg' => Yii::t('adm/app','LBL_SUCCESS'),'value' => $value,'stt_value' => $status_new);
            }else{
                $arrReturn = array('status' => false,'msg' => Yii::t('adm/app','LBL_UNSUCCESS'));
            }
        
        echo  CJSON::encode($arrReturn);
        exit();    
    }
    
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ANewsCategories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ANewsCategories']))
			$model->attributes=$_GET['ANewsCategories'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ANewsCategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='anews-categories-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
