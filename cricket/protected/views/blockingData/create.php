<?php
/* @var $this BlockingDataController */
/* @var $model BlockingData */

$this->breadcrumbs=array(
	'Blocking Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BlockingData', 'url'=>array('index')),
	array('label'=>'Manage BlockingData', 'url'=>array('admin')),
);
?>

<h1>Create BlockingData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>