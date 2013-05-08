<?php

class UpdateEntitiesStatusCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$events = Events::model()->findAll();
		foreach($events as $id=>$event){
    		$this->changeEventStatus($event);
		}
    	$questions = Questions::model()->findAll();
		foreach($questions as $id=>$question){
    		$this->changeQuestionStatus($question);
		}
	}
	
	public function changeEventStatus($event) {
		date_default_timezone_set('Asia/Calcutta');
		$start_time = strtotime($event->start_time);
		$end_time = strtotime($event->end_time);
		$today = strtotime(date('Y-m-d H:i:s'));
		if($start_time > $today) {
			$event->status = 'upcoming';
		}
		else {
			if($end_time > $today) {
				$event->status = 'current';
			}
			else {
				$event->status = 'closed';
			}
		}
		$event->save();
	}
	
	public function changeQuestionStatus($question) {
		date_default_timezone_set('Asia/Calcutta');
		$start_time = strtotime($question->start_time);
		$end_time = strtotime($question->end_time);
		$today = strtotime(date('Y-m-d H:i:s'));
		if($start_time > $today) {
			$question->status = 'upcoming';
		}
		else {
			if($end_time > $today) {
				$question->status = 'current';
			}
			else {
				$question->status = 'closed';
			}
		}
		$question->save();
	}
}	