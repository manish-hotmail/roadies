<?php
/* @var $this BlockingDataController */
/* @var $model BlockingData */

$this->breadcrumbs=array(
	'Blocking Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BlockingData', 'url'=>array('index')),
	array('label'=>'Create BlockingData', 'url'=>array('create')),
	array('label'=>'View BlockingData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BlockingData', 'url'=>array('admin')),
);
?>

<h1>Update BlockingData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>