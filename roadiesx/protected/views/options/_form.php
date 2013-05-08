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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<a style="margin-left: 15%;" href='javascript:goback()'>cancel</a>
	</div>

<?php $this->endWidget(); ?>

<script>
	function goback(){
		window.location ="<?php echo Yii::app()->request->urlReferrer; ?>";
	}
</script>
</div><!-- form -->