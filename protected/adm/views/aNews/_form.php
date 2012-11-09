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
            var image_id = data.result.id; alert(image_id);
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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'anews-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note"><?php echo Yii::t('adm/app','field_required');?>.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="form_left"> 	

	<div class="row">
		<?php echo $form->labelEx($model,'news_title'); ?>
		<?php echo $form->textField($model,'news_title',array('size'=>79,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'news_title'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'news_category_id'); ?>
		<?php //echo $form->textField($model,'news_category_id'); ?>
        <?php echo $form->dropDownList($model,'news_category_id', CHtml::listData(ANewsCategories::model()->findAll(),"id","category_title")); ?>
		<?php echo $form->error($model,'news_category_id'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'news_short_description'); ?>
		<?php //echo $form->textField($model,'news_short_description',array('size'=>60,'maxlength'=>255)); ?>
        <?php $this->widget('ext.widgets.xheditor.XHeditor',array(
            	'model'=>$model,
            	'modelAttribute'=>'news_short_description',
            	'config'=>array(
            		'id'=>'xheditor_2',
            		'tools'=>'mini', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
            		'skin'=>'o2007blue', // default, nostyle, o2007blue, o2007silver, vista
            		'width'=>'500px',
            		'height'=>'200px',
            		//'loadCSS'=>XHtml::cssUrl('editor.css'),
                    'loadCSS' =>Yii::app()->baseUrl.'/css/editor.css', 
            		'upImgUrl'=>$this->createUrl('request/uploadFile'),
            		'upImgExt'=>'jpg,jpeg,gif,png',
            	),
            )); 
            ?>
		<?php echo $form->error($model,'news_short_description'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php //echo $form->textField($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',array(0 => Yii::t('adm/app','disable'),1=>Yii::t('adm/app','Enable')),array('prompt' => '(Chọn trạng thái...)')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority'); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row">
		<div class="cp_upload_logo" >
        <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>
                    <img class="upload_image_left" src="<?php echo Yii::app()->getRequest()->baseUrl; ?>/images/upload_image.png" />
                    <div class="upload_image_text"><?php echo Yii::t('adm/news','thumbnail'); ?></div>
                </span>
                <input id="fileupload" accept="*/" type="file" name="files" data-url="<?php echo Yii::app()->baseUrl; ?>/index.php?r=aNews/upload" multiple>
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
</div>
<div class="form_right">
	<div class="row">
		<?php echo $form->labelEx($model,'news_detail'); ?>
		<?php //echo $form->textArea($model,'news_detail',array('rows'=>6, 'cols'=>50)); ?>
        <?php /*$this->widget('ext.widgets.xheditor.XHeditor',array(
            	'model'=>$model,
            	'modelAttribute'=>'news_detail',
            	'config'=>array(
            		'id'=>'xheditor_1',
            		'tools'=>'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
            		'skin'=>'o2007blue', // default, nostyle, o2007blue, o2007silver, vista
            		'width'=>'600px',
            		'height'=>'400px',
            		//'loadCSS'=>XHtml::cssUrl('editor.css'),
                    'loadCSS' =>Yii::app()->baseUrl.'/css/editor.css', 
            		'upImgUrl'=>$this->createUrl('aNews/uploadFile'),
            		'upImgExt'=>'jpg,jpeg,gif,png',
            	),
            )); */
            $this->widget('ext.widgets.redactorjs.Redactor', array( 
                            'editorOptions' => array(
                                'autoresize' => true, 
                                'fixed' => true,
                                'imageUpload' => Yii::app()->createUrl('aNews/imageupload'),
                                ), 
                            'model' => $model, 
                            'attribute' => 'news_detail',
                             
                        ));
            ?>
		<?php echo $form->error($model,'news_detail'); ?>
	</div>

	
</div>
<div class="clear"></div>
    <div class="hr"></div>
    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('adm/app','create') : Yii::t('app','save'), array('class' => 'button orange')); ?>
        <?php echo CHtml::submitButton(Yii::t('adm/app','cancel'), array('submit' => $this->createUrl('admin'), 'class' => 'button orange')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->