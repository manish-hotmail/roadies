<?php
/* @var $this BetsController */
/* @var $model Bets */

$this->breadcrumbs=array(
	'Bets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bets', 'url'=>array('index')),
	array('label'=>'Manage Bets', 'url'=>array('admin')),
);
?>

<h1>Create Bets</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>