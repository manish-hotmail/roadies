<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->breadcrumbs=array(
	'User Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserInfo', 'url'=>array('index')),
	array('label'=>'Create UserInfo', 'url'=>array('create')),
	array('label'=>'Update UserInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserInfo', 'url'=>array('admin')),
);
?>

<h1>View UserInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'first_name',
		'middle_name',
		'last_name',
		'gender',
		'location',
		'email',
		'username',
		'total_credits',
		'total_debits',
		'closing_balance',
		'create_time',
		'last_visit',
	),
)); ?>
