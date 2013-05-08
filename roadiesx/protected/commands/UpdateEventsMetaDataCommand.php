<?php

class UpdateEventsMetaDataCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$events = Events::model()->findAll();
		foreach($events as $id=>$event){			
    		$this->updateQuestionMetaData($event->id);
		}
	}
	
	public function updateQuestionMetaData($event_id){
		$events = Events::model()->findByPk($event_id);	
		$command = "SELECT COUNT(*) FROM bets WHERE event_id = $event_id";		
		$events->total_bets = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT SUM(bet_amount) FROM bets WHERE event_id = $event_id";
		$events->total_pot = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$events->save();
		//print_r($questions->getErrors());
	}
}	