<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.carousel.min.js');?>
<?php if(isset($type) && $type == UserItem::TYPE_PRODUCT) :?>
<div class="content_product">
    <h3>Tên sản phẩm :<?php echo $model['title'];?></h3>
    <?php if(isset($model['options'])):
            $arrOption = unserialize($model['options']);
            
    ?>
        <i>Mã sản phẩm</i>: <b><?php echo $arrOption['code_product'];?></b><br />
        <i>Giá sản phẩm</i> : <b><?php echo $arrOption['price'].' VNĐ';?></b><br />
    <?php endif;?>
    <div id="image_slider">
        <ul>
        <?php
            $strImg = $model['image'];
            $arrImgId = explode(',', $strImg);
            foreach($arrImgId as $idImg){
                $arrImgSlider = Images::model()->find('id=:id',array(':id'=>$idImg));
                ?>
                <li><img src="<?php echo Yii::app()->params['upload_path'].$arrImgSlider['image_path'].$arrImgSlider['image_title']. '.' . $arrImgSlider['image_ext'];?>" /></li>
                <?php
            }
        ?>
        </ul>
    </div>
    <div class="countview"><span>10 lượt view</span></div>
    <div class="desc">
        <?php echo $model['description'];?>
    </div>
</div>
<div class="count_like">
    <h3>Thống kê bình luận về sản phẩm</h3>
    <div class="khuyenmua">
        <div class="box">
            <span>Có 100 người khuyên <span class="like">Nên Mua</span>.<br />Trong đó có 15 người là bạn của bạn.</span><br />
            <?php
                if(!isset(Yii::app()->session['facebook_email'])){
                    ?>
                        <a href="<?php echo Yii::app()->createUrl('wUserItem/listcomment', array('id'=>$model['id'],'vote_type'=>ItemVote::COMPLIMENT_VOTE,'type'=>UserItem::TYPE_PRODUCT));?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/like.png" border="0" /></a>
                    <?php
                }else{
                    ?>
                        <a href="javascript:openDialog();"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/nenmua.png" border="0" /></a>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="khongnenmua">
        <div class="box">
            <span>Có 100 người khuyên <span class="dislike">Không Nên Mua</span>.<br />Trong đó có 15 người là bạn của bạn.</span><br />
            <?php
                if(isset(Yii::app()->session['facebook_email'])){
                    ?>
                        <a href="<?php echo Yii::app()->createUrl('wUserItem/listcomment', array('id'=>$model['id'],'vote_type'=>ItemVote::DECRY_VOTE,'type'=>UserItem::TYPE_PRODUCT));?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/dislike.png" border="0" /></a>
                    <?php
                }else{
                    ?>
                        <a href="javascript:openDialog();"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/khongnenmua.png" border="0" /></a>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<?php elseif(isset($type) && $type == UserItem::TYPE_SHOP):?>
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
<div id="sidebar_sub">
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
<div id="maincontent_sub">
    <h3>Thống kê về Shop</h3>
    <div class="khuyenmua">
        <div class="box">
            <span>Có 100 người khuyên <span class="like">Nên Mua</span>.<br />Trong đó có 15 người là bạn của bạn.</span><br />
            <?php
                if(!isset(Yii::app()->session['facebook_email'])){
                    ?>
                        <a href="<?php echo Yii::app()->createUrl('wUserItem/listcomment', array('id'=>$model['id'],'vote_type'=>ItemVote::COMPLIMENT_VOTE,'type'=>UserItem::TYPE_SHOP));?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/like.png" border="0" /></a>
                    <?php
                }else{
                    ?>
                        <a href="javascript:openDialog();"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/nenmua.png" border="0" /></a>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="khongnenmua">
        <div class="box">
            <span>Có 100 người khuyên <span class="dislike">Không Nên Mua</span>.<br />Trong đó có 15 người là bạn của bạn.</span><br />
            <?php
                if(isset(Yii::app()->session['facebook_email'])){
                    ?>
                        <a href="<?php echo Yii::app()->createUrl('wUserItem/listcomment', array('id'=>$model['id'],'vote_type'=>ItemVote::DECRY_VOTE,'type'=>UserItem::TYPE_SHOP));?>"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/dislike.png" border="0" /></a>
                    <?php
                }else{
                    ?>
                        <a href="javascript:openDialog();"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/khongnenmua.png" border="0" /></a>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<?php endif;?>
<div class="clear"></div>
<div id="dialogPost" title="Zicza.com">
<?php
    $this->renderPartial('/wUserItem/_commentform');
?>
</div>