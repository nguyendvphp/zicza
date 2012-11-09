<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_title')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_description')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_price')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_number')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_size_album')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_size_album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_time_trans')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_time_trans); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_is_slideshow')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_is_slideshow); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_shirt_married')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_shirt_married); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_time_photo')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_time_photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_uniform')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_uniform); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_status')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gallery_cate_id')); ?>:</b>
	<?php echo CHtml::encode($data->gallery_cate_id); ?>
	<br />

	*/ ?>

</div>