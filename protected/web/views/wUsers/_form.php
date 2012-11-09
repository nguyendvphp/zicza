<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
));
 ?>
	<p class="note"><?php echo Yii::t('web/app','field_required');?></p>
    
	<?php echo $form->errorSummary($model); ?>
    <div class="create_form_left">
            <div class="row">
        		<?php echo $form->labelEx($model,'fullname'); ?>
        		<?php echo $form->textField($model,'fullname',array('size'=>60,'maxlength'=>100)); ?>
        	</div>
    
            <div class="row">
        		<?php echo $form->labelEx($model,'username'); ?>
        		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
        	</div>
            
        	<div class="row">
        		<?php echo $form->labelEx($model,'password'); ?>
        		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>80)); ?>
        	</div>
            
            <div class="row">
        		<?php echo $form->labelEx($model,'repassword'); ?>
        		<?php echo $form->passwordField($model,'repassword',array('size'=>60,'maxlength'=>80)); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'email'); ?>
        		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'birthday'); ?>
        		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                    $this->widget('CJuiDateTimePicker',array(
                        'model'=>$model, //Model object
                        'language' => '',
                        'attribute'=>'birthday', //attribute name
                        'mode'=>'date', //use "time","date" or "datetime" (default)
                        'options'=>array(
                            'dateFormat'=>'yy-mm-dd'
                        ),
                        'htmlOptions'=>array(
                            'dateFormat'=>'Y-m-d',
                            'style'=>'width:210px;vertical-align:top;',
                            'value'=>date("Y-m-d",time()),
                        ),
                    ));
                ?>    
        	</div>
    </div>
    <div class="create_form_right">
            <div class="row">
        		<?php echo $form->labelEx($model,'company'); ?>
        		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100)); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'url'); ?>
        		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'mobile'); ?>
        		<?php echo $form->textField($model,'mobile',array('size'=>12,'maxlength'=>12)); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'address'); ?>
        		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
        	</div>
        
        	<div class="row">
        		<?php echo $form->labelEx($model,'group'); ?>
        		<?php //echo $form->textField($model,'group',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->dropDownList($model,'group',WFunction::getUserGroup(),array('size'=>1,'style'=>'width:222px')); ?>
        	</div>
    </div>
	
    <div class="clear"></div>
    
	<div class="row buttons">
		<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>Yii::t('web/app','create'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->