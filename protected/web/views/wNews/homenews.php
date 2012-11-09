<?
$this->breadcrumbs=array(
    'Tin tức'
);
?>
<div class="news">
<div class="maincate">
    <?php
        if(is_array($categories)){
        foreach($categories as $key => $value){        
    ?>
    <div class="boxCat latest_home">
        <div class="navCat">
            <div class="postCat">
                <div class="ll_cate"></div><div class="cc_cate"><a rel="<?php echo $value['id'];?>" href="<?php echo Yii::app()->createUrl('wNews/listnews',array('id'=>$value['id']))?>" title="<?php echo $value['category_title'];?>"><?php echo $value['category_title'];?></a></div><div class="rr_cate"></div>
            </div>
        </div>
        <div class="latest_home_content">
            
            <?php
            $lastestNews = $value['latest_articles'];
            if(is_array($lastestNews)){
            foreach($lastestNews as $keys => $news_item){
			
			if ($keys == 0){
            ?>
	        <div class="latest">
                <div class="new_item_top"></div>
                <div style="background:#3D3D3D;height:128px">
                    <?php if ($news_item['image_id']){
    	                   $arrimage = Images::model()->find('id=:id',array(':id'=>$news_item['image_id']));
                           //var_dump($arrimage['image_path']);exit();
                   ?>
	               <a href="<?php echo Yii::app()->createUrl('wNews/detailnews',array('id'=>$news_item['id']));?>" title="<?php echo $news_item['news_title'];?>"><img border="0" alt="<?php echo $news_item['news_title'];?>" src="<?php echo Yii::app()->params['upload_path'].$arrimage['image_path'].$arrimage['image_title'].'.'.$arrimage['image_ext'];?>" class="titleincate" /></a>
	             <?php } ?>
                 
                <div class="info_new">
    	            <a class="titlein" href="<?php echo Yii::app()->createUrl('wNews/detailnews',array('id'=>$news_item['id']));?>" title="<?php echo $news_item['news_title'];?>"><?php echo $news_item['news_title'];?></a><br />
                    <span class="date1"><?php echo $news_item['created_time'];?></span><br />
    	            <div class="desc">
    	                <?php echo WFunction::truncate($news_item['news_short_description'],200);?>
    	            </div>
                </div>
                </div>
                <div class="new_item_bottom"></div>
                
	        </div>
            <div class="list">
                <div class="news_list_top"></div>
                    <div style="height: 128px; background: #666; padding-left: 3px;">
            <?php }else{ ?>
    	          
                                   
                    <li class="onenews">    
     				    <a class="color_535353" href="<?php echo Yii::app()->createUrl('wNews/detailnews',array('id'=>$news_item['id']));?>" title="<?php echo $news_item['news_title'];?>"><?php echo $news_item['news_title'];?></a>
                    </li>
                  
                         			
	        <?php }
                }
                ?></div><div class="news_list_bottom"></div></div><div class="clear"></div><?php                  
            }
            ?>
	            
       </div>
    </div>
    <?php 
        }
        }
    ?>
</div>
</div>


