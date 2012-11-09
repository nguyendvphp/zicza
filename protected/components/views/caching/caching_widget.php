<div class="form">
<?php $this->render('application.components.views.notification'); ?>
<a class="button" href="<?php echo Yii::app()->createUrl('aClearCache/index',array('cache_id'=>'adm_assets'));?>"><?php echo Yii::t('adm/admin','Clear BACKEND Assets'); ?></a>
<a class="button" href="<?php echo Yii::app()->createUrl('aClearCache/index',array('cache_id'=>'adm_cache'));?>"><?php echo Yii::t('adm/admin','Clear BACKEND Cache'); ?></a>
<a class="button" href="<?php echo Yii::app()->createUrl('aClearCache/index',array('cache_id'=>'web_assets'));?>"><?php echo Yii::t('adm/admin','Clear FRONTEND Assets'); ?></a>
<a class="button" href="<?php echo Yii::app()->createUrl('aClearCache/index',array('cache_id'=>'web_cache'));?>"><?php echo Yii::t('adm/admin','Clear FRONTEND Cache'); ?></a>
</div>