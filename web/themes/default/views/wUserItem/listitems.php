<?php
    if(is_array($model)){ 
        foreach($model as $key=>$value){
            ?>
        <div class="ServiceDetail1 NewsBG">
                <div class="ServiceImg">
                    <a href="<?php echo Yii::app()->createUrl('wUserItem/detailshop', array('id'=>$value['id'],'title'=>WFunction::convertToAlias($value['title'])));?>">
                        <?php 
            		  	if($value['image']){
            		  	   $arrimage = Images::model()->find('id=:id',array(':id'=>$value['image']));
                        ?>
                            <img class="Radius" src="<?php echo Yii::app()->params['upload_path'].$arrimage['image_path'].$arrimage['image_title']. '.' . $arrimage['image_ext'];?>" />
                            <?php 
            			}else {
            				echo CHtml::image(Yii::app()->request->baseUrl.'/images/noimage.gif');
            			}?>
                    </a>
                </div>
                <div class="ServiceInfo">
                    <a href="<?php echo Yii::app()->createUrl('wUserItem/detailshop', array('id'=>$value['id'],'title'=>WFunction::convertToAlias($value['title'])));?>"><b><?php echo $value['title'];?></b></a><br />
                    <p><?php echo WFunction::truncate($value['description'],140);?></p>
                    <a href="<?php echo Yii::app()->createUrl('wUserItem/detailshop', array('id'=>$value['id'],'title'=>WFunction::convertToAlias($value['title'])));?>" style="float: right;">Hiển thị shop...</a>
                </div>
            </div>
            <?php
        }
    }else{
        echo 'Không có shop hoặc sản phẩm nào';
    }
?>
<div class="jb_pagination">
    <?php echo $pageInfo['strPager'];?>
</div>