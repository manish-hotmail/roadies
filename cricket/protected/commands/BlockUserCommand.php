<?php

class BlockUserCommand extends CConsoleCommand
{
    public function run($args)
    {
    	$criteria = new CDbCriteria;
		$criteria->condition = 'status=:status';
		$criteria->params = array(':status'=>'new');
		$new_block_users = BlockingData::model()->findAll($criteria);
		foreach ($new_block_users as $key => $value) {
			$this->block($value);
		}
		
	}
	
	public function block($user) {
		$criteria1 = new CDbCriteria;
		$criteria1->condition = 'uid=:uid';
		$criteria1->params = array(':uid'=>$user->uid);
		$user_to_block = UserInfo::model()->find($criteria1);
		$user_to_block->block_status = 'block';
		$user->status = 'blocked';
		$user->save();
		$user_to_block->save();
	}
}	

?>	