<div class="sub_menu_left">
    <?php $this->renderPartial('/layouts/_sub_menu_left',array('type'=>$type));?>
</div>
<div class="sub_menu_right">
    <!-- content -->
    <?php if($content_type == Yii::app()->params->introduction){ ?>
                <h3><?php echo $arrContent->page_title; ?></h3>
                <div><?php echo $arrContent->short_description; ?></div>
                <div><?php echo $arrContent->long_description; ?></div>
    <?php } ?>
    
    <!-- end content -->
</div>
<div class="clear"></div>