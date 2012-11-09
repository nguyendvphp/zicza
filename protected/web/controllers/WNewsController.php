<?php

class WNewsController extends WebController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('detailnews','listnews','homenews'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
     * View news in link news at homepage
     */
     public function actionHomenews(){
        $cache = Yii::app()->cache;
        $cateid = Yii::app()->params['CATE_ID'];
        $arrNewsCategories = WNewsCategories::getCateNews();
        $arrCate = WNewsCategories::model()->find('id=:id', array(':id'=>$cateid));
        //var_dump($arrCate); exit();
        $criteria=new CDbCriteria(array(
    			'order'=>'created_time DESC', 			
    		));
      
      
      $criteria->addSearchCondition('news_category_id',$cateid);
                  
	  if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);
            
        $dataProvider = new CActiveDataProvider('News',
            array(
                'criteria' => $criteria,
            )
        );
        
        $dataProvider->pagination->pageSize = 5;

		$this->render('listnews',array(
			'dataProvider'=>$dataProvider,
            'arrCate' => $arrCate,
            'arrNewsCategories' =>$arrNewsCategories
		));
           
     }
     
    /**
     * View detail nes
     */
    public function actionDetailnews(){
        $cache = Yii::app()->cache;
        $news_id = Yii::app()->getRequest()->getParam('id');
        $news = $cache->get(Yii::app()->params['cache_detailnews'].$news_id);
        if($news === false){
            $news = WNews::Detailnews($news_id);
            $cache->set(Yii::app()->params['cache_detailnews'].$news_id, $news, Yii::app()->params['cache_refresh']);
        }
        $arrNewsCategories = WNewsCategories::getCateNews(); //var_dump($arrNewsCategories); exit();
        $arrRelates = WNews::getNewRelated($news_id,'id',''); 
        $arrRelateNew = WNews::getNewRelateNew($news_id,'id','');
        //var_dump($arrRelateNew); exit();
        $cateNews = WNewsCategories::getCateNewsById($news_id);
        $this->render('detailnews',array(
			'model'=>$news,
            'arrRelates' => $arrRelates,
            'arrRelateNew' => $arrRelateNew,
            'arrNewsCategories' =>$arrNewsCategories,
            'cateNews'=>$cateNews
		));
    }
    
    public function actionListnews(){
        $tag = Yii::app()->getRequest()->getParam('tag');
        $cateid = Yii::app()->getRequest()->getParam('id');
        $arrNewsCategories = WNewsCategories::getCateNews();
        $arrCate = WNewsCategories::model()->find('id=:id', array(':id'=>$cateid));
        //var_dump($arrCate); exit();
        $criteria=new CDbCriteria(array(
    			'order'=>'RAND()', 			
    		));
      
      if(isset($_GET['id']))
			$criteria->addSearchCondition('news_category_id',$_GET['id']);
                  
	  if(isset($_GET['tag']))
			$criteria->addSearchCondition('tags',$_GET['tag']);
            
        $dataProvider = new CActiveDataProvider('News',
            array(
                'criteria' => $criteria,
            )
        );
        
        $dataProvider->pagination->pageSize = 5;

		$this->render('listnews',array(
			'dataProvider'=>$dataProvider,
            'arrCate' => $arrCate,
            'arrNewsCategories' =>$arrNewsCategories
		));
    }
}
