<?php
$this->breadcrumbs=array(
	Yii::t('adm/app','manage_sysuser')=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','create_sysuser'), 'url'=>array('create'),'linkOptions'=>array('class'=>'link-new')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('system-user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><?php echo Yii::t('adm/app','manage_sysuser');?></h3>

<p>
    <?php echo Yii::t('adm/app','information_option_search');?>
</p>

<?php echo CHtml::link(Yii::t('adm/app','advance_search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'system-user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'username',
            "type"=>'html',
            'value'=>'CHtml::link($data->username,array("/aSystemUser/view&id=$data->id"))',
        ),
		array(
			'name'=>'status',
            'type'=>'raw',
           // 'value'=>'Lookup::item("CategorynewsActive",$data->status)',
            'value'=>'CHtml::link(($data->status == 1) ? CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/tick.png\',\'image\') : CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/publish_x.png\',\'image\'),"javascript:void();",array(\'onclick\'=>"changeStatus($data->status,\'$data->id\')"))',
			//'filter'=>Lookup::items('UserStatus'),
		),
        'created_date',
        'phonenumber',
        array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
		),
        array(
            'name' => 'group_id',
            'value' => '$data->groups->group_title',
        ),
		/*'lastest_login',
		
		'ip',
		'group_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<!--
<ul id="content_toolbar">
    <li><a href="#" id="tickUnTickAll" onclick="return checkAll()"><?php echo Yii::t('adm/app','selectall');?></a></li>
    <li><input type="button" name="" id="activeAll" value="<?php echo Yii::t('adm/app','Enable');?>"/></li>
    <li><input type="button" name="" id="unActiveAll" value="<?php echo Yii::t('adm/app','disable');?>"/></li>
    <li><input type="button" name="" id="deleteAll" value="<?php echo Yii::t('adm/app','delete');?>"/></li>
</ul>
-->
<script type="text/javascript">
    $(document).ready(function(){
        $('#activeAll').click(function(){
            var items = getCheckedItems();
            if(items){
                var cf = confirm('Bạn có muốn kích hoạt toàn bộ item được chợn?')
                if(cf)
                    //window.location = '<?php echo Yii::app()->request->baseUrl;?>/bcategorynews/activeAll/status/1/ids/'+items;
                    window.location = '<?php echo $this->createUrl('activeAll');?>/status/1/ids/'+items;
            }else{
                alert('Chưa có item nào được chọn')
            }
        })
        
        $('#unActiveAll').click(function(){
            var items = getCheckedItems();
            if(items){
                var cf = confirm('Bạn có muốn ngừng kích hoạt toàn bộ item được chọn ?')
                if(cf)
                    //window.location = '<?php echo Yii::app()->request->baseUrl;?>/bcategorynews/activeAll/status/0/ids/'+items;
                    window.location = '<?php echo $this->createUrl('activeAll');?>/status/0/ids/'+items;
            }else{
                alert('Chưa có item nào được chọn')
            }
        })

        $('#deleteAll').click(function(){
            var items = getCheckedItems();
            if(items){
                var cf = confirm('Bạn cố muốn xóa toàn bộ item được chọn?')
                if(cf)
                    //window.location = '<?php echo Yii::app()->request->baseUrl;?>/bcategorynews/deleteAll/ids/'+items;
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
</script>
