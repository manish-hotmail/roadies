<?php
/* @var $this QuestionsController */
/* @var $model Questions */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->title,
);

$this->menu=array(
	//array('label'=>'List Questions', 'url'=>array('index')),
	//array('label'=>'Create Questions', 'url'=>array('create')),
	array('label'=>'Update Question', 'url'=>array('update', 'id'=>$model->id, 'event_id'=>$model->event_id)),
	array('label'=>'Delete Question', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Questions', 'url'=>array('admin')),
);
?>

<h1>Question: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'status',
		'maximum_bid_amount',
		'start_time',
		'end_time',
		'event_id',
		'correct_option',
	),
)); ?>

<div style="height: 30px; margin-top: 20px;">
	<button class="btn" onclick="gotoEvent()">Back to Event</button>
</div>

<h3 style="border-bottom: 1px solid #bbb;">Options</h3>

<div style="height: 30px;">
	<button style="float: right;" class="btn" onclick="gotoCreateOptions()">+ ADD Option</button>	
</div>

<div style="clear: both; margin-top: 20px;">
<?php 
	foreach ($option_model as $key => $value) {
		$this->renderPartial('_option', array('option'=>$value));
	}
?>
</div>

<script>
	function gotoEvent(){
		window.location = "<?php echo $this->createUrl('/events/view', array('id'=>$model->event_id));?>";
	}
	function gotoOption(option_id){
		window.location = "<?php echo $this->createUrl('/options/view');?>?id="+option_id;
	}
	function gotoCreateOptions(){
		window.location = "<?php echo $this->createUrl('/options/create', array('question_id'=>$model->id));?>";
	}
	
</script>
