<?php
date_default_timezone_set('Asia/Calcutta');
class ApplicationController extends Controller {
	//public $fb_me;
	
	public $defaultAction = 'main';
	
	public function actionIndex() {		
		$this -> render('index');
	}
	
	public function actionMain() {
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		$alert = 0;
		$alert_text = '';
		if ($status == 'TRUE')
		{
			
			$facebook = $authentic->getFbRef();
			$access_token = $facebook->getAccessToken();
			$likes = $authentic->getFbPageLikes(147351511955143, $access_token);
			$fb_me = $authentic->getMe();	
			$criteria=new CDbCriteria;
			$criteria->condition='uid=:uid';
			$criteria->params=array(':uid'=>$fb_me['id']);
			$id=UserInfo::model()->find($criteria);
			if($id === null) {
				$criteria_invite = new CDbCriteria;
				$criteria_invite->condition = 'fid=:fid';
				$criteria_invite->params = array(':fid'=>$fb_me['id']);
				$invite = InviteData::model()->findAll($criteria_invite);
				$invite_count = count($invite);
				$user_model = new UserInfo;
				//echo $fb_me['id'];
				//echo $invite_count;
				if($invite_count != 0) {
					$user_model->invite_money_status = 'invited';
					//echo 'invited';
				}
				//var_dump($user_model);
				$user_model->uid = $fb_me['id'];
				$user_model->first_name = $fb_me['first_name'];
				//$user_model->last_name = $fb_me['last_name'];
				if (isset($fb_me['middle_name'])){
					$user_model->middle_name = $fb_me['middle_name'];	
				}
				if(isset($fb_me['location']['name'])) {
					$user_model->location = $fb_me['location']['name'];
				}
				$user_model->last_name = $fb_me['last_name'];	
				
				if(isset($fb_me['gender'])) {
					if($fb_me['gender'] == 'male') {
						$user_model->gender = 'm';
					}
					else if($fb_me['gender'] == 'female') {
						$user_model->gender = 'f';
					}
					else {
						$user_model->gender = 'n';
					}
				}
				else {
					$user_model->gender = 'n';	
				}
				if (isset($fb_me['username'])){
					$user_model->username = $fb_me['username'];
				} else {
					$user_model->username = $fb_me['id'];
				}
				if (isset($fb_me['email'])){
					$user_model->email = $fb_me['email'];
				}
				$user_model->create_time = date("Y-m-d H:i:s");
				$user_model->total_credits = 0;
				$user_model->closing_balance = 10000;				
				$user_model->last_visit = date('Y-m-d');
				$user_model->save();
				$id=UserInfo::model()->find($criteria);
				$criteria1=new CDbCriteria;
				$criteria1->select='bonus_money';
				$criteria1->condition='id=:id';
				$criteria1->params=array(':id'=>1);
				// There should be a trnsaction type entry for first time entry in application bonus.
				$bonus=TransactionTypes::model()->find($criteria1);
				$transaction = new Transaction;
				$transaction->user_id = $id->id;
				$transaction->transaction_type = 1;
				if(isset($bonus->bonus_money)) {
					$transaction->amount = $bonus->bonus_money;
				}
				else {
					$transaction->amount = 10000;
				}
				$transaction->create_time = date("Y-m-d H:i:s");
				$transaction->save();				
				$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
				$alert = 1;
				$alert_text .= 'Welcome to Roadies X Predictions! This is your opportunity to predict the future of Roadies and stand a chance to win an exclusive meet and greet with VJ Rannvijay! You will start the game with a grand booty of R$' . $transaction->amount . '<br><a href="javascript:showFaq()" >Click here</a> to get do, don’ts and tips about how to start predicting!';
			}
			else {
				$today = strtotime(date('Y-m-d'));
				$last_visit = strtotime($id->last_visit);
				if(($today-$last_visit)==0) {
					// do nothing
				}
				else {
						//provide daily bonus
						$bonus_amount = 0;
						$criteria1=new CDbCriteria;
						$criteria1->select='bonus_money';
						$criteria1->condition='id=:id';
						$criteria1->params=array(':id'=>2);
						$bonus=TransactionTypes::model()->find($criteria1);
						$transaction = new Transaction;
						$transaction->user_id = $id->id;
						$transaction->transaction_type = 2;
						if(isset($bonus->bonus_money)) {
							$transaction->amount = $bonus->bonus_money;
							$bonus_amount = $transaction->amount;
						}
						else {
							$transaction->amount = 2000;
							$bonus_amount = 2000;
						}
						$transaction->create_time = date("Y-m-d H:i:s");
						$transaction->save();
						$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
						
						$id->last_visit = date('Y-m-d');
						//$id->total_credits = $id->total_credits + $bonus_amount;
						$id->closing_balance = $id->closing_balance + $bonus_amount;
						$id->save();
						$alert = 1;
						$alert_text .= 'Hey, Good to see you again! Here&apos;s your daily bonus of '. $bonus_amount .'. Start predicting..<br>';
						//print_r($id->getErrors());
					}
			}
			$user = UserInfo::model()->findByPk($id->id);
			$bonus_status = $user->airtel_advantage_bonus;
			if($bonus_status != 'liked') {
					//$result = $facebook->api('/me/likes/136159143138850');
					$length = count($likes);
					//echo $length;
					if($length != 1) {
					$bonus_amount = 0;
					$criteria2=new CDbCriteria;
					$criteria2->select='bonus_money';
					$criteria2->condition='id=:id';
					$criteria2->params=array(':id'=>7);
					$bonus=TransactionTypes::model()->find($criteria2);
					$transaction = new Transaction;
					$transaction->user_id = $id->id;
					$transaction->transaction_type = 7;
					if(isset($bonus->bonus_money)) {
						$transaction->amount = $bonus->bonus_money;
						$bonus_amount = $transaction->amount;
					}
					else {
						$transaction->amount = 2000;
						$bonus_amount = 2000;
					}
					$transaction->create_time = date("Y-m-d H:i:s");
					$transaction->save();
					$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
					
					$user->airtel_advantage_bonus = 'liked';
					//$user->total_credits = $user->total_credits + $bonus_amount;
					$user->closing_balance = $user->closing_balance + $bonus_amount;
					$alert = 1;
					$alert_text .= 'Hey, You have just grabbed your Airtel advantage of '. $bonus_amount .'. Good going!<br>';
					$user->save();
				}
			}
		$this->render('main',array('status'=>$status, 'uid'=>$fb_me['id'], 'pid'=>$id->id, 'alert'=>$alert, 'alert_text'=> $alert_text));
		 }
		else {
			// echo $status;
			$this->layout = "//layouts/main"; 
			$this->render('auth',array('status'=>$status));
		 }
	}
	
	public function actionTest() {
		$this -> render('test');
	}
	
	public function actionIndex11() {
		$this -> render('index11');
	}	
	
	public function actionAdd() {
		$this->render('add');
	}
	
	public function actionUpcomingEventsData() {
		//$upcoming_events = 'test';
		$criteria=new CDbCriteria;
		$criteria->select='id, event_type, title, start_time';
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>'upcoming');
		$criteria->order='start_time asc';
		$criteria->limit=3;
		$upcoming_events=Events::model()->findAll($criteria);
		$upcoming_data = array();
		$upcoming_data_array = array();
		foreach ($upcoming_events as $key => $value) {
			$upcoming_data['id'] = $value->id;
			$upcoming_data['event_type'] = $value->event_type;
			$upcoming_data['title'] = $value->title;
			$datetime = strtotime($value->start_time);
			$upcoming_data['start_time'] = date('d/m/y',$datetime);
			array_push($upcoming_data_array, $upcoming_data);
		}
		$upcoming_data_array_js = json_encode($upcoming_data_array);
		$data['upcoming_events_data'] = $upcoming_data_array_js;
		echo $upcoming_data_array_js;
		//$this->renderPartial('_ajaxContent', $data, false, true);
		//$this->render('index', $id_array_js);
	}
	
	public function actionCurrentEventsData() {
		$criteria=new CDbCriteria;
		$criteria->select='id, event_type, title, total_pot, start_time, end_time, total_bets';
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>'current');
		$criteria->order='total_pot desc';
		$criteria->limit=2;
		$current_events=Events::model()->findAll($criteria);
		$current_data = array();
		$current_data_array = array();
		foreach ($current_events as $key => $value) {
			$current_data['id'] = $value->id;
			$current_data['event_type'] = $value->event_type;
			$current_data['title'] = $value->title;
			$datetime = strtotime($value->start_time);
			$current_data['start_time'] = date('d/m/y',$datetime);			
			$datetime = strtotime($value->end_time);
			$current_data['end_time'] = date('d/m/y',$datetime);
			$current_data['total_bets'] = $value->total_bets;
			$current_data['total_pot'] = $value->total_pot;
			array_push($current_data_array, $current_data);
		}
		$current_data_array_js = json_encode($current_data_array);
		$data['current_events_data'] = $current_data_array_js;
		echo $current_data_array_js;
		//$this->renderPartial('_ajaxContent', $data, false, true);
	}

	public function actionLatestEvents() {
		$criteria=new CDbCriteria;
		$criteria->select='id, event_type, title, total_pot, start_time, end_time, total_bets';
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>'current');
		$criteria->order='total_pot desc';
		$current_events=Events::model()->findAll($criteria);
		$current_data = array();
		$current_data_array = array();
		foreach ($current_events as $key => $value) {
			$current_data['id'] = $value->id;
			$current_data['event_type'] = $value->event_type;
			$current_data['title'] = $value->title;
			$datetime = strtotime($value->start_time);
			$current_data['start_time'] = date('d/m/y',$datetime);			
			$datetime = strtotime($value->end_time);
			$current_data['end_time'] = date('d/m/y',$datetime);
			$current_data['total_bets'] = $value->total_bets;
			$current_data['total_pot'] = $value->total_pot;
			array_push($current_data_array, $current_data);
		}
		$current_data_array_js = json_encode($current_data_array);
		$data['current_events_data'] = $current_data_array_js;
		//echo $current_data_array_js;
		$this->render('latestEvents', array('response'=>$current_data_array_js));
	}
	
	public function actionClosedEventsData() {
		$criteria=new CDbCriteria;
		$criteria->select='id, event_type, title, total_bets, end_time';
		$criteria->order='end_time desc';
		$criteria->condition='status=:status';
		$criteria->params=array(':status'=>'closed');
		$criteria->limit=3;
		$closed_events=Events::model()->findAll($criteria);
		$closed_data = array();
		$closed_data_array = array();
		foreach ($closed_events as $key => $value) {
			$closed_data['id'] = $value->id;
			$closed_data['event_type'] = $value->event_type;
			$closed_data['title'] = $value->title;
			$closed_data['total_bets'] = $value->total_bets;		
			$datetime = strtotime($value->end_time);
			$closed_data['end_time'] = date('d/m/y',$datetime);
			array_push($closed_data_array, $closed_data);
		}
		$closed_data_array_js = json_encode($closed_data_array);
		$data['closed_events_data'] = $closed_data_array_js;
		echo $closed_data_array_js;
		//$this->renderPartial('_ajaxContent', $data, false, true);
	}
	
	public function actionGetTopBetData() {
		$criteria=new CDbCriteria;
		$criteria->order='start_time asc';
		$criteria->limit=1;
		$top_bet=Questions::model()->findAll($criteria);
		$top_bet_array = array();
		foreach ($top_bet as $key => $value) {
			$top_bet_array['id'][] = $value->id;
			$top_bet_array['title'][] = $value->title;
			$top_bet_array['status'][] = $value->status;
			$top_bet_array['total_pot'][] = $value->total_pot;
			$top_bet_array['total_bets'][] = $value->total_bets;
			$top_bet_array['start_time'][] = $value->start_time;
			$top_bet_array['end_time'][] = $value->end_time;
			$top_bet_array['event_id'][] = $value->event_id;
		}
		$top_bet_array_js = json_encode($top_bet_array);
		$data['top_bet_array'] = $top_bet_array_js;
		echo $top_bet_array_js;
		//$this->renderPartial('_ajaxContent', $data, false, true);
	}
	
	public function actionGetUserData() {
		$uid = $_GET['uid'];
		$criteria=new CDbCriteria;
		$criteria->select = 'id, first_name, middle_name, last_name, closing_balance, total_credits, total_debits'; 
		$criteria->condition='uid=:uid';
		$criteria->params=array(':uid'=>$uid);
		$user_data=UserInfo::model()->findAll($criteria);
		$user_data1 = array();
		$user_data_array = array();
		foreach ($user_data as $key => $value) {
			$user_data1['id'] = $value->id;
			$user_data1['first_name'] = $value->first_name;
			$user_data1['middle_name'] = $value->middle_name;
			$user_data1['last_name'] = $value->last_name;
			$user_data1['closing_balance'] = $value->closing_balance;
			$user_data1['total_credits'] = $value->total_credits;
			$user_data1['total_debits'] = $value->total_debits;
			array_push($user_data_array, $user_data1);
		}
		$user_data_array_js = json_encode($user_data_array);
		$data['user_data_array'] = $user_data_array_js;
		echo $user_data_array_js;
		//$this->renderPartial('_ajaxContent', $data, false, true);
	}

	public function actionGetUserRecentBets() {
		$user_id = $_GET['id'];
		$criteria=new CDbCriteria;
		$criteria->select = 'question_id, bet_amount';
		$criteria->order = 'create_time desc';
		$criteria->condition='user_id=:user_id';
		$criteria->params=array(':user_id'=>$user_id);
		$criteria->limit=3;
		$user_recent_bets=Bets::model()->findAll($criteria);
		$user_recent_bets_array = array();
		foreach ($user_recent_bets as $key => $value) {
			$question_id = $value->question_id;
			$criteria1=new CDbCriteria;
			$criteria1->select = 'title';
			$criteria1->condition='id=:question_id';
			$criteria1->params=array(':question_id'=>$question_id);
			$question_text=Questions::model()->find($criteria1);
			$user_recent_bets_array['question_id'][] = $value->question_id;
			$user_recent_bets_array['question_text'][] = $question_text->title;
			$user_recent_bets_array['bet_amount'][] = $value->bet_amount;
		}
		$user_recent_bets_array_js = json_encode($user_recent_bets_array);
		$data['user_recent_bets_array'] = $user_recent_bets_array_js;
		echo $user_recent_bets_array_js;
		//$this->renderPartial('_ajaxContent', $data, false, true);
	}

	public function actionGetTop4() {
		$criteria=new CDbCriteria;
		$criteria->select = 'uid, first_name, last_name, closing_balance';
		$criteria->order = 'closing_balance desc';
		$criteria->condition = 'block_status=:block_status';
		$criteria->params = array('block_status'=>'unblock');
		$criteria->limit=4;
		$top_4=UserInfo::model()->findAll($criteria);
		$top_4_users = array();
		$top_4_array = array();
		foreach ($top_4 as $key => $value) {
			$top_4_users['uid'] = $value->uid;
			$top_4_users['first_name'] = $value->first_name;
			$top_4_users['last_name'] = $value->last_name;
			$top_4_users['closing_balance'] = $value->closing_balance;
			array_push($top_4_array, $top_4_users);
		}
		$top_4_array_js = json_encode($top_4_array);
		echo $top_4_array_js;
	} 
	
	public function actionEventLeaderBoard() {
		$event_id = $_GET['event_id'];
		$command = "select user_id, sum(amount) as sum_amount from transaction where (transaction_type = 5 or transaction_type = 4) and user_id in (select id from user_info where block_status = 'unblock') and event_id =". $event_id ." group by user_id order by sum(amount) desc limit 3";
		$toppers = Yii::app()->db->createCommand($command)->queryAll();
		//print_r($toppers);
		$event_toppers_array = array();
		$count = 1;
		foreach ($toppers as $key => $value) {
			$toppers_array = array();
			$command1 = "select uid, first_name, last_name from user_info where id=".$value['user_id'];
			$toppers_array = Yii::app()->db->createCommand($command1)->queryAll();
			//print_r($toppers_array);
			$toppers_array1 = array();
			foreach ($toppers_array as $key => $value1) {
				//echo $value;
				$toppers_array1['uid'] = $value1['uid']; 
				$toppers_array1['last_name'] = $value1['last_name']; 
				$toppers_array1['first_name'] = $value1['first_name']; 
			}
			$toppers_array1['sum_amount'] = $value['sum_amount'];
			$toppers_array1['rank'] = $count;
			$count++;
			array_push($event_toppers_array, $toppers_array1);
		}
		//print_r($event_toppers_array);
		$event_toppers_array_js = json_encode($event_toppers_array);
		$this->render('event_leaderboard', array('event_toppers_array'=> $event_toppers_array_js, 'event_id'=>$event_id));
		
		/*
		$criteria=new CDbCriteria;
		$criteria->select = 'user_id, sum(amount)';
		$criteria->order = 'closing_balance desc';
		$criteria->limit=4;
		$criteria->condition = 'block_status=:block_status';
		$criteria->params = array('block_status'=>'unblock');
		$top_4=UserInfo::model()->findAll($criteria);
		$top_4_users = array();
		$top_4_array = array();
		foreach ($top_4 as $key => $value) {
			$top_4_users['uid'] = $value->uid;
			$top_4_users['first_name'] = $value->first_name;
			$top_4_users['last_name'] = $value->last_name;
			$top_4_users['closing_balance'] = $value->closing_balance;
			array_push($top_4_array, $top_4_users);
		}
		$top_4_array_js = json_encode($top_4_array);
		echo $top_4_array_js;*/
	} 
	public function actionGetLeaderBoardData() {
		$uid = $_GET['uid'];
		/*
		if($uid == '') {
			$this->render('main');	
		}*/
		$count = 1;
		$prev_count = 1;
		$prev = 0;
		$criteria=new CDbCriteria;
		$criteria->select = 'uid, first_name, last_name, closing_balance';
		$criteria->order = 'closing_balance desc';
		$criteria->limit=20;
		$criteria->condition = 'block_status=:block_status';
		$criteria->params = array('block_status'=>'unblock');
		$lb_data=UserInfo::model()->findAll($criteria);
		$lb_data_users = array();
		$lb_data_array = array();
		foreach ($lb_data as $key => $value) {
			if(($value->closing_balance < $prev) && ($count != 1)) {
				$prev_count = $count;
				$prev = $value->closing_balance;
			}
			if($count == 1) {
				$prev = $value->closing_balance;
			}
			$lb_data_users['rank'] = $prev_count;
			$lb_data_users['uid'] = $value->uid;
			$lb_data_users['first_name'] = $value->first_name;
			$lb_data_users['last_name'] = $value->last_name;
			$lb_data_users['closing_balance'] = $value->closing_balance;
			$count++;
			array_push($lb_data_array, $lb_data_users);
		}
		$command = "SELECT count(*) from user_info where closing_balance > (select closing_balance from user_info where uid =". $uid . ")" ;
		$myrank = intval(Yii::app()->db->createCommand($command)->queryScalar()) + 1;
		$criteria1=new CDbCriteria;
		$criteria1->select = 'first_name, last_name, closing_balance, block_status';
		$criteria1->order = 'closing_balance desc';
		$criteria1->condition = 'uid=:uid';
		$criteria1->params = array(':uid'=>$uid);
		$mydata=UserInfo::model()->find($criteria1);
		//print_r($mydata);
		if($mydata->block_status == 'block') {
			$lb_data_users1['myrank'] = 'Blocked';
		}
		else {
			$lb_data_users1['myrank'] = $myrank;
		}
		$lb_data_users1['myuid'] = $uid;
		$lb_data_users1['myfirst_name'] = $mydata->first_name;
		$lb_data_users1['mylast_name'] = $mydata->last_name;
		$lb_data_users1['myclosing_balance'] = $mydata->closing_balance;
		array_push($lb_data_array, $lb_data_users1);
		$lb_data_array_js = json_encode($lb_data_array);
		$this->render('leaderboard', array('response'=> $lb_data_array_js, 'uid'=> $uid));
	} 

	protected function getUid(){
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		if ($status == 'TRUE')
		{
			$fb_me = $authentic->getMe();	
			$criteria=new CDbCriteria;
			$criteria->condition='uid=:uid';
			$criteria->params=array(':uid'=>$fb_me['id']);
			$id=UserInfo::model()->find($criteria);
			return $id->id;
		} else 
			return FALSE;
	} 
	
	public function actionMyBets(){
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		if ($status == 'TRUE')
		{
			$fb_me = $authentic->getMe();	
			$criteria=new CDbCriteria;
			$criteria->condition='uid=:uid';
			$criteria->params=array(':uid'=>$fb_me['id']);
			$id=UserInfo::model()->find($criteria);
			$user_id = $id->id;
						
			$criteria=new CDbCriteria;
			$criteria->select = 'transaction_type , amount, option_id, question_id, create_time';
			$criteria->condition='user_id=:user_id';
			$criteria->params=array(':user_id'=>$user_id);
			$criteria->order = 'create_time desc';
			$user_transaction=Transaction::model()->findAll($criteria);
			$user_transaction_array = array();
			$user_transaction_array_array = array();
			foreach ($user_transaction as $key => $value) {
				$user_transaction_array['amount'] = $value->amount;
				$user_transaction_array['question_id'] = $value->question_id;
				$user_transaction_array['option_id'] = $value->option_id;
				$user_transaction_array['create_time'] = $value->create_time;
				$criteria1=new CDbCriteria;
				$criteria1->select = 'transaction_description, bet_based, transaction_nature';
				$criteria1->condition='id=:id';
				$criteria1->params=array(':id'=>$value->transaction_type);
				$transaction_type=TransactionTypes::model()->find($criteria1);
				$user_transaction_array['transaction_description'] = $transaction_type->transaction_description;
				if($transaction_type->bet_based == 'no' || $value->question_id === NULL) {
					$user_transaction_array['transaction_question'] = '';
					$user_transaction_array['transaction_option'] = '';
				} else {
					$question = Questions::model()->findByPk($value->question_id);
					$option = Options::model()->findByPk($value->option_id);
					$user_transaction_array['transaction_question'] = $question->title;
					$user_transaction_array['transaction_option'] = $option->option_text;
				}
				if($transaction_type->transaction_nature == 'credit' || $value->question_id === NULL) {
					$user_transaction_array['sign'] = '+';
				} else {
					$user_transaction_array['sign'] = '-';
				}
				array_push($user_transaction_array_array, $user_transaction_array);		
			}
			//print_r($user_transaction_array_array);
			$this->render('myBets', array('user_bets'=>$user_transaction_array_array));	
		} else {
			$this->redirect(array('/application/main'));				
		}			
	}
	
	

	public function actionUpdateInviteData() {
		$friends_array = $_GET['invited_friends'];
		$pid = $_GET['pid'];
		foreach ($friends_array as $key => $value) {
			$criteria_invite = new CDbCriteria;
			$criteria_invite->condition = 'fid=:fid';
			$criteria_invite->params = array(':fid'=>$value);
			$invite = InviteData::model()->findAll($criteria_invite);
			$invite_count = count($invite);
			//$user_model = new UserInfo;
			if($invite_count == 0) {
				$invite_friend = new InviteData;
				$invite_friend->uid = $pid;
				$invite_friend->fid = $value;
				$invite_friend->create_time = date("Y-m-d H:i:s");
				$invite_friend->save();
				//print_r($invite_friend->getErrors());
			}
		}
	}

	public function actionGiveAirtelAdvantageBonus() {
		//echo 'in';
		$resp = 0;
		$authentic = new Authentication();
        $status = $authentic->authenticate();
		$facebook = $authentic->getFbRef();
		$access_token = $facebook->getAccessToken();
		if ($status == 'TRUE') {
			$likes = $authentic->getFbPageLikes(147351511955143);
			$fb_me = $authentic->getMe();			
			$me = $fb_me['id'];
			$criteria = new CDbCriteria;
			$criteria->condition = 'uid=:uid';
			$criteria->params = array(':uid'=>$fb_me['id']);
			$user = UserInfo::model()->find($criteria);
			$bonus_status = $user->airtel_advantage_bonus;
			if($bonus_status != 'liked') {
					//$result = $facebook->api('/me/likes/136159143138850');
					$length = count($likes);
					//echo $length;
					if($length != 1) {
					$bonus_amount = 0;
					$criteria2=new CDbCriteria;
					$criteria2->select='bonus_money';
					$criteria2->condition='id=:id';
					$criteria2->params=array(':id'=>8);
					$bonus=TransactionTypes::model()->find($criteria2);
					$transaction = new Transaction;
					$transaction->user_id = $user->id;
					$transaction->transaction_type = 8;
					if(isset($bonus->bonus_money)) {
						$transaction->amount = $bonus->bonus_money;
						$bonus_amount = $transaction->amount;
					}
					else {
						$transaction->amount = 2000;
						$bonus_amount = 2000;
					}
					$transaction->create_time = date("Y-m-d H:i:s");
					$transaction->save();
					$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
					
					$user->airtel_advantage_bonus = 'liked';
					//$user->total_credits = $user->total_credits + $bonus_amount;
					$user->closing_balance = $user->closing_balance + $bonus_amount;
					$user->save();
					$resp = 1;
				}
			}
		} else {
		}
		echo $resp;
	}

	protected function saveBankReconInfo($user_id, $bid_amount, $trans_create_time, $trans_type){
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
	
	public function actionTnc() {
		$this->render('tnc');
	}
	
	public function actionGetTinfo(){
		$order_id = $_GET['order_id'];
		$criteria = new CDbCriteria;
		$criteria->condition = "order_id = :order_id";
		$criteria->params = array(':order_id'=>$order_id);
		if (count(RoadiesMerchandiseBonus::model()->findAll($criteria)) == 0) {
			$user_id = $_GET['pid'];		
			$post_url = "http://www.theroadiesstore.in/api/mtv_order_details.php?key=akl863okn1&order_id=" . $order_id;
			$responseJSON = '';
			$responseJSON = $responseJSON.file_get_contents( $post_url );
			$response = json_decode($responseJSON);
			if (!isset($response->Error)){			
				$rec = new RoadiesMerchandiseBonus;
				$rec->order_id = $order_id;
				$rec->first_name = $response->{'Customer Firstname'};
				$rec->last_name = $response->{'Customer Lastname'};
				$rec->email = $response->{'Customer Email'};
				$rec->count = $response->Count;
				$rec->purchase_date = date("Y-m-d", strtotime($response->{'Transaction Date'}));
				$rec->trans_type = 10;
				$rec->create_time = date("Y-m-d H:i:s");
				$rec->save();
				
				/* Proceed with User Transaction */
				$criteria1=new CDbCriteria;
				$criteria1->select='bonus_money';
				$criteria1->condition='id=:id';
				$criteria1->params=array(':id'=>10);
				// There should be a trnsaction type entry for first time entry in application bonus.
				$bonus=TransactionTypes::model()->find($criteria1);
				$transaction = new Transaction;
				$transaction->user_id = $user_id;
				$transaction->transaction_type = 10;
				if(isset($bonus->bonus_money)) {
					$transaction->amount = $bonus->bonus_money;
				}
				else {
					$transaction->amount = 2000;
				}
				$transaction->create_time = date("Y-m-d H:i:s");
				$transaction->save();				
				$this->saveBankReconInfo($transaction->user_id, $transaction->amount, $transaction->create_time, $transaction->transaction_type);
				
				/* Update User Information */
				$user = UserInfo::model()->findByPk($user_id);
				$user->closing_balance = $user->closing_balance + $transaction->amount;
				$user->save();
				echo $transaction->amount;
			} else {
				echo "ERROR: Please Enter Valid Id";
			}
		} else {
			echo "ERROR: Order id is already used";
		}		
	}

	public function actionSaveReferal() {
		$uid = $_GET['uid'];
		$ref_code = $_GET['ref_code'];
		$MerchandiseReferal = new MerchandiseReferal;
		$MerchandiseReferal->uid = $uid;
		$MerchandiseReferal->ref_code = $ref_code;
		$MerchandiseReferal->create_time = date("Y-m-d H:i:s");
		$MerchandiseReferal->save();
	}
	
	public function actionDistributeReferal() {
		$ref_code = $_GET['ref_code'];
		$criteria = new CDbCriteria;
		//$criteria->select = 'uid';
		$criteria->condition = 'ref_code=:ref_code';
		$criteria->params = array(':ref_code'=>$ref_code);
		$ref_entry = MerchandiseReferal::model()->find($criteria);
		$response = array();
		//print_r($ref_entry->uid);
		if($ref_entry->status == 'pending') {
			$ref_uid = $ref_entry->uid;
		
			$criteria1 = new CDbCriteria;
			$criteria1->condition = 'uid=:uid';
			$criteria1->params = array(':uid'=>$ref_uid);
			$ref_user = UserInfo::model()->find($criteria1);
			$ref_id = $ref_user->id;
			//echo $ref_id;
			/* Proceed with User Transaction */
			
			$criteria2=new CDbCriteria;
			$criteria2->select='bonus_money';
			$criteria2->condition='id=:id';
			$criteria2->params=array(':id'=>11);
			// There should be a trnsaction type entry for first time entry in application bonus.
			$bonus=TransactionTypes::model()->find($criteria2);
			$transaction = new Transaction;
			$transaction->user_id = $ref_id;
			$transaction->transaction_type = 11;
			if(isset($bonus->bonus_money)) {
				$transaction->amount = $bonus->bonus_money;
			}
			else {
				$transaction->amount = 2000;
			}
			$transaction->create_time = date("Y-m-d H:i:s");
			$transaction->save();	
			
			$ref_user->closing_balance = $ref_user->closing_balance + $transaction->amount;
			$ref_user->save();
			$ref_entry->status = 'given';
			$ref_entry->save();
			$response['status'] = 'success';
			$response['info'] = 'Merchandise Referral Bonus got distributed.';
		}
		else {
			$response['status'] = 'failure';
			$response['info'] = 'Referal Code is invalid.';
		}
		echo json_encode($response);
	}
}
