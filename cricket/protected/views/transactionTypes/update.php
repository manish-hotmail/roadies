<?php
/* @var $this TransactionTypesController */
/* @var $model TransactionTypes */

$this->breadcrumbs=array(
	'Transaction Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransactionTypes', 'url'=>array('index')),
	array('label'=>'Create TransactionTypes', 'url'=>array('create')),
	array('label'=>'View TransactionTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TransactionTypes', 'url'=>array('admin')),
);
?>

<h1>Update TransactionTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>