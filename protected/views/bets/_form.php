<?php
/* @var $this BetsController */
/* @var $model Bets */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bets-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'option_id'); ?>
		<?php echo $form->textField($model,'option_id'); ?>
		<?php echo $form->error($model,'option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'question_id'); ?>
		<?php echo $form->textField($model,'question_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'question_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event_id'); ?>
		<?php echo $form->textField($model,'event_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'event_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bet_amount'); ?>
		<?php echo $form->textField($model,'bet_amount'); ?>
		<?php echo $form->error($model,'bet_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->