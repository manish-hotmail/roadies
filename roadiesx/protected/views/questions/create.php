<?php
/* @var $this QuestionsController */
/* @var $model Questions */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Create',
);
/*

$this->menu=array(
	array('label'=>'List Questions', 'url'=>array('index')),
	array('label'=>'Manage Questions', 'url'=>array('admin')),
);*/
?>

<h1>Create Question</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'event_id'=>$event_id)); ?>