<?php

/**
 * This is the Widget for Clear Caching
 * 
 * @author nguyendv
 * @version 1.0

 *
 *
 */
class CachingClearWidget extends CWidget
{
    
    public $visible=true;  
    
   
 
    public function init()
    {
        
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    {
    	       
 		$cache_id=isset($_GET['cache_id']) ? strtolower($_GET['cache_id']) : '';
		if($cache_id){
			switch ($cache_id) {
				case 'web_assets':	
					$this->clearCacheAssets('web');		
					Yii::app()->user->setFlash('success',Yii::t('adm/admin','FRONTEND Assets cleared!'));		
					break;
				case 'web_cache':	
					if($this->clearCache('web'))		
						Yii::app()->user->setFlash('success',Yii::t('adm/admin','FRONTEND Cache cleared!'));
					else 
						Yii::app()->user->setFlash('error',Yii::t('adm/admin','Error while clear FRONTEND Cache!'));	
					break;
				case 'adm_assets':					
					$this->clearCacheAssets('adm');
					Yii::app()->user->setFlash('success',Yii::t('adm/admin','BACKEND Assets cleared!'));
					break;
				case 'adm_cache':	
					if($this->clearCache('adm'))		
						Yii::app()->user->setFlash('success',Yii::t('adm/admin','BACKEND Cache cleared!'));
					else		
						Yii::app()->user->setFlash('error',Yii::t('adm/admin','Error while clear BACKEND Cache!'));
					break;						
				default:					
					break;
			}
			Yii::app()->controller->redirect(array('aClearCache/index'));
		}   
		$this->render('application.components.views.caching.caching_widget',array()); 
                                 
    }   
	
	public function clearCache($where){
		switch ($where) {
				case 'web':
										
					//Send Post Request to Frontend
					$timeout = 30;
			        $curl    = curl_init();
					$pvars   = array('key'=>FRONTEND_CLEAR_CACHE_KEY);
			        curl_setopt($curl, CURLOPT_URL, FRONT_SITE_URL.'/site/caching');					 
			        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
			        curl_setopt($curl, CURLOPT_POST, 1);
			        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);    
			        $result = curl_exec($curl);			    
			        curl_close ($curl);		
																								
			        return $result=='0'?false:true;
					break;
				case 'adm':
					Yii::app()->cache->flush();
					return true;
					break;
		}
	}
	
	public function clearCacheAssets($where){
		$get_sub_folders=array();
		switch ($where) {
				case 'adm':
					//Clear the assets folder
					$get_sub_folders=AFunction::get_subfolders_name(dirname(dirname(dirname(__FILE__))).'/adm/'.'assets');
					foreach($get_sub_folders as $folder){
						AFunction::recursive_remove_directory(dirname(dirname(dirname(__FILE__))).'/adm/'.'assets/'.$folder);
					}										
					break;
				case 'web':	
					$get_sub_folders=AFunction::get_subfolders_name(dirname(dirname(dirname(__FILE__))).'/web/'.'assets'); //var_dump($get_sub_folders);exit();
					foreach($get_sub_folders as $folder){
						AFunction::recursive_remove_directory(dirname(dirname(dirname(__FILE__))).'/web/'.'assets/'.$folder);
					}			
					
					break;							
				default:					
					break;
			}		
		
		return;
	}
    
    
}
