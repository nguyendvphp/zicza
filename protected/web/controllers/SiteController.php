<?php
class SiteController extends WebController
{
	/**
	 * Declares class-based actions.
	 */
     public $defaultAction = 'index';

	public function actions()
	{   
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
                        
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{   
        if(Yii::app()->user->isGuest){
            $this->layout = '//layouts/column1';
        }else{
            $this->layout = '//layouts/column3';
        }
        //$model = new WHandset;
		$this->render('index',array('model'=>''));
	}
    

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
	    
        $this->layout = '//layouts/column3';
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail($this->config->parse("Contact","emailContact"),$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Cảm ơn bạn đã liên hệ với chúng tôi . Chúng tôi sẽ trả lời bạn trong thời giàn sớm nhất.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new WLoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		// collect user input data
		if(isset($_POST['WLoginForm']))
		{
			$model->attributes=$_POST['WLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
    public function actionLoginhome()
	{
		$model=new WLoginForm;
        $username = isset($_POST['username'])?$_POST['username']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
		
		
	   $model->username = $username;
       $model->password = $password;
		// validate user input and redirect to the previous page if valid
		if($model->login()){
            $arrReturn = array('status' => true,'msg' => Yii::t('web/app','LBL_SUCCESS'),'stt_value' => $passmd5);
        }else{
            $arrReturn = array('status' => false,'msg' => Yii::t('web/app','LBL_UNSUCCESS'));
        }
        
        echo  CJSON::encode($arrReturn);
        exit();
		
	}
    

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
	    $this->layout = '//layouts/column1';
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}