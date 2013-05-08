<?php	
	$event_name = '';
	foreach ($EventModel as $key => $value) {
		$event_id = $value->id;
		$event_name = $value->title;
		$event_info = "<table>";
			$event_info .= "<tr>";
				$event_info .= "<td style='width: 70%;'><h4 class='home_headers'><span class='header_text'>EVENT :</span><span>$value->title</span></h4></td>";
				$event_info .= "<td style='width: 5%;'></td>";
				$event_info .= "<td style='width: 25%;'><h4 class='total_pot'>TOTAL POT <br><span>C$ </span><span id='event_total_pot'>$value->total_pot</span></h4></td>";
			$event_info .= "</tr>";
			$event_info .= "<tr><td colspan='3' ><h6><span>$value->description</span></h6></td></tr>";
		$event_info .= "</table>";
	}	
	echo $event_info;
	foreach ($question_array as $key => $value) {
		$this->renderPartial('_questionview',array(
			'status'=>$value['status'],
			'question_id'=>$value['id'],
			'question_text'=>$value['title'], 
			'options'=>$value['options'], 
			'end_date'=>$value['end_time'], 
			'question_max_bid_amount' => $value['maximum_bid_amount'],
		));
	}
?>

<?php
	$this->pageTitle=Yii::app()->name . ' | RESULTS | '. $event_name;
	$this->breadcrumbs=array(
		'OPEN PREDICTIONS'=>array('/application/latestEvents'),
		$event_name	
	);
?>
<div id="bet_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h4 id="popup_question"></h4>	    
	    <p>You predicted for</p>
		<h5 id="popup_selected_option"></h5> 
	  </div>
	  <div class="modal-body">	   
		<p><span style="color: #6c5600; font-size: 14px;">Enter Prediction amount: </span></p>
		<p style="margin: 0px; font-size: 20px; font-weight: 700;">C$ <input id="bid_amount" type="text" /></p>	    
		<div id="balance_meta_data">
	    	<p>Available Balance: C$ <span id="userAmount"></span></p>
	    	<p id="max_allowed_meta_data">(Maximum allowed C$ <span id="userQuestionPotAvailableAmount"></span>)</p>
	    </div>
	    <button id="bet_close_btn" class="btn-danger" onclick="saveBet()" aria-hidden="true" style="display: '';">Submit</button>
	    <a style="color: #00316e; font-size: 13px; font-weight: 700;" href="javascript:closeBet()">Cancel</a>
	  </div>	  
	  <div id="bet_model_footer" class="modal-footer">
	    <p style="color: red;" id="error_msg"></p>
	  </div>	
</div>

<div id="popup_error" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <p>ERROR!</p>	    
	  </div>
	  <div class="modal-body">	    
		<p id="modal_body"></p>
	  </div>
	  <div class="modal-footer">
	    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	  </div>	 
</div>

<script>
	$('#bet_popup').modal({
	  	show: false
	});
	$('#popup_error').modal({
	  	show: false
	});
	var question_id_global = '';
	var option_id_global = '';
	var question_text_global = '';
	var option_text_global = '';
	var bet_amount_global = '';
	var user_name_global = '';
	var event_id_global = '<?php echo $event_id;?>';
	var user_id ='<?php echo $user_id; ?>';
	var question_max_bid_amount = 1000;
	var uP = '';
	var qP = '';
	function populateBet(id, question_id, question, option, max_bid_amount){
		//alert(id);
		question_id_global = question_id;
		question_max_bid_amount = max_bid_amount;
		option_id_global = id;
		question_text_global = question;
		option_text_global = option;
		document.getElementById('popup_question').innerHTML = question;
		document.getElementById('popup_selected_option').innerHTML = option;
		document.getElementById('bet_model_footer').style.display = "none";
		document.getElementById('bid_amount').value = '';
		document.getElementById('error_msg').innerHTML = '';
		document.getElementById('bet_close_btn').style.display ="";
		getUserData();
		/* Show popup once data is available */
	}
	
	function closeBet(){		
		document.getElementById('bid_amount').value = '';
		document.getElementById('error_msg').innerHTML = '';
		document.getElementById('bet_close_btn').style.display ="";
		$('#bet_popup').modal('hide');
	}
	
	function saveBet(){		
		bid_amount_temp = document.getElementById('bid_amount').value;
		var bid_amount = parseInt(bid_amount_temp);
		if (bid_amount <= 0 || isNaN(bid_amount)){
			document.getElementById('error_msg').innerHTML = "Please Enter Valid Prediction Amount";
			document.getElementById('bet_model_footer').style.display = "block";
		}			
		else if (uP < bid_amount){
			document.getElementById('error_msg').innerHTML = "You do not have enough Balance. Your C$ Balance is: "+uP;
			document.getElementById('bet_model_footer').style.display = "block";
		}			
		else if (qP < question_max_bid_amount) {
			if (bid_amount > question_max_bid_amount) {
				document.getElementById('error_msg').innerHTML = "Maximum Prediction amount is "+question_max_bid_amount+" for this question.";
				document.getElementById('bet_model_footer').style.display = "block";
			} else if ((bid_amount + qP) > question_max_bid_amount){
				//alert(bid_amount + qP);
				document.getElementById('error_msg').innerHTML = "Maximum Prediction amount is "+question_max_bid_amount+" for this question. You have already bid: "+qP;
				document.getElementById('bet_model_footer').style.display = "block";
			} else {
				document.getElementById('bet_close_btn').style.display ="none";
				document.getElementById('bet_model_footer').style.display = "none";
				document.getElementById('error_msg').innerHTML = '';
				$.ajax({
					url: '<?php echo $this->createUrl("/site/saveBid"); ?>',
					data: {question_id: question_id_global, option_id: option_id_global, bid: bid_amount, question_max_bid_amount: question_max_bid_amount},
					success: function(result) {
						//alert(result);
						if(result.substr(0,5) == 'ERROR'){
							document.getElementById('modal_body').innerHTML = result;
						} else {
							/* Update User Bet Information*/
							var user_bet_existing_value = parseInt(document.getElementById('your_bet_'+option_id_global).innerHTML);
							var option_odd = parseFloat(document.getElementById('odd_'+option_id_global).innerHTML);
							var curr_total_bets_value = parseInt(document.getElementById('total_bets_'+option_id_global).innerHTML);
							if (user_bet_existing_value == 0){								
								//document.getElementById('event_total_bets').innerHTML = parseInt(document.getElementById('event_total_bets').innerHTML)+1;								
							}
							document.getElementById('total_bets_'+option_id_global).innerHTML = parseInt(document.getElementById('total_bets_'+option_id_global).innerHTML)+bid_amount;
							document.getElementById('event_total_pot').innerHTML = parseInt(document.getElementById('event_total_pot').innerHTML)+bid_amount;							
							user_bet_existing_value = user_bet_existing_value + bid_amount;
							document.getElementById('your_bet_'+option_id_global).innerHTML = user_bet_existing_value;
							document.getElementById('payout_'+option_id_global).innerHTML = Math.round(user_bet_existing_value * option_odd);
							
							/* Success Info */
							document.getElementById('error_msg').innerHTML = "Your Prediction is Saved";
							document.getElementById('bet_model_footer').style.display = "block";
							
							/* Update User Profile Information*/
							document.getElementById('user_invested_amount').innerHTML = parseInt(document.getElementById('user_invested_amount').innerHTML) + bid_amount;
							document.getElementById('user_available_cash').innerHTML = parseInt(document.getElementById('user_available_cash').innerHTML) - bid_amount;
							
							d = $.parseJSON(result);
							keys = get_hash_keys(d);
							for (i=0; i<keys.length; i++){
								if (keys[i] == "question_pot_user"){
									qP = parseInt(d[keys[i]]);					
								} else {
									uP = parseInt(d[keys[i]]);
								}
							}
							$('#bet_popup').modal('hide');
							shareWithFriends(bid_amount);
						}
						document.getElementById('bet_close_btn').style.display ="";			
			    }});   
			}
		} else {
			document.getElementById('error_msg').innerHTML = "Maximum bid amount for this question is "+question_max_bid_amount+". You have already bid: "+qP;
		}
		//alert("user pot:"+uP+" - question pot user: "+qP);
	}
	
	function get_hash_keys(hsh) {
	    var keys = [];
	    for(var i in hsh) { if (hsh.hasOwnProperty(i)) keys.push(i); }
	    return keys;
	}
	
	function getUserData(){
		//$('#popup_error').modal('show');	
		$.ajax({
			url: '<?php echo $this->createUrl("/site/getUserData"); ?>',
			data: {question_id: question_id_global, user_id: user_id},
			success: function(result) {
				if(result == "error_1"){
					document.getElementById('modal_body').innerHTML = "Sorry We Lost You!";
					//$('#popup_error').modal('show');	
				} else {
					d = $.parseJSON(result);
					//alert(result);
					keys = get_hash_keys(d);
					for (i=0; i<keys.length; i++){
						if (keys[i] == "question_pot_user"){
							qP = parseInt(d[keys[i]]);					
							document.getElementById('userQuestionPotAvailableAmount').innerHTML = (question_max_bid_amount - qP);
						} else {
							uP = parseInt(d[keys[i]]);
							document.getElementById('userAmount').innerHTML = uP;
						}
					}		
					//alert('hi');			
					$('#bet_popup').modal('show');
					//alert('hi');
				}			
	    }});      
	}
	
	var inter = setInterval(function() {
		$.ajax({
			url: '<?php echo $this->createUrl("/site/updateMetaData"); ?>',
			data: {id: event_id_global, user_id: user_id},
			success: function(response) {
				//alert(response.event_total_votes);
				 //for (i=0; i< response.questionInfo.length; i++){
				 	d = $.parseJSON(response);
				 	keys = get_hash_keys(d);
				 	for (i=0; i<keys.length; i++){
				 		if (keys[i] == 'eventTotalBets')
				 		{
				 			//document.getElementById('event_total_bets').innerHTML = d[keys[i]];
				 		}				 			
				 		else if (keys[i] == 'eventTotalPot')
				 		{
				 			document.getElementById('event_total_pot').innerHTML = d[keys[i]];
				 		}
				 		else {
				 			$.each(d[keys[i]], function(index, element) {		
							 	//alert(index);
							 	keys_local = get_hash_keys(element);
							 	for (j=0; j<keys_local.length; j++){
									if (keys_local[j] == "id"){
										//alert(parseInt(element[keys_local[j]]));
									} else if (keys_local[j] == "options"){
										$.each(element[keys_local[j]], function(index_option, element_option) {	
											keys_option = get_hash_keys(element_option);
											var option_key = 0;
											var odd = 1;
											var your_bet = 0;
							 				for (k=0; k<keys_option.length; k++){
							 					//alert("'odd_"+option_key+"'");
							 					if (keys_option[k] == "id"){
													option_key = element_option[keys_option[k]];
												} else if (keys_option[k] == "totalPot"){
													if (parseInt(document.getElementById("total_bets_"+option_key).innerHTML) < parseInt(element_option[keys_option[k]])){
														document.getElementById("total_bets_"+option_key).innerHTML = element_option[keys_option[k]];
													}
												} else if (keys_option[k] == "odd"){													
													odd = element_option[keys_option[k]];
													document.getElementById("odd_"+option_key).innerHTML = element_option[keys_option[k]];
												} else if (keys_option[k] == "yourBet"){
													your_bet = element_option[keys_option[k]];
													document.getElementById("your_bet_"+option_key).innerHTML = element_option[keys_option[k]];
												}
												document.getElementById("payout_"+option_key).innerHTML = Math.round(odd * your_bet);
											}											
										});
									}
								}	
						    });
				 		}
				 	}				 
				//alert(JSON.stringify(response));
			}
		})},30000);
		
		function shareWithFriends(bid_amount) {
		var msg = '';
	    var nm = '<?php echo $user_name ?>' + ' just placed C$ ' + bid_amount + ' on '+ option_text_global + '.';  
	    var ln = 'predictions.mtv.in.com/cricket';
	    var cap =  'Join the MTV Cricket Prediction Game and win lots of prizes!';
	    var desc = question_text_global;
	    var pic = 'ec2-46-137-227-113.ap-southeast-1.compute.amazonaws.com/cricket/images/logo.jpg';
		//alert(msg+" "+nm+" "+ln+" "+desc+" "+cap+" "+pic);
		// calling the API ...
		var obj = {
		 method: 'feed',
		 message: msg,
		 link: ln,
		 picture: pic,
		 name: nm,
		 caption: cap,
		 description: desc
		};
		function callback(response) {
		//document.getElementById('player').style.display = 'block';
		   }
		   //document.getElementById('player').style.display = 'none';
		   FB.ui(obj, callback);
		}
</script>