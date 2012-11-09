<?php
class AController extends CController{

	public $layout='//layouts/column1';
	public $menu=array();
	
    public $config;
	public $breadcrumbs=array();
    public $group_id;
    public $username;
    public $pageHint='';
    //public $channel_code = array();
	
	public function init(){
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->baseUrl.'/css/mystyle.css');
	    Yii::app()->clientScript->registerScript('global', '                                                           
	          yii = {                                                                                                     
	              urls: {                                      
	                  base: '.CJSON::encode(Yii::app()->baseUrl).'                                                        
	              }                                                                                                       
	          };                                                                                                          
	    ',CClientScript::POS_HEAD);
        
        if(Yii::app()->user->id){
            $user = new ASystemUser;
            $userInfo = $user->getSystemUserById(Yii::app()->user->id); //var_dump($userInfo->cp_code);exit();
            $this->group_id = $userInfo->group_id;
            $this->username = $userInfo->username;
 
            
            Yii::app()->session['group_id'] = $this->group_id;
            Yii::app()->session['username'] = $this->username;
        }
        
        $xmlPath = realpath($path = Yii::app()->basePath.'/../'.Yii::app()->params['config_folder'].'/'); 
        $xmlFile = Yii::app()->params['config_file_name'];
        $this->config = new LoadConfigXML($xmlPath,$xmlFile);  
	}
}
?>