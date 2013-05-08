<?php
date_default_timezone_set('Asia/Calcutta');
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	
	public function actionCompletedEvents()
	{
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		if ($status == 'TRUE')
		{
			$fb_me = $authentic->getMe();			
			$uid = $fb_me['id'];
			$criteria = new CDbCriteria;
			$criteria->select = 'id';
			$criteria->condition='uid=:u';
			$criteria->params=array(':u'=>$uid);	
			$me_model = UserInfo::model()->find($criteria);
			if ($me_model !== NULL) {
				$criteria = new CDbCriteria;
				$criteria->condition='status=:status';
				$criteria->params=array(':status'=>'closed');
				$eventModel = Events::model()->findAll($criteria);
				/*
				$this->render('completed_events', array(
					'eventModel'=>$eventModel,
				));
				 */
				 $completed_event = array();
				 $completed_events_array = array();
				foreach ($eventModel as $key => $event) {
					 $event_id = $event->id;
					 $user_id = $me_model->id;
					 $command1 = "SELECT SUM(amount) FROM transaction WHERE event_id = $event_id AND user_id = $user_id AND transaction_type = 3";	
					 $investment = intval(Yii::app()->db->createCommand($command1)->queryScalar());	
					 $command2 = "SELECT SUM(amount) FROM transaction WHERE event_id = $event_id AND user_id = $user_id AND ((transaction_type = 4) OR (transaction_type = 5))";	
					 $winnings = intval(Yii::app()->db->createCommand($command2)->queryScalar());	
					 $completed_event['id'] = $event_id;
					 $completed_event['title'] = $event->title;
					 $completed_event['end_time'] = $event->end_time;
					 $completed_event['total_pot'] = $event->total_pot;
					 $completed_event['investment'] = $investment;
					 $completed_event['winnings'] = $winnings;
					 array_push($completed_events_array, $completed_event);		
				}
				$this->render('completed_events', array(
					'eventModel'=>$eventModel, 'completed_events_array'=>$completed_events_array
				));
			} else {
				echo $status;
			}
		} else {
			$this->redirect(array('/application/main'));
		}
	}
	
	public function actionGetUserData(){
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		if ($status == 'TRUE')
		{
			$fb_me = $authentic->getMe();			
			$me = $fb_me['id'];
			$question_id = $_GET['question_id'];
			//$user_model = getUserBalance($fb_me['id']);
			$user_model = $this->getUserBalance($me);
			if ($user_model !== NULL){
				foreach ($user_model as $key => $value) {
					$id = $value->id;
					$user_balance = $value->closing_balance;
				}
				$user_question_pot = $this->getUserPot($id, $question_id);	
				if($user_question_pot !== NULL)
					$user_info['question_pot_user'] = $user_question_pot;
				else
					$user_info['question_pot_user'] = 0;
				$user_info['user_balance'] = $user_balance;
				echo json_encode($user_info);
			} else {
				echo "error_2";
			}			
		 } else {
			$this->redirect(array('/application/main'));
		 }
	}
	
	public function getUserBalance($uid){
		$criteria = new CDbCriteria;
		$criteria->select = "id, closing_balance";
		$criteria->condition='uid=:u';
		$criteria->params=array(':u'=>$uid);
		$user_balance=UserInfo::model()->findAll($criteria);
		return $user_balance;
	}
	
	public function getUserPot($uid, $question_id){
		$command = "SELECT SUM(bet_amount) as 'sum' FROM bets WHERE user_id = $uid AND question_id = $question_id";
		return Yii::app()->db->createCommand($command)->queryScalar();
	}
	
	/*
	 * Returns User Balance and User Question Pot Total Information to the view 
	 * */	
	public function actionSaveBid(){
		$question_id = $_GET['question_id'];
		$option_id = $_GET['option_id'];
		$bid_amount = $_GET['bid'];
		$question_max_bid_amount = $_GET['question_max_bid_amount'];
		//$user_model = getUserBalance($fb_me['id']);
		$question_model = Questions::model()->findByPk($question_id);
		$question_max_bid_amount = $question_model->maximum_bid_amount;
		if (strtotime($question_model->end_time) < time()){
			echo "ERROR: Oops! you are late, Bidding on this question is closed";	
		} else {
			$authentic = new Authentication();
	        $status = $authentic->authenticate();
			if ($status == 'TRUE')
			{
				$fb_me = $authentic->getMe();			
				$me = $fb_me['id'];
				$criteria1 = new CDbCriteria;
				$criteria1->condition = 'uid=:u';
				$criteria1->params = array('u'=>$fb_me['id']);
				$user = UserInfo::model()->find($criteria1);
				if($user->invite_money_status == 'invited') {
					$user->invite_money_status = 'transfer_pending';
					$user->save();
					print_r($user->getErrors());
				}
				$user_model = $this->getUserBalance($me);
				if ($user_model !== NULL){
					foreach ($user_model as $key => $value) {
						$id = $value->id;
						$user_balance = $value->closing_balance;
					}
					$user_question_pot = $this->getUserPot($id, $question_id);	
					if($user_question_pot === NULL){
						$user_question_pot = 0;
					}
					
					if (($user_question_pot + $bid_amount) > $question_max_bid_amount){
						echo "ERROR: Maximum bid amount is ".$question_max_bid_amount." for this question. You have already bid: ".$bid_amount;
					} else if ($bid_amount > $question_max_bid_amount){
						echo "ERROR: Maximum bid amount is ".$question_max_bid_amount." for this question.";
					} else {
						$question_model = Questions::model()->findAllByPk($question_id);
						foreach ($question_model as $key => $value) {
							$event_id = $value->event_id;	
						}
						$bid_amount = abs($bid_amount);
						if ($this->saveBidInfo($id, $bid_amount, $question_id, $option_id, $event_id)){
							/* We need to pass $id rather than $me to update user closing balance */
							$user_balance = $this->updateUserProfileInfo($id, $bid_amount);	
							$trans_create_time = $this->saveTransactionInfo($id, $bid_amount, $question_id, $option_id, $event_id);
							$this->saveBankReconInfo($id, $bid_amount, $trans_create_time);
												
							/* Send updated Balance information to the View */
							$user_info['question_pot_user'] = $user_question_pot + $bid_amount;
							$user_info['user_balance'] = $user_balance;
							echo json_encode($user_info);
						} else {
							echo "ERROR: Sorry We lost your Bid";
						}			
					}
				} else {
					echo "ERROR: Sorry We Lost You";
				}		
			} else {
				$this->redirect(array('/application/main'));
			}
		}		
	}
	
	protected function saveBidInfo($user_id, $bid_amount, $question_id, $option_id, $event_id){
		$criteria = new CDbCriteria;
		$criteria->condition='user_id=:u AND option_id=:o';
		$criteria->params=array(':u'=>$user_id, ':o'=>$option_id);
		$model = Bets::model()->find($criteria);
		if ($model === NULL){
			$bid_model = new Bets;
			$bid_model->user_id = $user_id;
			$bid_model->option_id = $option_id;
			$bid_model->question_id = $question_id;
			$bid_model->event_id = $event_id;
			$bid_model->bet_amount = $bid_amount;
			$bid_model->create_time = date("Y-m-d H:i:s");
			return $bid_model->save();
		} else {
			//print_r($model);
			$model->bet_amount = $model->bet_amount + $bid_amount;
			return $model->save();
		}	
		
		
	}
	
	protected function saveTransactionInfo($user_id, $bid_amount, $question_id, $option_id, $event_id){
		$transaction_model = new Transaction;
		$transaction_model->user_id = $user_id;
		$transaction_model->option_id = $option_id;
		$transaction_model->question_id = $question_id;
		$transaction_model->event_id = $event_id;
		/* Transaction type 3 is for bid/debit */
		$transaction_model->transaction_type = 3;
		$transaction_model->amount = $bid_amount;
		$transaction_model->create_time = date("Y-m-d H:i:s");
		$transaction_model->save();
		return $transaction_model->create_time;
	}
	
	protected function saveBankReconInfo($user_id, $bid_amount, $trans_create_time){
		$bankRecon = new BankReconciliation;
		$bankRecon->transaction_type = 3;
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
	
	/* Save User Profile Closing Balance 
	 * Requires Primary Key $id rather than $uid
	 * Returns Closing Balance Information
	 * */
	protected function updateUserProfileInfo($user_id, $bid_amount){
		$user_model=UserInfo::model()->findByPk($user_id);
		if($user_model!==null){
			$user_model->total_debits = ($user_model->total_debits + $bid_amount);
			$user_model->closing_balance = ($user_model->closing_balance - $bid_amount);
			$user_model->save();
			return $user_model->closing_balance;
		}
	}
	
	public function actionGetEventData(){
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		if ($status == 'TRUE')
		{
			$fb_me = $authentic->getMe();			
			$uid = $fb_me['id'];
			$criteria = new CDbCriteria;
			$criteria->condition='uid=:u';
			$criteria->params=array(':u'=>$uid);	
			$me_model = UserInfo::model()->findAll($criteria);
			if ($me_model !== NULL) {
				foreach ($me_model as $key => $value) {
					$me = $value->id;
					$user_name = $value->first_name;
				}
				$id = $_GET['id'];
				$question_array = array();
				$EventModel=Events::model()->findAllByPk($id);
				foreach ($EventModel as $key => $value) {
					$event_model_status = $value->status;	
				}
				$user_info = '';
				
				/* Get All the Questions */
				$criteria = new CDbCriteria;
				$criteria->condition = 'event_id = '.$id;
				$criteria->order = 'start_time desc';
				//$criteria->order = 'start_time desc'
				$QuestionsModel = Questions::model()->findAll($criteria);
				$question_array_array = array();
				
				/* Get all the Options Related to Questions */
				foreach ($QuestionsModel as $key => $value) {
					$question_array = array();								
					$criteria = new CDbCriteria;
					$criteria->condition = 'question_id = '.$value->id;
					$OptionsModel = Options::model()->findAll($criteria);
					
					$question_array['id'] = $value->id;
					$question_array['title'] = $value->title;
					$question_array['status'] = $value->status;
					$question_array['pot_distributed'] = $value->pot_distributed;
					$question_array['maximum_bid_amount'] = $value->maximum_bid_amount;
					$question_array['correct_option'] = $value->correct_option;
					$question_array['end_time'] = strtotime($value->end_time);			
					$option_array = array();
					foreach ($OptionsModel as $option_key => $option_value) {
						$option = array();				
						$option['id'] = $option_value->id;
						$option['option_text'] = $option_value->option_text;
						$option['total_pot'] = $option_value->total_pot;
						$option['total_bets'] = $option_value->total_bets;
						$option['odd'] = $option_value->odd;
						$command = "SELECT SUM(bet_amount) FROM bets WHERE option_id = $option_value->id AND user_id = $me";
						$option['your_bet'] = intval(Yii::app()->db->createCommand($command)->queryScalar());	
						array_push($option_array, $option);			
					}			
					$question_array['options'] = $option_array;
					array_push($question_array_array, $question_array);
				}
				if ($event_model_status === 'current'){
					$this->render('event', array('question_array'=>$question_array_array, 'EventModel'=>$EventModel, 'user_id'=>$me, 'user_name'=>$user_name));	
				} else {
					$this->render('event_closed', array('question_array'=>$question_array_array, 'EventModel'=>$EventModel, 'user_id'=>$me, 'user_name'=>$user_name));	
				}				
			} else {
				// redirect here
			}			
		} else {
			$this->redirect(array('/application/main'));
		}
	}
	
	public function actionGetUserProfileData(){
		
		/*$authentic = new Authentication();
        $status = $authentic->authenticate();
		if ($status == 'TRUE')
		{
			$fb_me = $authentic->getMe();			
			$me = $fb_me['id'];*/
			$me = $_GET['uid'];
			$criteria = new CDbCriteria;
			$criteria->condition='uid=:u';
			$criteria->params=array(':u'=>$me);
			$user_model=UserInfo::model()->findAll($criteria);		
			
			if ($user_model !== NULL) {
				foreach ($user_model as $key => $value) {
					$user_info['id'] = $me;
					$user_info['participant_id'] = $value->id;
					$user_info['name'] = $value->first_name;
					$user_info['balance'] = $value->closing_balance;
					$user_info['winnings'] = $value->total_credits;
					$user_info['invested_amount'] = $value->total_debits;
					$command = "SELECT count(*) from user_info where closing_balance > (select closing_balance from user_info where id =". $value->id . ")" ;
					//$command = "SELECT id_me FROM (SELECT *, @rownum:=@rownum + 1 AS id_me FROM user_info, (SELECT @rownum:=0) r ORDER BY closing_balance desc) d where id='" . $value->id . "'";
					if($value->block_status == 'block') {
						$user_info['rank'] = 'Blocked';
					}
					else {
						$user_info['rank'] = intval(Yii::app()->db->createCommand($command)->queryScalar()) + 1;
					}
				}
				echo json_encode($user_info);
			} else {
				echo "error_2";
			}	/*		
		 } else {
		 	echo "error_1";
		 } */
	}
	
	public function actionUpdateMetaData()
	{
		$id = $_GET['id'];
		$me = $_GET['user_id'];
		$dataArray = array();
		$question_array = array();
		$EventModel=Events::model()->findAllByPk($id);
		foreach ($EventModel as $key => $value) {
			$dataArray['eventTotalBets'] = $value->total_bets;
			$dataArray['eventTotalPot'] = $value->total_pot;
		}
		/* Get All the Questions */
		$criteria = new CDbCriteria;
		$criteria->condition = 'event_id = '.$id;
		$QuestionsModel = Questions::model()->findAll($criteria);
		$question_array_array = array();
		/* Get all the Options Related to Questions */
		foreach ($QuestionsModel as $key => $value) {
			$question_array = array();
						
			$criteria = new CDbCriteria;
			$criteria->condition = 'question_id = '.$value->id;
			$OptionsModel = Options::model()->findAll($criteria);
			
			$question_array['id'] = $value->id;
			$question_array['status'] = $value->status;
			$question_array['potDistributed'] = $value->pot_distributed;
			$question_array['end_time'] = strtotime($value->end_time);			
			$option_array = array();
			foreach ($OptionsModel as $option_key => $option_value) {
				$option = array();				
				$option['id'] = $option_value->id;
				$option['totalPot'] = $option_value->total_pot;
				$option['totalBets'] = $option_value->total_bets;
				$option['odd'] = $option_value->odd;
				$command = "SELECT SUM(bet_amount) FROM bets WHERE option_id = $option_value->id AND user_id = $me";
				$option['yourBet'] = intval(Yii::app()->db->createCommand($command)->queryScalar());	
				//$option['yourBet'] = 100;	
				array_push($option_array, $option);			
			}			
			$question_array['options'] = $option_array;
			array_push($question_array_array, $question_array);			
		}
		$dataArray['questionInfo'] = $question_array_array;
		echo json_encode($dataArray);
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('/admin/index'));
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/*
	 public function actionBackupData(){
        $criteria = new CDbCriteria;
        $criteria->condition='id >= 50000 AND id <60000';
        $backup_data = Bets::model()->findAll($criteria);
        foreach ($backup_data as $key => $value) {
            $trans_data = new Transaction();
            $trans_data->user_id = $value->user_id;
            $trans_data->transaction_type = 3;
            $trans_data->amount = $value->bet_amount;
            $trans_data->question_id = $value->question_id;
            $trans_data->option_id = $value->option_id;
            $trans_data->event_id = $value->event_id;
            $trans_data->create_time = $value->create_time;
            $trans_data->save();
        }
    }*/
	/*
	 public function actionBackupData(){
        $criteria = new CDbCriteria;
        $criteria->condition='id >= 90000 AND id <103020 AND transaction_type IN (1,2,6,7,8,10,11)';
        $backup_data = BankReconciliation::model()->findAll($criteria);
        foreach ($backup_data as $key => $value) {
            $trans_data = new Transaction();
            $trans_data->user_id = $value->end_user_id;
            $trans_data->transaction_type = $value->transaction_type;
            $trans_data->amount = $value->trans_amount;
            $trans_data->create_time = $value->trans_create_time;
            $trans_data->save();
        }
    }*/
}