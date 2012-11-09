<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/bsystemgroup.js');?>
<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','mnu_system_group')=>array('admin'),
	Yii::t('adm/group','mnu_admin'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/group','mnu_create'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bsystem-group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><?php echo Yii::t('adm/app','mnu_system_group');?></h3>
<p>
<?php echo Yii::t('adm/app','information_option_search');?>
</p>

<?php echo CHtml::link(Yii::t('adm/app','advance_search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search',array(
    	'model'=>$model,
    )); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bsystem-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
        "name"=>'group_title',
        "type"=>'html',
        "value"=>'Chtml::link($data->group_title,array("/aSystemgroup/view&id=$data->id"))',
        ),
		'group_desc',
        array(
			'name'=>'status',
            'type'=>'raw',
            'value'=>'($data->status == 0) ? "<span id=\"active_status".$data->id."\"><img onclick=\"changeActiveGroup(".$data->id.",0);\" class=\"active_status\" title=\"'.Yii::t('adm/app','lbl_status_active').'\" src=\"'.Yii::app()->getRequest()->baseUrl.'/images/icons/publish_x.png\" /></span>": "<span id=\"active_status".$data->id."\"><img onclick=\"changeActiveGroup(".$data->id.",1);\" class=\"active_status\" title=\"'.Yii::t('adm/app','lbl_status_inactive').'\" src=\"'.Yii::app()->getRequest()->baseUrl.'/images/icons/tick.png\" /></span>"',
		),
		'created_date',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<script type="text/javascript">
     /*function changeStatus(status,id){
	jConfirm(
			'Bạn có muốn thay đổi trạng thái này không ?',
			'Xác thực',
			function(r){
				if(r==true){
					$.blockUI();
                    
					$.ajax({
						type: "POST",
						url: "<?php echo $this->createUrl('active')?>",
					    data:{status:status,id:id},
						dataType:'json',
						success:function(json){
						  //alert(json);
							jAlert(json.msg,'Thông báo');
							if(json.status == 'true'){
								$('#'+id).html(json.value);
								$('#a_'+id).click(function(){
									//changeStatus(json.stt_value,id);
                                    //window.location = "<?php echo $this->createUrl('admin')?>";
                                    
								})
                                //window.location = "<?php echo $this->createUrl('active')?>";
                                window.location.reload();
							}
                            
							$.unblockUI();
						}
					});
				}
			});
}*/
</script>