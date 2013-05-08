<?php
/* @var $this OptionsController */
/* @var $model Options */

$this->breadcrumbs=array(
	'Options'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Options', 'url'=>array('index')),
	//array('label'=>'Create Options', 'url'=>array('create')),
	array('label'=>'Update Option', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Option', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Options', 'url'=>array('admin')),
);
?>

<h1>Option: <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'option_text',
		//'question_id',
		//'total_pot',
		//'total_bets',
		//'odd',
	),
)); ?>

<div style="height: 30px; margin-top: 20px;">
	<button class="btn" onclick="gotoQuestion()">Back to Question</button>
</div>

<script>
	function gotoQuestion(){
		window.location = "<?php echo $this->createUrl('/questions/view', array('id'=>$model->question_id));?>";
	}
</script>
