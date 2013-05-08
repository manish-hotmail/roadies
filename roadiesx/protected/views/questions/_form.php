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
	
	<?php if (!isset($_GET['event_id'])){ ?>
		<div class="row">
			<?php echo $form->labelEx($model,'event_id'); ?>
			<?php echo $form->dropDownList($model,'event_id',CHtml::listData(Events::model()->findAll(),'id','title')); ?>
			<?php echo $form->error($model,'event_id'); ?>
		</div>
	<?php } else {
		$model->event_id = $_GET['event_id'];
	}?>
	
	<?php if(isset($model->id)) { ?>
	<div class="row">
		<?php
			if(isset($model->id)) {
				$options = array();
				$option['id'] = 'undefined';
				$option['option_text'] = 'undefined';
				array_push($options, $option);				
				$criteria = new CDbCriteria;
				$criteria->select = 'id, option_text';
				$criteria->condition = 'question_id=:qid';
				$criteria->params = array(':qid'=>$model->id);
				foreach (Options::model()->findAll($criteria) as $key => $value) {
					$option['id'] = $value->id;
					$option['option_text'] = $value->option_text;
					array_push($options,$option);
				}				
				$option['id'] = 'cancelled';
				$option['option_text'] = 'cancelled';
				array_push($options, $option);
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
		<a style="margin-left: 15%;" href='javascript:goback()'>cancel</a>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	function goback(){
		window.location ="<?php echo Yii::app()->request->urlReferrer; ?>";
	}
</script>