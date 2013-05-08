<?php
/* @var $this BetsController */
/* @var $model Bets */

$this->breadcrumbs=array(
	'Bets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bets', 'url'=>array('index')),
	array('label'=>'Create Bets', 'url'=>array('create')),
	array('label'=>'View Bets', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bets', 'url'=>array('admin')),
);
?>

<h1>Update Bets <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>