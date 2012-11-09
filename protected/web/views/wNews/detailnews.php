<?php
$this->breadcrumbs=array(
    $cateNews['category_title']=>array('wNews/listnews','id'=>$cateNews['id'],'type'=>Yii::app()->params->news),
    $model->news_title
);

?>
<div class="news">  
    <div class="news-content">
        <h1 class="entry-title"><?php echo $model->news_title;?></h1>
        <div class="sub-content">
            <span><?php echo $model->news_short_description;?></span>
        </div>
        <div class="clear"></div>
        <div class="main-content">
            <?php echo $model->news_detail;?>
        </div>
        <div class="related">
            <?php if(is_array($arrRelateNew)) {?>
                <div class="newsnew">
                    <div  style="color:#990000; font-weight:bold;"><?php echo Yii::t('web/home','hotnews');?> :</div>
                    <div>
                    <ul>
                    <?php
                        foreach($arrRelateNew as $key=>$value){
                    ?>                         
                        <li><a href="<?php echo Yii::app()->createUrl('wNews/detailnews',array('id'=>$value['id'],'type'=>Yii::app()->params->news));?>"><?php echo $value['news_title'];?></a>&nbsp;&nbsp;<span style="color:#999; font-size:11px;font-style:italic;">(<?php echo $value['created_time'];?>)</span></li>          
                    
                    <?php }?>
                    </ul>
                    </div>
                </div>
                <?php } ?>
                <br />
                <?php  if(is_array($arrRelates)){ ?>
                <div class="newrelate">
                    <div style="color:#990000; font-weight:bold;"><?php echo Yii::t('web/home','othernews');?>  :</div>
                    <ul>
                    <?php
                        foreach($arrRelates as $k => $v){
                    ?>
                        <li><a href="<?php echo Yii::app()->createUrl('wNews/detailnews',array('id'=>$v['id'],'type'=>Yii::app()->params->news));?>"><?php echo $v['news_title'];?></a>&nbsp;&nbsp;<span style="color:#999; font-size:11px;font-style:italic;">(<?php echo $value['created_time'];?>)</span></li>
                    
                    <?php } ?>
                    </ul>
                </div>
                <?php } ?>
        </div>
        
    </div>
</div>
