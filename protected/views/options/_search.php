<?php
/* @var $this OptionsController */
/* @var $model Options */
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
		<?php echo $form->label($model,'option_text'); ?>
		<?php echo $form->textField($model,'option_text',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'question_id'); ?>
		<?php echo $form->textField($model,'question_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_pot'); ?>
		<?php echo $form->textField($model,'total_pot'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_bets'); ?>
		<?php echo $form->textField($model,'total_bets'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'odd'); ?>
		<?php echo $form->textField($model,'odd'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->