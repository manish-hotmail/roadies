<?php
/* @var $this TransactionTypesController */
/* @var $model TransactionTypes */

$this->breadcrumbs=array(
	'Transaction Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TransactionTypes', 'url'=>array('index')),
	array('label'=>'Manage TransactionTypes', 'url'=>array('admin')),
);
?>

<h1>Create TransactionTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>