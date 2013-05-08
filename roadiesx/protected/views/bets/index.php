<?php
/* @var $this BetsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bets',
);

$this->menu=array(
	array('label'=>'Create Bets', 'url'=>array('create')),
	array('label'=>'Manage Bets', 'url'=>array('admin')),
);
?>

<h1>Bets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
