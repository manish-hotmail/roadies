<?php	
	$event_name = '';
	foreach ($EventModel as $key => $value) {
		$event_id = $value->id;
		$event_name = $value->title;
		$event_info = "<table>";
			$event_info .= "<tr>";
				$event_info .= "<td style='width: 70%;'><h4 class='home_headers'><span class='header_text'>EVENT :</span><span>$value->title</span></h4></td>";
				$event_info .= "<td style='width: 5%;'></td>";
				$event_info .= "<td style='width: 25%;'><h4 class='total_pot'>TOTAL POT <br><span id='event_total_pot'>C$ $value->total_pot</span></h4></td>";
			$event_info .= "</tr>";
			$event_info .= "<tr><td colspan='3' ><h6><span>$value->description</span></h6></td></tr>";
		$event_info .= "</table>";
	}	
	echo $event_info;
	foreach ($question_array as $key => $value) {
		$this->renderPartial('_questionview_closed',array(
			'status'=>$value['status'],
			'pot_distributed'=>$value['pot_distributed'],
			'question_id'=>$value['id'],
			'question_text'=>$value['title'], 
			'correct_option'=>$value['correct_option'],
			'options'=>$value['options'], 
			'end_date'=>$value['end_time'], 
			'question_max_bid_amount' => $value['maximum_bid_amount'],
		));
	}
?>

<?php
	$this->pageTitle=Yii::app()->name . ' | RESULTS | '. $event_name;
	$this->breadcrumbs=array(
		'RESULTS'=>array('/site/completedEvents'),
		$event_name	
	);
?>