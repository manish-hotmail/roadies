<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<div style="margin: 10% 30%; padding: 20px; border: 1px solid #bbb; border-radius: 5px;">
	<h1>Login</h1>
	
	<p>Please fill out the following form with your login credentials:</p>
	
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>		
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton('Login'); ?>
		</div>
	
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>
