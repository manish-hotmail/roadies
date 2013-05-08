<?php

class DistributeInviteBonusCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$criteria = new CDbCriteria;
		$criteria->condition = 'invite_money_status=:ims';
		$criteria->params = array(':ims'=>'transfer_pending');
		$users = UserInfo::model()->findAll($criteria);
		foreach ($users as $key => $user) {
			$this->distribute($user);
		}
	}
	
	public function distribute($user_invited) {
		date_default_timezone_set('Asia/Calcutta');
		$fid = $user_invited->uid;
		$criteria = new CDbCriteria;
		$criteria->condition = 'fid=:id';
		$criteria->params = array(':id'=>$fid);
		$inviter = InviteData::model()->find($criteria);
		print_r($inviter);
		$criteria1=new CDbCriteria;
		$criteria1->select='bonus_money';
		$criteria1->condition='id=:id';
		$criteria1->params=array(':id'=>6);
		// There should be a trnsaction type entry for first time entry in application bonus.
		$bonus=TransactionTypes::model()->find($criteria1);
		$transaction = new Transaction;
		if(isset($bonus->bonus_money)) {
			$transaction->amount = $bonus->bonus_money;
		}
		else {
			$transaction->amount = 600;
		}
		$criteria_u = new CDbCriteria;
		$criteria_u->condition = 'id=:id';
		$criteria_u->params = array(':id'=>$inviter->uid);
		$user = UserInfo::model()->find($criteria_u);
		$user->total_credits = $user->total_credits + $transaction->amount;
		$user->closing_balance = $user->closing_balance + $transaction->amount;
		$user->save();
		$user_invited->invite_money_status = 'transferred';
		$user_invited->save();
		
		
		$transaction->user_id = $user->id;
		$transaction->transaction_type = 6;
		
		$transaction->create_time = date("Y-m-d H:i:s");
		$transaction->save();
		$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
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