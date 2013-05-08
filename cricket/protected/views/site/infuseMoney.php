<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Infuse Money';
$this->breadcrumbs=array(
	'Infuse Money',
);
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<div style="margin: 10% 30%; padding: 20px; width: 270px; border: 1px solid #bbb; border-radius: 5px;">
	<h1>Infuse Money</h1>
	
	<p>Please fill out the following form with your credentials:</p>
	
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'infusion-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	
		<div class="row">
			<?php echo $form->labelEx($model,'event'); ?>
			<?php 
				echo $form->dropDownList($model,'event',CHtml::listData(Events::model()->findAll(),'id','title'), 
				array(	
					'prompt' => ' Select Event ', 
					'ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('events/getQuestions'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						'update'=>'#question', //selector to update
						//'data'=>array('district'=>'js:this.value'),
						//'data'=>'js:javascript statement' 
						//leave out the data key to pass all form values through
					)
				));
			?>
			<?php echo $form->error($model,'event'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'question'); ?>
			<?php 
				echo $form->dropDownList($model,'question',array(),
				array(		
				'id' => 'question',			
					'prompt' => ' Select Question ', 
					'ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('events/getOptions'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						'update'=>'#option', //selector to update
						//'data'=>array('district'=>'js:this.value'),
						//'data'=>'js:javascript statement' 
						//leave out the data key to pass all form values through
					)
				));
			?>
			<?php echo $form->error($model,'question'); ?>		
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'option'); ?>
			<?php 
				echo $form->dropDownList($model,'option',array(),
				array(
					'id' => 'option',
					'prompt' => 'Select Option'
				));
			?>
			<?php echo $form->error($model,'option'); ?>		
		</div>
		
		<div class="row">
			<?php echo $form->labelEx($model,'amount'); ?>
			<?php echo $form->textField($model,'amount'); ?>
			<?php echo $form->error($model,'amount'); ?>		
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton('Infuse'); ?>
		</div>
	
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>