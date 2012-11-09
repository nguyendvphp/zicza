<?php $this->beginContent('//layouts/main'); ?>
    <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
    <?php endif; ?>
	<?php echo $content; ?>

<?php $this->endContent(); ?>