<?php
/* @var $this TransactionTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transaction Types',
);

$this->menu=array(
	array('label'=>'Create TransactionTypes', 'url'=>array('create')),
	array('label'=>'Manage TransactionTypes', 'url'=>array('admin')),
);
?>

<h1>Transaction Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
