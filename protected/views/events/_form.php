<?php
/* @var $this EventsController */
/* @var $model Events */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'events-form',
	'enableAjaxValidation'=>TRUE,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'event_type'); ?>
		<?php echo ZHtml::enumDropDownList( $model,'event_type' ); ?>
		<?php echo $form->error($model,'event_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'description'); ?>
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
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    	$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'start_time', //attribute name
        'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array("dateFormat"=>'yy/mm/dd'), // jquery plugin options
        'language' => 'en_us'
		    ));
		?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    	$this->widget('CJuiDateTimePicker',array(
        'model'=>$model, //Model object
        'attribute'=>'end_time', //attribute name
        'mode'=>'datetime', //use "time","date" or "datetime" (default)
        'options'=>array("dateFormat"=>'yy/mm/dd'), // jquery plugin options
        'language' => 'en_us'
		    ));
		?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'share_image'); ?>
		<?php echo $form->fileField($model,'share_image',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'share_image'); ?>
	</div>
	<?php if($model->isNewRecord!='1'){ ?>
	<div class="row">
	     <?php echo CHtml::image(Yii::app()->request->baseUrl.'/uploads/'.$model->share_image,"share_image",array("width"=>200)); ?>
	</div>
	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'share_text'); ?>
		<?php echo $form->textField($model,'share_text',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'share_text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->