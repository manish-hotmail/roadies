<?php

class DistributeMoneyCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$criteria = new CDbCriteria;
		$criteria->select = 'id, correct_option';
		$criteria->condition = 'status="closed" AND pot_distributed="no" AND correct_option<>"undefined"';
    	$questions = Questions::model()->findAll($criteria);
		foreach($questions as $id=>$question){
			//print_r($question->correct_option);
    		$this->getBets($question->correct_option, $question->id);
		}
	}
	
	public function getBets($correct_option, $question_id) {
		date_default_timezone_set('Asia/Calcutta');
		if($correct_option == 'cancelled') {
			$criteria = new CDbCriteria;
			$criteria->select = 'user_id, bet_amount, event_id';
			$criteria->condition = 'question_id=:question_id';
			$criteria->params = array(':question_id'=>$question_id);
			$bets = Bets::model()->findAll($criteria);
			$option_odd = 1;
			$transaction_type = 4;
		} else {
			$criteria = new CDbCriteria;
			$criteria->select = 'user_id, bet_amount, event_id';
			$criteria->condition = 'option_id=:correct_option';
			$criteria->params = array(':correct_option'=>$correct_option);
			$bets = Bets::model()->findAll($criteria);
			$criteria1 = new CDbcriteria;
			$criteria1->select = 'odd';
			$criteria1->condition = 'id=:correct_option';
			$criteria1->params = array(':correct_option'=>intval($correct_option));
			$option = Options::model()->find($criteria1);
			$option_odd = $option->odd;
			$transaction_type = 5;
		}
		foreach ($bets as $key => $value) {
			$transaction = new Transaction;
			$transaction->user_id = $value->user_id;
			$transaction->transaction_type = $transaction_type;
			$transaction->amount = intval($value->bet_amount * $option_odd);
			$transaction->question_id = $question_id;
			$transaction->option_id = intval($correct_option);
			$transaction->event_id = $value->event_id;
			$transaction->create_time = date("Y-m-d H:i:s");
			$save_status = $transaction->save();
			$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
			
			//print_r($transaction->getErrors());
			if($save_status) {
				$user = UserInfo::model()->findByPk($value->user_id);
				$user->total_credits = $user->total_credits + intval($value->bet_amount * $option_odd);
				$user->closing_balance = $user->closing_balance + intval($value->bet_amount * $option_odd);
				$user->save();
				//print_r($user->getErrors());
			}
		}
		$question = Questions::model()->findByPk($question_id);
		$question->pot_distributed = 'yes';
		$question->save();
	}

	protected function saveBankReconInfo($user_id, $bid_amount, $trans_create_time, $trans_type){
		date_default_timezone_set('Asia/Calcutta');
		$bankRecon = new BankReconciliation;
		$bankRecon->transaction_type = $trans_type;
		$trans = TransactionTypes::model()->findByPk($bankRecon->transaction_type);		
		$bankRecon->transaction = $trans->transaction_nature;
		$bankRecon->end_user_id = $user_id;
		$bankRecon->trans_amount = $bid_amount;
		$bankRecon->trans_create_time = $trans_create_time;
		$bankRecon->bank_balance = $bankRecon->bank_balance + $bid_amount;
		$bankRecon->recon_status = "unchecked";
		$bankRecon->create_time = date("Y-m-d H:i:s");
		return $bankRecon->save();
	}
}	