<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.ui.widget.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.iframe-transport.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.fileupload.js');?>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            var filepath = data.result.image_path;
            var filename = data.result.image_title;
            var fileext = data.result.image_ext;
            var image_id = data.result.id;
            $("#list_image").html("");
            $(".delete_image").html("");
            $("#list_image").html("<img class='image_upload' src='<?php echo Yii::app()->params->upload_path; ?>"+filepath+filename+"_110."+fileext+"' />")
            $(".delete_image").html("<img onclick='delete_image("+image_id+");' class='delete_image_button' src='<?php echo Yii::app()->baseUrl; ?>/images/delete.png' />")
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
	'id'=>'acategory-gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_title'); ?>
		<?php echo $form->textField($model,'category_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category_description'); ?>
		<?php echo $form->textField($model,'category_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'category_description'); ?>
	</div>

	<div class="row">
		<div class="cp_upload_logo" >
        <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>
                    <img class="upload_image_left" src="<?php echo Yii::app()->getRequest()->baseUrl; ?>/images/upload_image.png" />
                    <div class="upload_image_text"><?php echo Yii::t('adm/gallery','thumbnail'); ?></div>
                </span>
                <input id="fileupload" accept="*/" type="file" name="files" data-url="<?php echo Yii::app()->baseUrl; ?>/index.php?r=aCategoryGallery/upload" multiple>
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
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(0 => Yii::t('adm/gallery','disable'),1=>Yii::t('adm/gallery','enable')),array('prompt' => '(Chọn trạng thái...)')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'reset', 'icon'=>'remove', 'label'=>'Reset')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->