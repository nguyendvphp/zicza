<div>
    <?php
        $this->breadcrumbs=array(
        	Yii::t('web/app','register'),
        );
    ?>
    
    <h3 class="sub_page_title"><?php echo Yii::t('web/app','register')?></h3>
    
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>