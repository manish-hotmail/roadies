<?php
/* @var $this TransactionTypesController */
/* @var $model TransactionTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaction-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_description'); ?>
		<?php echo $form->textField($model,'transaction_description',array('size'=>60,'maxlength'=>5000)); ?>
		<?php echo $form->error($model,'transaction_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bet_based'); ?>
		<?php echo ZHtml::enumDropDownList( $model,'bet_based' ); ?>
		<?php echo $form->error($model,'bet_based'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_nature'); ?>
		<?php echo ZHtml::enumDropDownList( $model,'transaction_nature' ); ?>
		<?php echo $form->error($model,'transaction_nature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bonus_money'); ?>
		<?php echo $form->textField($model,'bonus_money'); ?>
		<?php echo $form->error($model,'bonus_money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    	$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'create_time', //attribute name
        'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array("dateFormat"=>'yy/mm/dd'), // jquery plugin options
        'language' => 'en_us'
		    ));
		?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    	$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'update_time', //attribute name
        'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array("dateFormat"=>'yy/mm/dd'), // jquery plugin options
        'language' => 'en_us'
		    ));
		?>
		<?php echo $form->error($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->