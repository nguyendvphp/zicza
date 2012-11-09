<?php 
class WebController extends CController{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
   	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
    public $config;
    public $device_type = "";
    public $arrPromotionId = array();
    
    public function init()
    { 
    	parent::init();
        Yii::app()->setTheme('default');
        $this->pageTitle = Yii::app()->params['page_title'];
        $cs = Yii::app()->getClientScript();
        
        $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-ui.min.js');  
        $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.orbit-1.2.3.min.js');
        $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.alerts.js');
        $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.confirm.js');
        $cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/vote.js');
        //load XML Config
        $xmlPath = realpath($path = Yii::app()->basePath.'/../'.Yii::app()->params['config_folder'].'/');
        $xmlFile = Yii::app()->params['config_file_name'];
        $this->config = new LoadConfigXML($xmlPath,$xmlFile);
        
        //$this->arrPromotionId = Promotion::model()->getListGamePromotion();
    }
}
?>