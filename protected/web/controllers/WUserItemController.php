<?php

class WUserItemController extends WebController
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','imageupload','upload','view','listitem','detailshop','vote','listcomment'),
				'users'=>array('*'),
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
	    $this->layout = '//layouts/column3';
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
			$file_info = WFunction::generate_file_name('infoshop');
			$_filename = $file_info['name'];
	        $_filepath =  realpath(Yii::app()->getBasePath().'/../uploads/')."/".$file_info['physical_path'];
			if($handle->uploaded){
				//check extension
				if (!in_array($handle->file_src_name_ext, array('gif','jpg','jpeg','pjpeg','png'))){
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
        $this->layout = '//layouts/column3';
		$model=new WUserItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $file_id = isset($_POST['file_id']) ? $_POST['file_id'] : '';
		if(isset($_POST['WUserItem']))
		{   
            $parser = new CHtmlPurifier();
            $option = array(
                'address'=> $parser->purify($_POST['WUserItem']['address']),
                'phonenumber'=> $parser->purify($_POST['WUserItem']['phonenumber']),
                'skype'=> $parser->purify($_POST['WUserItem']['skype']),
                'yahoo'=> $parser->purify($_POST['WUserItem']['yahoo']),
                'price'=> $parser->purify($_POST['WUserItem']['price']),
                
            );  
			$model->attributes=$_POST['WUserItem'];
            $model->title = $parser->purify($_POST['WUserItem']['title']);
            $model->description = $parser->purify($_POST['WUserItem']['description']);
            $model->image = $file_id;
            $model->created_date = date("Y-m-d H:i:s");
            $model->user_id = '3';
            $model->status = '1';
            $model->options = serialize($option);
			if($model->save()){
			     Yii::app()->user->setFlash('success','Bạn đã tạo thành công shop mới');
			     $this->redirect(array('view','id'=>$model->id));
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    
    public function actionUpload(){
        if(isset($_FILES['files']) && $_FILES['files'])
    	{
	        require(Yii::app()->basePath.'/components/upload.class.php');
	        $handle = new upload($_FILES['files']);
	        $img_arr = array();
			$file_info = WFunction::generate_file_name('shop');
			$_filename = $file_info['name'];
	        $_filepath =  realpath(Yii::app()->getBasePath().'/../uploads/')."/".$file_info['physical_path'];
			if($handle->uploaded){
				//check extension
				if (!in_array($handle->file_src_name_ext, array('gif','jpg','jpeg','pjpeg','png'))){
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
                    
                    $modelImage = new WImages;
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

		if(isset($_POST['WUserItem']))
		{
			$model->attributes=$_POST['WUserItem'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
    
    public function actionListitem(){
        $model = new WUserItem;
        
        $page = isset($_POST['page'])?$_POST['page']:1;
        $num_per_page = Yii::app()->params->listshop_num_per_page;
        $total = WUserItem::countUserItem(); //echo $total;exit();
        $pageInfo = WFunction::getPagerInfo($total,$page,$num_per_page);//var_dump($pageInfo); exit();
        $imagePath = Yii::app()->theme->baseUrl."/images/";
        $page_wap =WFunction::web_pager_ajax($total,$pageInfo['cpage'],$num_per_page,'',$imagePath);
       
        $arrUserItem = WUserItem::getListitem('',$pageInfo['start'],$num_per_page);  //var_dump($arrUserItem);exit();
        $html = $this->renderPartial('/wUserItem/listitems',array('model'=>$arrUserItem,'pageInfo'=>$page_wap));
        echo $html;
        exit();
    }
    
    public function actionDetailshop(){
        $this->layout = '//layouts/column2';
        $idshop = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $arrShop = WUserItem::getDetailShop($idshop);
        
        $this->render('detailshop', array('model'=> $arrShop));
    }
    
    public function actionVote(){
        
    }
    
    public function actionListComment(){
        $this->layout = '//layouts/column2';
        $idshop = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $vote_type = isset($_REQUEST['vote_type'])?$_REQUEST['vote_type']:'';
        
        $page = isset($_POST['p'])?$_POST['p']:1;
        $num_per_page = Yii::app()->params->listshop_num_per_page;
        $total = WUserItem::getCountComment($vote_type,$idshop); //echo $total;exit();
        $pageInfo = WFunction::getPagerInfo($total,$page,$num_per_page);//var_dump($pageInfo); exit();
        $imagePath = Yii::app()->theme->baseUrl."/images/";
        $page_wap =WFunction::web_pager($total,$pageInfo['cpage'],$num_per_page,Yii::app()->createUrl('wUserItem/listcomment',array('id'=>$idshop,'vote_type'=>$vote_type)),$imagePath);
        $arrListComment = WUserItem::getListComment($vote_type, $idshop, $pageInfo['start'], $num_per_page);
        
        $arrShop = WUserItem::getDetailShop($idshop);
        
        $this->render('listcomment', array('arrComment'=>$arrListComment, 'pageInfo'=>$pageInfo, 'model'=> $arrShop));
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
		$dataProvider=new CActiveDataProvider('WUserItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new WUserItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WUserItem']))
			$model->attributes=$_GET['WUserItem'];

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
		$model=WUserItem::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='wuser-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
