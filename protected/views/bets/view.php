<?php
/* @var $this BetsController */
/* @var $model Bets */

$this->breadcrumbs=array(
	'Bets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bets', 'url'=>array('index')),
	array('label'=>'Create Bets', 'url'=>array('create')),
	array('label'=>'Update Bets', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bets', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bets', 'url'=>array('admin')),
);
?>

<h1>View Bets #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'option_id',
		'question_id',
		'event_id',
		'bet_amount',
		'create_time',
	),
)); ?>
