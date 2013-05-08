<?php
/* @var $this BlockingDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blocking Datas',
);

$this->menu=array(
	array('label'=>'Create BlockingData', 'url'=>array('create')),
	array('label'=>'Manage BlockingData', 'url'=>array('admin')),
);
?>

<h1>Blocking Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
