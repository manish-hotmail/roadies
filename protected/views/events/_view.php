<?php
/* @var $this EventsController */
/* @var $data Events */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_type')); ?>:</b>
	<?php echo CHtml::encode($data->event_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_pot')); ?>:</b>
	<?php echo CHtml::encode($data->total_pot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_bets')); ?>:</b>
	<?php echo CHtml::encode($data->total_bets); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_image')); ?>:</b>
	<?php echo CHtml::encode($data->share_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('share_text')); ?>:</b>
	<?php echo CHtml::encode($data->share_text); ?>
	<br />

	*/ ?>

</div>