<?php
/* @var $this QuestionsController */
/* @var $data Questions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('pot_distributed')); ?>:</b>
	<?php echo CHtml::encode($data->pot_distributed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maximum_bid_amount')); ?>:</b>
	<?php echo CHtml::encode($data->maximum_bid_amount); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
	<?php echo CHtml::encode($data->start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
	<?php echo CHtml::encode($data->end_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo CHtml::encode($data->event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('correct_option')); ?>:</b>
	<?php echo CHtml::encode($data->correct_option); ?>
	<br />

	*/ ?>

</div>