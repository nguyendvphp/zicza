<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.ui.widget.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.iframe-transport.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.fileupload.js');?>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            var filepath = data.result.image_path;
            var filename = data.result.image_title;
            var fileext = data.result.image_ext;
            var image_id = data.result.id; //alert(image_id);
            $("#list_image").html("");
            $(".delete_image").html("");
            $("#list_image").html("<img class='image_upload' src='<?php echo Yii::app()->params->upload_path; ?>"+filepath+filename+"_110."+fileext+"' />")
            /*$(".delete_image").html("<img onclick='delete_image("+image_id+");' class='delete_image_button' src='<?php echo Yii::app()->baseUrl; ?>/images/delete.png' />")*/
            /*$("#adv_file").val(filepath+filename+'.'+fileext)
            $("#adv_file_type").val(fileext)*/
            $("#file_id").val(image_id);
        }
    });
});

$(function () {
    $('#redactor_file').fileupload({
        dataType: 'html',
        done: function (e, data) { alert(data);
            var filepath = data.result.image_path; 
            var filename = data.result.image_title;
            var fileext = data.result.image_ext;
            //var image_id = data.result.id;
            $("#ANews_news_detail").html("");
            //$(".delete_image").html("");
            $("#ANews_news_detail").html("<img class='image_upload' src='<?php echo Yii::app()->params->upload_path; ?>"+filepath+filename+"_110."+fileext+"' />")
            /*$(".delete_image").html("<img onclick='delete_image("+image_id+");' class='delete_image_button' src='<?php echo Yii::app()->baseUrl; ?>/images/delete.png' />")*/
            /*$("#adv_file").val(filepath+filename+'.'+fileext)
            $("#adv_file_type").val(fileext)*/
            //$("#file_id").val(image_id);
        }
    });
});
</script>
<div class="form wide">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wuser-item-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Câc trường <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'style'=>'width:300px;','rel'=>'tooltip','title'=>'Hãy điền tên shop.Khoảng nhỏ hơn 80 kí tự.')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255,'style'=>'width:300px;','rel'=>'tooltip','title'=>'Hãy điền địa chỉ của cửa hàng.')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'phonenumber'); ?>
		<?php echo $form->textField($model,'phonenumber',array('size'=>60,'maxlength'=>255,'style'=>'width:300px;','rel'=>'tooltip','title'=>'Hãy điền số điện thoại của cửa hàng.')); ?>
		<?php echo $form->error($model,'phonenumber'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype',array('size'=>60,'maxlength'=>255,'style'=>'width:300px;','rel'=>'tooltip','title'=>'Hãy điền tên nick skype của cửa hàng.')); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'yahoo'); ?>
		<?php echo $form->textField($model,'yahoo',array('size'=>60,'maxlength'=>255,'style'=>'width:300px;','rel'=>'tooltip','title'=>'Hãy điền tên nick yahoo của cửa hang.')); ?>
		<?php echo $form->error($model,'yahoo'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255,'style'=>'width:300px;','rel'=>'tooltip','title'=>'Hãy điền giá sản phẩm.Bạn chỉ điền khi đây là sản phẩm')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php //echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
        <?php 
            $this->widget('ext.widgets.redactorjs.Redactor', array( 
                            'editorOptions' => array(
                                'autoresize' => true, 
                                'fixed' => false,
                                'imageUpload' => Yii::app()->createUrl('wUserItem/imageupload'),
                                ), 
                            'model' => $model, 
                            'attribute' => 'description',
                             
                        ));
            ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php //echo $form->textArea($model,'image',array('rows'=>6, 'cols'=>50)); ?>
        <div class="cp_upload_logo" >
        <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>
                    <img class="upload_image_left" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/upload_image.png" />
                    <div class="upload_image_text"><?php //echo Yii::t('adm/news','thumbnail'); ?></div>
                </span>
                <input id="fileupload" accept="*/" type="file" name="files" data-url="<?php echo Yii::app()->baseUrl; ?>/index.php?r=wUserItem/upload" multiple />
        </span>
        <input type="hidden" name="file_id" id="file_id" value="" />
        
        <br />
        <div class="clear"></div>
        <br />
        
        <div id="list_image">
            <?php 
                /*if($model->adv_file != ''){
                    $path = explode(".",$model->adv_file);
                    $path = $path[0]."_110".".".$path[1];
                    echo "<img class='image_upload' src='".Yii::app()->params->upload_path.$path."' />";
                }*/
             ?>
            
        </div>
        <div class="delete_image"></div>
        <div class="clear"></div>
        </div>
		<?php echo $form->error($model,'image'); ?>
	</div>


	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>$model->isNewRecord ? Yii::t('adm/staticpage','Tạo mới'):Yii::t('adm/staticpage','Lưu lại'))); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>Yii::t('adm/staticpage','reset'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
    $('#WUserItem_title').tooltip();
    $('#WUserItem_address').tooltip();
    $('#WUserItem_phonenumber').tooltip();
    $('#WUserItem_skype').tooltip();
    $('#WUserItem_yahoo').tooltip();
    $('#WUserItem_price').tooltip();
</script>