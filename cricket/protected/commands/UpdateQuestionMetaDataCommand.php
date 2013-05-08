<?php

class UpdateQuestionMetaDataCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$questions = Questions::model()->findAll();
		foreach($questions as $id=>$question){			
    		$this->updateQuestionMD($question->id);
		}
	}
	
	public function updateQuestionMD($question_id){
		$questions = Questions::model()->findByPk($question_id);	
		$command = "SELECT COUNT(*) FROM bets WHERE question_id = $question_id";		
		$questions->total_bets = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT SUM(bet_amount) FROM bets WHERE question_id = $question_id";
		$questions->total_pot = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$questions->save();
		echo $question_id."/n";
		//print_r($questions->getErrors());
	}
}		
