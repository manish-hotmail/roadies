<?php
/* @var $this OptionsController */
/* @var $data Options */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('option_text')); ?>:</b>
	<?php echo CHtml::encode($data->option_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question_id')); ?>:</b>
	<?php echo CHtml::encode($data->question_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_pot')); ?>:</b>
	<?php echo CHtml::encode($data->total_pot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_bets')); ?>:</b>
	<?php echo CHtml::encode($data->total_bets); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('odd')); ?>:</b>
	<?php echo CHtml::encode($data->odd); ?>
	<br />


</div>