<?php
class ASystemUserController extends AController {
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
     public function action(){
            
     }
	public function accessRules()
	{
		return array(
			array('allow',
                'actions' => array('changepass'),
                'users'=>array('*'),
            ),
			array('allow',
                'actions' => array('admin','view','changepassword'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
            ),
            array('allow',
                'actions' => array('update','active','activeAll','unActiveAll','permission'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
            ),
            array('allow',
                'actions' => array('create'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"add")',
            ),
            array('allow',
                'actions' => array('admin','delete','deleteAll'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"del")',
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionChangePassword(){
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $new_pass = isset($_POST['password']) ? $_POST['password'] : '';
        $passmd5 = SystemUser::encrypt($new_pass,Yii::app()->params->hashkey);
        //$changePass = SystemUser::model()->updateByPk($id,array('password'=>$passmd5),new CDbCriteria(array('condition'=>'id = :id', 'params'=>array('id'=>$user_id))));
        //var_dump(ASystemUser::changePass($user_id,$passmd5));exit();
        if(ASystemUser::changePass($user_id,$passmd5)){
            $arrReturn = array('status' => true,'msg' => Yii::t('adm/app','LBL_SUCCESS'),'stt_value' => $passmd5);
        }else{
            $arrReturn = array('status' => false,'msg' => Yii::t('adm/app','LBL_UNSUCCESS'));
        }
        
        echo  CJSON::encode($arrReturn);
        exit(); 
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $user = $this->loadModel($id);
	   /*get group permission*/
        $permissionCache = Yii::app()->cache->get('group_per_'.$user->group_id);
        if($permissionCache === false){
            $permission = AGroupPermission::model()->findAll(
                'group_id = :group_id',
                array(
                    ':group_id' => $user->group_id,
                )
            );
            Yii::app()->cache->set('group_per_'.$user->group_id, $permission, 1000);
            $permissionCache = Yii::app()->cache->get('group_per_'.$user->group_id);
        }
        
        $arrayGroupPermission = array();
        foreach($permissionCache as $row){
            $arrayGroupPermission[$row['controller']] = unserialize($row['permission']);
        }
        /*get user permission*/
        $uerPermission = ASystemUserPermission::model()->findAll(
            'user_id = :user_id',
            array(
                ':user_id' => $id,
            )
        );
        $arrayUserPermission = array();
        if(is_array($uerPermission)){
            foreach($uerPermission as $row){
                $arrayUserPermission[$row['controller']] = unserialize($row['permission']);
            }
        }
        
        
        $resutUserPermission = array_merge($arrayGroupPermission,$arrayUserPermission);
        
	   /* get all controller */
        $arrayController = array();
        $declaredClasses = get_declared_classes();
        foreach (glob(Yii::getPathOfAlias('application.adm.controllers') . "/*Controller.php") as $controller){
            $class = basename($controller, ".php");
            $arrayController[] = $class;
        }
        $index = 1;
        if(is_array($arrayController)){
            foreach($arrayController as $item){
                $temp['id'] = $index;
                $temp['name'] = $item;
                if(isset($resutUserPermission[$item])){
                    $temp['permission'] = array(
                        'view' => in_array("view",$resutUserPermission[$item])?true:false,
                        'publish' => in_array("publish",$resutUserPermission[$item])?true:false,
                        'add' => in_array("add",$resutUserPermission[$item])?true:false,
                        'edit' => in_array("edit",$resutUserPermission[$item])?true:false,
                        'del' => in_array("del",$resutUserPermission[$item])?true:false,
                    );
                }else{
                    $temp['permission'] = array(
                        'view' => false,
                        'publish' => false,
                        'add' => false,
                        'edit' => false,
                        'del' => false
                    );
                }
                $index++;
                $rawData[] = $temp;
            }
        }
        
    	$arrayDataProvider=new CArrayDataProvider($rawData, array(
    		'id'=>'id',
    		/* 'sort'=>array(
    			'attributes'=>array(
    				'username', 'email',
    			),
    		), */
    		'pagination'=>array(
    			'pageSize'=>100,
    		),
    	));
	   
       /* get list user in group */
	   $bSystemUserDataProvider = new CActiveDataProvider('ASystemUser', array(
                    'criteria' => array(
                        'condition' => 'group_id=:groupId',
                        'params' => array(':groupId' => $id),
                    ),
                    'pagination' => array(
                        'pageSize' => 2,
                    ),
                ));
	   
       
       
		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'arrayDataProvider' => $arrayDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ASystemUser;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['ASystemUser']))
		{ //var_dump($_POST['SystemUser']); exit();
			$model->attributes=$_POST['ASystemUser'];
            //var_dump(Yii::app()->params->hashkey); exit();
            $model->id = Utils::GUID();
            $model->created_date = date("ymdHis");
            $model->password = SystemUser::encrypt($_POST['ASystemUser']['password'],Yii::app()->params->hashkey);
            $model->phonenumber = $_POST['ASystemUser']['phonenumber'];
            $model->cp_code = $_POST['ASystemUser']['cp_code'];
            if(isset($_POST['ASystemUser']['channel_code'])){
                $model->channel_code = serialize($_POST['ASystemUser']['channel_code']);
            }else{
                Yii::app()->user->setFlash('unsuccess', Yii::t('adm/user','select_channel'));
			    $this->redirect(array('create'));
            }
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('adm/user','success_user')." <b>$model->username</b>");
			    $this->redirect(array('admin'));
            }
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

		if(isset($_POST['SystemUser']))
		{
			//$model->attributes=$_POST['SystemUser'];
            $model->created_date = date("ymdHis");
            
            //$model->password = SystemUser::encrypt($_POST['SystemUser']['password'],Yii::app()->params->hashkey);
            //$model->password = $_POST['SystemUser']['password'];
            //var_dump($_POST['SystemUser']['phonenumber']); exit();
            
            $model->status = $_POST['SystemUser']['status'];
            $model->email = $_POST['SystemUser']['email'];
            $model->phonenumber = $_POST['SystemUser']['phonenumber'];
            $model->cp_code = $_POST['SystemUser']['cp_code'];
            $model->group_id = $_POST['SystemUser']['group_id'];
            $model->channel_code = serialize($_POST['SystemUser']['channel_code']);
            
			if($model->save()){
			     Yii::app()->user->setFlash('success', "Bạn đã cập nhật thành công <b>$model->username</b>");
                 
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    
    /**
     * Active a system user
    */

    public function actionActive(){
        $id = Yii::app()->getRequest()->getParam('userId');
        $status = Yii::app()->getRequest()->getParam('status');
            $status_new = ($status==1)?0:1;
            $value = ($status_new ==1)?('<span class="active">'.Yii::t('app','actived').'</span>'):('<span class="inactive">'.Yii::t('app','inactived').'</span>');
            
            //$sql = "Update {{categorynews}} SET status = '$status_new' WHERE id =".$id;
            //$command = Yii::app()->db->createCommand($sql);
            $excu_active = SystemUser::model()->updateByPk($id,array('status'=>$status_new),new CDbCriteria(array('condition'=>'id = :id', 'params'=>array('id'=>$id))));
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
     /*
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SystemUser');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    */
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SystemUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SystemUser']))
			$model->attributes=$_GET['SystemUser'];

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
		$model=SystemUser::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionActiveAll() {
        $ids = $_REQUEST['ids'];
        $status = $_REQUEST['status'];
        $crit = new CDbCriteria();
        $crit->condition = "id IN ($ids)";
        $models = SystemUser::model()->findAll($crit);
        foreach ($models as $model) {
            $model->status = $status;
            $model->update();
        }
        Yii::app()->user->setFlash('success', "Successfull");
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDeleteAll() {
        $ids = $_REQUEST['ids'];
        $crit = new CDbCriteria();
        $crit->condition = "id IN ($ids)";
        SystemUser::model()->deleteAll($crit);
        Yii::app()->user->setFlash('success', "Ðã xóa thành công");
        $this->redirect(Yii::app()->request->urlReferrer);
    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='system-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionPermission(){
        $user = $this->loadModel($_REQUEST['id']);
	       /*get group permission*/
        $permission = AGroupPermission::model()->findAll(
            'group_id = :group_id',
            array(
                ':group_id' => $user->group_id,
            )
        );
        $arrayGroupPermission = array();
        foreach($permission as $row){
            $arrayGroupPermission[$row['controller']] = unserialize($row['permission']);
        }
        
        
        $arrayController = array();
        $declaredClasses = get_declared_classes();
        foreach (glob(Yii::getPathOfAlias('application.adm.controllers') . "/*Controller.php") as $controller){
            $class = basename($controller, ".php");
            //check exist user permission 
            $objBSystemUserPermission = ASystemUserPermission::model()->find(array(
                'select' => 'permission',
                'condition' => 'user_id = :userId AND controller = :controller',
                'params' => array(
                    ':userId' => $_REQUEST['id'],
                    ':controller' => $class,
                )
            ));
            if(isset($_REQUEST[$class])){
                if($objBSystemUserPermission){
                    if(unserialize($objBSystemUserPermission->permission) === $_REQUEST[$class]){
                        
                    }else{
                        //update
                        ASystemUserPermission::model()->updateAll(
                            array(
                                'permission' => serialize($_REQUEST[$class])
                            ),
                            'user_id = :user_id AND controller = :controller',
                            array(
                                ':user_id' => $_REQUEST['id'],
                                ':controller' => $class
                            )
                        );
                    }
                }else{
                    /*get user permission*/
                        $uerPermission = ASystemUserPermission::model()->findAll(
                            'user_id = :user_id',
                            array(
                                ':user_id' => $_REQUEST['id'],
                            )
                        );
                        $arrayUserPermission = array();
                        if(is_array($uerPermission)){
                            foreach($uerPermission as $row){
                                $arrayUserPermission[$row['controller']] = unserialize($row['permission']);
                            }
                        }
                    if(isset($arrayUserPermission[$class]) && ($arrayUserPermission[$class] === $_REQUEST[$class])){
                        
                    }else{
                        //insert
                        $bSystemUserPermission = new ASystemUserPermission();
                        $bSystemUserPermission->controller = $class;
                        $bSystemUserPermission->user_id = $_REQUEST['id'];
                        $bSystemUserPermission->permission = serialize($_REQUEST[$class]);
                        $bSystemUserPermission->insert();
                    }
                }
            }else{
                if(isset($arrayGroupPermission[$class])){
                   if(!$objBSystemUserPermission){
                        $bSystemUserPermission = new ASystemUserPermission();
                        $bSystemUserPermission->controller = $class;
                        $bSystemUserPermission->user_id = $_REQUEST['id'];
                        $bSystemUserPermission->permission = serialize(array());
                        $bSystemUserPermission->insert();
                   }else{
                        ASystemUserPermission::model()->updateAll(
                            array(
                                'permission' => serialize(array())
                            ),
                            'user_id = :user_id AND controller = :controller',
                            array(
                                ':user_id' => $_REQUEST['id'],
                                ':controller' => $class
                            )
                        );
                   }
                }
                else
                {
                    $aSystemUserPermission = ASystemUserPermission::model()->find(
                        'user_id = :user_id AND controller = :controller',
                        array(
                            ':user_id' => $_REQUEST['id'],
                            ':controller' => $class
                        )
                        
                    );
                    if($aSystemUserPermission === null){
                        $aSystemUserPermission = new ASystemUserPermission;
                        $aSystemUserPermission->user_id = $_REQUEST['id'];
                        $aSystemUserPermission->controller = $class;
                        $aSystemUserPermission->permission = serialize(array());
                        $aSystemUserPermission->save();
                    }else{
                        ASystemUserPermission::model()->updateAll(
                            array(
                                'permission' => serialize(array())
                            ),
                            'user_id = :user_id AND controller = :controller',
                            array(
                                ':user_id' => $_REQUEST['id'],
                                ':controller' => $class
                            )
                        );
                    }
                    
                }
            }
            
        }
        Yii::app()->user->setFlash('success', "Bạn đã sửa quyền thành công");
        $this->redirect(array('view','id'=>$_REQUEST['id']));
    }
    
    
}
?>