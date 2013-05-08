<?php
/* @var $this TransactionTypesController */
/* @var $data TransactionTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_description')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bet_based')); ?>:</b>
	<?php echo CHtml::encode($data->bet_based); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_nature')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_nature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bonus_money')); ?>:</b>
	<?php echo CHtml::encode($data->bonus_money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />


</div>