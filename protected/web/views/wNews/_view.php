<div class="view-news">
     <div class="cont-pos">
         <h2 class="entry-title">
    		<?php echo CHtml::link(CHtml::encode($data->news_title), array('wNews/detailnews', 'id' => $data->id,'type'=>Yii::app()->params->news)); ?>
        </h2>
        <div class="entry-content mob-hide"><?php echo $data->news_short_description; ?> </div> 
    </div>
    
    <div class="clear"></div>
</div>