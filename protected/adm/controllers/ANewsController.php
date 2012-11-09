<?php

class ANewsController extends AController
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
                'actions' => array('update','permission','active','activeAll','unActiveAll','deleteAll'),
                'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
            ),
            array('allow',
                'actions' => array('create','permission','active','upload','imageupload'),
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
    
    public function actionImageUpload()
    {
        if(isset($_FILES['file']) && $_FILES['file'])
    	{
	        require(Yii::app()->basePath.'/components/upload.class.php');
	        $handle = new upload($_FILES['file']);
	        $img_arr = array();
			$file_info = AFunction::generate_file_name('news');
			$_filename = $file_info['name'];
	        $_filepath =  realpath(Yii::app()->getBasePath().'/../uploads/')."/".$file_info['physical_path'];
			if($handle->uploaded){
				//check extension
				if (!in_array($handle->file_src_name_ext, array('gif','jpg','jpeg','pjpeg'))){
					//$this->error->add('ERROR_UPLOAD', $this->language->getMsg('YOU_CAN_UPLOAD_WITH_FILE_EXTENSION_JPG_JPEG_PJPEG'));
					return false;
				}
				$handle->file_new_name_body = $_filename;
				$handle->process($_filepath);
				if($handle->processed){
	                require(Yii::app()->basePath.'/components/byte_converter.class.php');
					$byte = new byte_converter;
					$byte->set_limit("mb");
                    $img_arr['id'] = 0;
					$img_arr['image_title'] = $_filename;
					$img_arr['image_ext'] = $handle->file_src_name_ext;
					$img_arr['image_path'] = $file_info['physical_path'];
					$img_arr['image_mime_type'] = $handle->image_src_type;
					$img_arr['image_width'] = $handle->image_src_x;
					$img_arr['image_height'] = $handle->image_src_y;
					$img_arr['image_size'] = $handle->file_src_size;
                    /*
                    $modelImage = new AImages;
                    $modelImage->image_title = $img_arr['image_title'];
                    $modelImage->image_ext = $img_arr['image_ext'];
                    $modelImage->image_path = $img_arr['image_path'];
                    $modelImage->image_mime_type = $img_arr['image_mime_type'];
                    $modelImage->image_width = $img_arr['image_width'];
                    $modelImage->image_height = $img_arr['image_height'];
                    $modelImage->image_size = $img_arr['image_size'];
                    if($modelImage->save()){
                        $img_arr['id'] = $modelImage->id;
                    }
                    */
				}
                /*
					//upload width thumbnail 110
					$handle->file_new_name_body = $_filename.'_'.Yii::app()->params->width110;
					$handle->image_resize = true;
					$handle->image_x = Yii::app()->params->width110;
					$handle->image_ratio_y = true;
					$handle->process($_filepath);
				*/	
				if($handle->processed){
					$handle->Clean();
				}
                
                echo '<img src="'.Yii::app()->params->upload_path.$img_arr['image_path'].$img_arr['image_title'].'.'.$img_arr['image_ext'].'"/>';
                exit();                
				
			}else{
			  echo json_encode(array('Upload Fail !'));
	          exit();
			}
    	}
    	else
    	{
    		echo json_encode(array('Can not upload file !'));
    		exit();
    	}

    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{ 
		$model=new ANews;
        //var_dump(date("Y-m-d H:i:s"));exit();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $file_id = isset($_POST['file_id']) ? $_POST['file_id'] : ''; //var_dump($file_id);exit();
		if(isset($_POST['ANews']))
		{
			$model->attributes=$_POST['ANews'];
            $model->image_id = $file_id;
            $model->created_time = date("Y-m-d H:i:s");
            $model->created_by = Yii::app()->user->name;
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
        $file_id = isset($_POST['file_id']) ? $_POST['file_id'] : '';
		if(isset($_POST['ANews']))
		{
			$model->attributes=$_POST['ANews'];
            if($file_id){
               $model->image_id = $file_id; 
            }            
            $model->created_time = date("Y-m-d H:i:s");
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    public function actionUpload(){
        if(isset($_FILES['files']) && $_FILES['files'])
    	{
	        require(Yii::app()->basePath.'/components/upload.class.php');
	        $handle = new upload($_FILES['files']);
	        $img_arr = array();
			$file_info = AFunction::generate_file_name('news');
			$_filename = $file_info['name'];
	        $_filepath =  realpath(Yii::app()->getBasePath().'/../uploads/')."/".$file_info['physical_path'];
			if($handle->uploaded){
				//check extension
				if (!in_array($handle->file_src_name_ext, array('gif','jpg','jpeg','pjpeg'))){
					//$this->error->add('ERROR_UPLOAD', $this->language->getMsg('YOU_CAN_UPLOAD_WITH_FILE_EXTENSION_JPG_JPEG_PJPEG'));
					return false;
				}
				$handle->file_new_name_body = $_filename;
				$handle->process($_filepath);
				if($handle->processed){
	                require(Yii::app()->basePath.'/components/byte_converter.class.php');
					$byte = new byte_converter;
					$byte->set_limit("mb");
                    $img_arr['id'] = 0;
					$img_arr['image_title'] = $_filename;
					$img_arr['image_ext'] = $handle->file_src_name_ext;
					$img_arr['image_path'] = $file_info['physical_path'];
					$img_arr['image_mime_type'] = $handle->image_src_type;
					$img_arr['image_width'] = $handle->image_src_x;
					$img_arr['image_height'] = $handle->image_src_y;
					$img_arr['image_size'] = $handle->file_src_size;
                    
                    $modelImage = new AImages;
                    $modelImage->image_title = $img_arr['image_title'];
                    $modelImage->image_ext = $img_arr['image_ext'];
                    $modelImage->image_path = $img_arr['image_path'];
                    $modelImage->image_mime_type = $img_arr['image_mime_type'];
                    $modelImage->image_width = $img_arr['image_width'];
                    $modelImage->image_height = $img_arr['image_height'];
                    $modelImage->image_size = $img_arr['image_size'];
                    if($modelImage->save()){
                        $img_arr['id'] = $modelImage->id;
                    }
				}
					//upload width thumbnail 110
					$handle->file_new_name_body = $_filename.'_'.Yii::app()->params->width110;
					$handle->image_resize = true;
					$handle->image_x = Yii::app()->params->width110;
					$handle->image_ratio_y = true;
					$handle->process($_filepath);
					
				if($handle->processed){
					$handle->Clean();
				}
                                
				echo json_encode($img_arr);
				exit();
			}else{
			  echo json_encode(array('Upload Fail !'));
	          exit();
			}
    	}
    	else
    	{
    		echo json_encode(array('Can not upload file !'));
    		exit();
    	}
    }
    // update status of category news by ajax
    public function actionActive(){
        //echo "sfsdfsdfsdfsdf"; exit();
        $id = Yii::app()->getRequest()->getParam('id');    //var_dump($id);
        $status = Yii::app()->getRequest()->getParam('status'); //var_dump($status); exit();
        
            $status_new = ($status==1)?0:1;
            $value = ($status_new ==1)?('<span class="active">'.Yii::t('app','actived').'</span>'):('<span class="inactive">'.Yii::t('app','inactived').'</span>');
            
            $sql = "Update {{news}} SET status = '$status_new' WHERE id =".$id;
            $command = Yii::app()->db->createCommand($sql);
            if($command->execute()){
                $arrReturn = array('status' => 'true','msg' => Yii::t('adm/app','LBL_SUCCESS'),'value' => $value,'stt_value' => $status_new);
            }else{
                $arrReturn = array('status' => 'false','msg' => Yii::t('adm/app','LBL_UNSUCCESS'));
            }
        
        echo  CJSON::encode($arrReturn);
        exit();
    }
    public function actionActiveAll() {
        $ids = $_REQUEST['ids'];
        $status = $_REQUEST['status'];
        $crit = new CDbCriteria();
        $crit->condition = "id IN ($ids)";
        $models = ANews::model()->findAll($crit);
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
        ANews::model()->deleteAll($crit);
        Yii::app()->user->setFlash('success', "Ðã xóa thành công");
        $this->redirect(Yii::app()->request->urlReferrer);
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
		$dataProvider=new CActiveDataProvider('ANews');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ANews('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ANews']))
			$model->attributes=$_GET['ANews'];

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
		$model=ANews::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='anews-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
