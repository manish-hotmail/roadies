<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->breadcrumbs=array(
	'User Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserInfo', 'url'=>array('index')),
	array('label'=>'Create UserInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-info-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Infos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-info-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'uid',
		'first_name',
		'middle_name',
		'last_name',
		'gender',
		/*
		'location',
		'email',
		'username',
		'total_credits',
		'total_debits',
		'closing_balance',
		'create_time',
		'last_visit',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
