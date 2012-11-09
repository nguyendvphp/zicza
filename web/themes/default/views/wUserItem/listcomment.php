<div style="width: 100%; padding-bottom: 10px;">
    <?php 
  	     if($model['image']){
  	         $arrimage = Images::model()->find('id=:id',array(':id'=>$model['image']));
    ?>
        <img style="float: left;" width="" height="120px" src="<?php echo Yii::app()->params['upload_path'].$arrimage['image_path'].$arrimage['image_title']. '.' . $arrimage['image_ext'];?>" />
        <?php 
	}else {
		echo CHtml::image(Yii::app()->theme->baseUrl.'/images/noimage.gif');
	}?>
    <div style="float: left;"><span class="namecompany"><?php echo $model['title'];?></span></div>
    <div class="clear"></div>
</div>
<div id="sidebar">
    <h3>Giới thiệu về Shop</h3>
    <div class="info">
        <?php if(isset($model['options'])):
            $arrOption = unserialize($model['options']);
            
        ?>
        <i>Địa chỉ</i>: <b><?php echo $arrOption['address'];?></b><br />
        <i>Điện thoại</i> : <b><?php echo $arrOption['phonenumber'];?></b><br />
        <i>Skype</i> : <b><?php echo $arrOption['skype'];?></b><br />
        <i>Yahoo</i> : <b><?php echo $arrOption['yahoo'];?></b>
        <?php endif;?>
    </div>
</div>
<div id="maincontent">
    <h3>Danh sách những lý do khuyên <span class="like">Nên Mua</span></h3>
    <?php
        if(is_array($arrComment) && count($arrComment) > 0){
            foreach($arrComment as $key=>$comment){
            ?>
            <div class="comment">
                <div class="avatar">
                    <img class="Radius" src="<?php echo Yii::app()->theme->baseUrl;?>/images/avatar.png" border="0" /><br />
                    <?php echo $comment['facebook_email'];?>
                </div>
                <div class="info_comment">
                    <?php echo $comment['comment'];?>
                </div>
                <div class="clear"></div>
            </div>
            <?php
            }
        }else{
            echo 'Không có bình luận nào';
        }
    ?>
</div>
<div class="clear"></div>
