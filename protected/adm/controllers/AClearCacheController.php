<?php
/**
 * Backend Caching Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.controllers
 *
 */
class AClearCacheController extends AController{
    
       
    public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
             $this->menu=array(
                  
            );
		 
	}
                 
     /**
	 * The function that do clear Cache 
	 * 
	 */
	public function actionIndex()
	{                
		$this->render('index');
	}
        
       
       
}