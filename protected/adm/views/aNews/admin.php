<?php
$this->breadcrumbs=array(
	Yii::t('adm/news','manage_news')
);

$this->menu=array(
	array('label'=>Yii::t('adm/news','create_cate'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
);

?>

<h3><?php echo Yii::t('adm/news','manage_news');?></h3>

<?php $this->widget('ext.selgridview.SelGridView', array(
	'id'=>'anews-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectableRows' => 2,
	'columns'=>array(
		array(
                'class' => 'CCheckBoxColumn',
            ),
        array(
            'name'=>'news_category_id',
            'value'=>'$data->newsCategory->category_title',
            'filter'=>CHtml::listData(ANewsCategories::model()->findAll(),"id","category_title"),
        ),
		'news_title',
		array(
			'name'=>'status',
            'type'=>'raw',
           // 'value'=>'Lookup::item("CategorynewsActive",$data->status)',
            'value'=>'CHtml::link(($data->status == 1) ? CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/tick.png\',\'image\') : CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/publish_x.png\',\'image\'),"javascript:void();",array(\'onclick\'=>"changeStatus($data->status,\'$data->id\')"))',
			//'filter'=>Lookup::items('UserStatus'),
		),
        'created_time',
		/*
		'priority',
		'created_time',
		'created_by',
		'updated_time',
		'updated_by',
		'image_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<ul id="content_toolbar">
    <li><input type="button" name="" id="activeAll" value="<?php echo Yii::t('adm/news','activeAll');?>"/></li>
    <li><input type="button" name="" id="unActiveAll" value="<?php echo Yii::t('adm/news','unactiveAll');?>"/></li>
    <li><input type="button" name="" id="deleteAll" value="<?php echo Yii::t('adm/news','deleteAll');?>"/></li>
</ul>
<script type="text/javascript">
    $(document).ready(function(){
        $('#activeAll').click(function(){
            var items = getCheckedItems();
            if(items){
                var cf = confirm('Bạn muốn kích hoạt toàn bộ item được chọn ?')
                if(cf)
                    //window.location = '<?php echo Yii::app()->request->baseUrl;?>/bnews/activeAll/status/1/ids/'+items;
                    window.location = '<?php echo $this->createUrl('activeAll');?>/status/1/ids/'+items;
            }else{
                alert('Chưa có item nào được chọn')
            }
        })
        
        $('#unActiveAll').click(function(){
            var items = getCheckedItems();
            if(items){
                var cf = confirm('Bạn muốn ngừng kích hoạt toàn bộ item được chọn ?')
                if(cf)
                    //window.location = '<?php echo Yii::app()->request->baseUrl;?>/bnews/activeAll/status/0/ids/'+items;
                    window.location = '<?php echo $this->createUrl('activeAll');?>/status/0/ids/'+items;
            }else{
                alert('Chưa có item nao được chọn')
            }
        })

        $('#deleteAll').click(function(){
            var items = getCheckedItems();
            if(items){
                var cf = confirm('Bạn muốn xóa toàn bộ item được chọn ?')
                if(cf)
                    //window.location = '<?php echo Yii::app()->request->baseUrl;?>/bnews/deleteAll/ids/'+items;
                    window.location = '<?php echo $this->createUrl('deleteAll');?>/ids/'+items;
            }else{
                alert('Chưa có item nào được chọn')
            }
        })
    });
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
                                //window.location = "<?php echo $this->createUrl('active')?>";
                                 window.location.reload();
							}
                            
							$.unblockUI();
						}
					});
				}
			});
}

function changeHotnews(hotnews,id){
	jConfirm(
			'Bạn muốn tin tức này là tin nổi bật không ?',
			'Xác thực',
			function(r){
				if(r==true){
					$.blockUI();
                    
					$.ajax({
						type: "POST",
						url: "<?php echo $this->createUrl('hotnews')?>",
					    data:{hotnews:hotnews,id:id},
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
                                
                                 window.location.reload();
							}
                            
							$.unblockUI();
						}
					});
				}
			});
}
</script>
