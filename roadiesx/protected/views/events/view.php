<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List all Events', 'url'=>array('index')),
	array('label'=>'Create Event', 'url'=>array('create')),
	array('label'=>'Update Event', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Event', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Events', 'url'=>array('admin')),
);
?>

<h1>Event: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'event_type',
		'title',
		'description',
		'status',
		'start_time',
		'end_time',
		//'share_image',
		//'share_text',
	),
)); ?>

<h3 style="border-bottom: 1px solid #bbb;">Questions</h3>

<div style="height: 30px;">
	<button style="float: right;" class="btn" onclick="gotoCreateQuestions()">+ ADD Question</button>	
</div>

<div style="clear: both; margin-top: 20px;">
<?php 
	foreach ($question_model as $key => $value) {
		$this->renderPartial('_question', array('question'=>$value));
	}
?>
</div>
<script>
	function gotoCreateQuestions(){
		window.location = "<?php echo $this->createUrl('/questions/create', array('event_id'=>$model->id));?>";
	}
	
	function gotoQuestion(question_id){
		window.location = "<?php echo $this->createUrl('/questions/view');?>?id="+question_id;
	}
</script>
