<?php
$this->breadcrumbs=array(
	Yii::t('adm/news','manage_cate')
);

$this->menu=array(
	array('label'=>Yii::t('adm/news','create_cate'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
);
?>

<h3><?php echo Yii::t('adm/news','manage_cate');?></h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'anews-categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'category_title',
		'category_description',
		array(
			'name'=>'status',
            'type'=>'raw',
           // 'value'=>'Lookup::item("CategorynewsActive",$data->status)',
            'value'=>'CHtml::link(($data->status == 1) ? CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/tick.png\',\'image\') : CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/publish_x.png\',\'image\'),"javascript:void();",array(\'onclick\'=>"changeStatus($data->status,\'$data->id\')"))',
			//'filter'=>Lookup::items('UserStatus'),
		),
		'priority',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script>
function changeStatus(status,id){
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
                                window.location = "<?php echo $this->createUrl('admin')?>";
                                //window.location.reload();
							}
                            
							$.unblockUI();
						}
					});
				}
			});
}
</script>