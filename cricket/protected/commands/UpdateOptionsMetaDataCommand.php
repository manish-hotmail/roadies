<?php

class UpdateOptionsMetaDataCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$options = Options::model()->findAll();
		foreach($options as $id=>$option){			
    		$this->updateQuestionMetaData($option->id);
		}
	}
	
	public function updateQuestionMetaData($option_id){
		$options = Options::model()->findByPk($option_id);	
		$command = "SELECT total_pot FROM questions WHERE id = $options->question_id";		
		$question_total_bets = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT COUNT(*) FROM bets WHERE option_id = $option_id";		
		$options->total_bets = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT SUM(bet_amount) FROM bets WHERE option_id = $option_id";
		$options->total_pot = intval(Yii::app()->db->createCommand($command)->queryScalar());
		if ($options->total_pot != 0)
			$options->odd = round(($question_total_bets/$options->total_pot),2);
		else 
			$options->odd = 1;
		$options->save();
		//print_r($questions->getErrors());
	}
}		