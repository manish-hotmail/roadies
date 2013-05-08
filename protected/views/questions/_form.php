<?php
/* @var $this QuestionsController */
/* @var $model Questions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'questions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'title'); ?>
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
		<?php echo $form->labelEx($model,'pot_distributed'); ?>
		<?php echo ZHtml::enumDropDownList( $model,'pot_distributed' ); ?>
		<?php echo $form->error($model,'pot_distributed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maximum_bid_amount'); ?>
		<?php echo $form->textField($model,'maximum_bid_amount'); ?>
		<?php echo $form->error($model,'maximum_bid_amount'); ?>
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
		<?php echo $form->labelEx($model,'event_id'); ?>
		<?php echo $form->dropDownList($model,'event_id',CHtml::listData(Events::model()->findAll(),'id','title')); ?>
		<?php echo $form->error($model,'event_id'); ?>
	</div>
	<?php if(isset($model->id)) { ?>
	<div class="row">
		<?php
			if(isset($model->id)) {
				$criteria = new CDbCriteria;
				$criteria->select = 'id, option_text';
				$criteria->condition = 'question_id=:qid';
				$criteria->params = array(':qid'=>$model->id);
				$options = Options::model()->findAll($criteria);
			}
			else {
				$options = new ArrayObject;
				$options->id = 99;
				$options->option_text = 'undefind';
			}
		?>
		<?php echo $form->labelEx($model,'correct_option'); ?>
		<?php echo $form->dropDownList($model,'correct_option',CHtml::listData($options,'id','option_text')); ?>
		<?php echo $form->error($model,'correct_option'); ?>
	</div>
<?php } ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->