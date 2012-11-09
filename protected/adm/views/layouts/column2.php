<?php $this->beginContent('//layouts/main'); ?>
<script type="text/javascript" src="<? echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.1.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.1.css" />
<script type="text/javascript" src="<? echo Yii::app()->request->baseUrl; ?>/js/common.js"></script>

<div class="span-5 last">
	<div id="sidebar">
    <fieldset style="margin-left: 10px;">
        
	<?php
		$this->beginWidget('zii.widgets.CPortlet'
        /**
 * array(
 * 			'title'=>Yii::t('app','Operations'),
 * 		) 
 */
        );
		$this->widget('zii.widgets.CMenu', array(
            //'itemTemplate'=>'<span>{menu}</span>',
			'items'=>$this->menu,
            'linkLabelWrapper' => 'span',
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
    </fieldset>
	</div><!-- sidebar -->
    
</div>
<div class="span-19">
    <fieldset style="margin: 0 15px 0 10px;">
	<div id="content">
    <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('unsuccess')): ?>
                <div class="flash-error">
                <?php echo Yii::app()->user->getFlash('unsuccess'); ?>
                </div>
    <?php endif; ?>
		<?php echo $content; ?>
	</div><!-- content -->
    </fieldset>
</div>
<?php $this->endContent(); ?>