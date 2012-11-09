<?php
$this->breadcrumbs=array(
	$arrCate->category_title
);
?>
<div class="news">
<div class="page-cont">
    <h1><?php echo $arrCate->category_title;?></h1>
</div>
<div class="list-news">
    <?php
    //var_dump($dataProvider); exit();
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'summaryText' => ' ',
        'itemView' => '_view',
    ));
    ?>
</div>
</div>