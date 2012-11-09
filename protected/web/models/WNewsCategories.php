<?php

class WNewsCategories extends NewsCategories{
    
    /**
     * Show category in link News
     * @subCategory = false 
     * @parentId = 0
     */
    public static function getCategoriesHome($subCategory = false){
        $sql = "SELECT * FROM {{news_categories}} WHERE 1 ";
  		if ($subCategory) {
 			$sql .= " AND parent_id != 0";
  		}
  		
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $arrCategories = $command->queryAll();
        
        if(isset($arrCategories)){
            return $arrCategories;
        }else{
            return false;
        }
              
    }
    
    public static function getCateNews(){
        $sql = "SELECT * FROM {{news_categories}} WHERE 1 and status=1";
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $arrCateNews = $command->queryAll();
        
        if(isset($arrCateNews)){
            return $arrCateNews;
        }else{
            return false;
        }
    }
    public static function getCateNewsById($id){
        $sql = "Select c.* FROM {{news_categories}} c LEFT JOIN {{news}} n ON c.id=n.news_category_id Where n.id=".$id;
        $conn = Yii::app()->db;
        $command = $conn->createCommand($sql);
        $arrCate = $command->queryRow();
        return $arrCate;
    }
}
?>