<?php
/* @var $this TransactionTypesController */
/* @var $model TransactionTypes */

$this->breadcrumbs=array(
	'Transaction Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TransactionTypes', 'url'=>array('index')),
	array('label'=>'Create TransactionTypes', 'url'=>array('create')),
	array('label'=>'Update TransactionTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransactionTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransactionTypes', 'url'=>array('admin')),
);
?>

<h1>View TransactionTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transaction_description',
		'bet_based',
		'transaction_nature',
		'bonus_money',
		'create_time',
		'update_time',
	),
)); ?>
