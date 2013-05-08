<?php
/* @var $this OptionsController */
/* @var $model Options */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'options-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'option_text'); ?>
		<?php echo $form->textField($model,'option_text',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'option_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'question_id'); ?>
		<?php echo $form->dropDownList($model,'question_id',CHtml::listData(Questions::model()->findAll(),'id','title')); ?>
		<?php echo $form->error($model,'question_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_pot'); ?>
		<?php echo $form->textField($model,'total_pot'); ?>
		<?php echo $form->error($model,'total_pot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_bets'); ?>
		<?php echo $form->textField($model,'total_bets'); ?>
		<?php echo $form->error($model,'total_bets'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'odd'); ?>
		<?php echo $form->textField($model,'odd'); ?>
		<?php echo $form->error($model,'odd'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->