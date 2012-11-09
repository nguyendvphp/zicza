<div class="news1">
<?php
        $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'summaryText' => '',
	'itemView'=>Yii::app()->params['web_path'].'views.wNews._viewhot',
)); ?>
</div>