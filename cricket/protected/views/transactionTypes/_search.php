<?php
/* @var $this TransactionTypesController */
/* @var $model TransactionTypes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_description'); ?>
		<?php echo $form->textField($model,'transaction_description',array('size'=>60,'maxlength'=>5000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bet_based'); ?>
		<?php echo $form->textField($model,'bet_based',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_nature'); ?>
		<?php echo $form->textField($model,'transaction_nature',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bonus_money'); ?>
		<?php echo $form->textField($model,'bonus_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->