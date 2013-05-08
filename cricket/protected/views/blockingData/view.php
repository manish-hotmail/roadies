<?php
/* @var $this BlockingDataController */
/* @var $model BlockingData */

$this->breadcrumbs=array(
	'Blocking Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BlockingData', 'url'=>array('index')),
	array('label'=>'Create BlockingData', 'url'=>array('create')),
	array('label'=>'Update BlockingData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BlockingData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BlockingData', 'url'=>array('admin')),
);
?>

<h1>View BlockingData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'status',
	),
)); ?>
