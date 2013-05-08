<?php
	
	class MoneyInfuseForm extends CFormModel
	{
        public $event;
        public $question;
        public $option;
        public $amount;

        /**
         * Declares the validation rules.
         */
        public function rules()
        {
                return array(
                        array('event, question, option, amount', 'required'),
                        array('amount','numerical',
                        'integerOnly'=>true,
                        'min'=>1,
                        'tooSmall'=>'Amount can not be less than one!!'
						),
                );
        }

        /**
         * Declares customized attribute labels.
         * If not declared here, an attribute would have a label that is
         * the same as its name with the first letter in upper case.
         */
        public function attributeLabels()
        {
                return array(
                'event'=>'Event',
                'question' => 'Question',
                'option' => 'Option',
                'amount' => 'Bid Amount',
                );
        }
		/*
        public function save() {
        	$event = $_POST['event'];
			$this->render('site/display', array('event'=>$event));
        }*/
        
        public function save($t, $arr) {
        	//print_r($arr);
        	$trans = new Transaction;
			$trans->user_id = -99;
			$trans->transaction_type = 9;
			$trans->amount = $arr['amount'];
			$trans->event_id = $arr['event'];
			$trans->question_id = $arr['question'];
			$trans->option_id = $arr['option'];
			$trans->create_time = date("Y-m-d H:i:s");
			$trans->save();
			//print_r($trans->getErrors());
			$bet = new Bets;
			$bet->user_id = -99;
			$bet->option_id = $arr['option'];
			$bet->question_id = $arr['question'];
			$bet->event_id = $arr['event'];
			$bet->bet_amount = $arr['amount'];
			$bet->create_time = date("Y-m-d H:i:s");
			$bet->save(); 
			$bank = new BankReconciliation;
			$bank->end_user_id = -99;
			$bank->transaction_type = 9;
			$bank->transaction = 'credit';
			$bank->recon_status = 'unchecked';
			$bank->trans_amount = $arr['amount'];
			$bank->bank_balance = $arr['amount'];
			$bank->trans_create_time = $trans->create_time;
			$bank->create_time = date("Y-m-d H:i:s");			
			$bank->save(); 
			return TRUE;
			//echo 'Record Saved!!';
			//print_r($bet->getErrors());
        }
}

?>