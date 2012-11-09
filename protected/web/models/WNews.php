<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property string $title
 * @property string $shortDesc
 * @property string $content
 * @property integer $create_time
 * @property string $create_author
 * @property integer $status
 * @property string $images
 * @property string $tags
 * @property integer $cate_id
 */
class WNews extends News
{
    //public $images;
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{news}}';
	}
    
    /**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
     /*
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('news/listnews', 'tag'=>$tag));
		return $links;
	}
    */
     /**
      * List news
      */
      public static function Detailnews($id){
        $criteria=new CDbCriteria;
        $criteria->select='*';  // only select the 'title' column
        $criteria->condition='id=:id';
        $criteria->params=array(':id'=>$id);
        $news=WNews::model()->find($criteria);
        
        return count($news) > 0 ? $news : false;
        
        
      }
      /*
      public static function getHotnewsTop(){
        $criteria=new CDbCriteria;
        $criteria->select='*';  // only select the 'title' column
        $criteria->condition='status=:status AND hotnews =:hotnews';
        $criteria->order='id DESC';
        $criteria->limit= 1;
        $criteria->params=array(':status'=>1, ':hotnews'=>1);
        $hotnewstop=WNews::model()->find($criteria);
        
        return count($hotnewstop) > 0 ? $hotnewstop : false;
      }
     */
      
      public static function getLatestNews($categoryId, $limit = 5)
      {
    		$limit = ($limit) ? $limit : 5;
    		$sql = 'SELECT n.* FROM {{news}} AS n
    					WHERE n.status = "1" 
    						AND n.news_category_id = ' . $categoryId . '
    					ORDER BY n.created_time DESC, n.id DESC
    					LIMIT ' .$limit;
            $conn = Yii::app()->db;
            $command = $conn->createCommand($sql);
            $rs = $command->queryAll();
            
            return count($rs) > 0 ? $rs : false;
	
  	}
    
    public static function getNewRelated($value, $key = '', $keyType = '' ){
            ($key == '')?$key = 'id':$key;
			($keyType == '')?$keyType = 'string':$keyType;
            $sql= "SELECT n.* FROM {{news}} as n
                  WHERE n.$key !='$value' AND n.news_category_id = (select news_category_id from {{news}} as n Where n.$key ='$value') ORDER BY n.id DESC LIMIT 5,10";
            	
            $conn = Yii::app()->db;
            $command = $conn->createCommand($sql);
            $rs = $command->queryAll();

			if(!$rs){
				return false;
			}else{
				return $rs;
			}    
   }
   public static function getNewRelateNew($value, $key = '', $keyType = '' ){
            ($key == '')?$key = 'id':$key;
			($keyType == '')?$keyType = 'string':$keyType;
            $sql= "SELECT n.* FROM {{news}} as n
                  WHERE n.$key !='$value' AND n.news_category_id = (select news_category_id from {{news}} as n Where n.$key ='$value') ORDER BY n.id DESC LIMIT 0,5";
            //var_dump($sql); exit();
            $conn = Yii::app()->db;
            $command = $conn->createCommand($sql);
            $rs = $command->queryAll();
            
			if(!$rs){
				return false;
			}else{
				return $rs;
			}    
   }
   public static function getNewsPromotion(){
        $criteria = new CDbCriteria;
        $criteria->condition = 'status=:status and news_category_id=:news_category_id';
        $criteria->params = array(
            ':status' => 1,
            ':news_category_id'=>1
        );
        $criteria->order ='created_time DESC';
        $criteria->limit = 1;
     return WNews::model()->find($criteria);
   }
      
}