<?php 
//if($status == "current"){
	$valid_answer = false;
	echo "<h4 class='question_bg'>".$question_text."<span class='bet_alive_info'>Prediction Closed</span></h4>";
	$apH = "<table class='td_bg'>";
	$apH .= "<tr class='tr_bg'>";
		$apH .= "<td style='width: 40%; text-align: center;'></td>";
		$apH .= "<td style='text-align: center;'><h5>Total Predictions</h5></td>";
		$apH .= "<td style='text-align: center;'><h5>Odds</h5></td>";
		$apH .= "<td style='text-align: center;'><h5>Your Prediction</h5></td>";
		$apH .= "<td style='text-align: center;'><h5>Payout</h5></td>";
		$apH .= "<td></td>";
	$apH .= "</tr>";
	//echo $apH;
	//$apAllRows = '';
	foreach ($options as $key => $value) {
		if ($correct_option == $value['id']){
			$apH .= "<tr class='correct_answer'>";
		} else {
			$apH .= "<tr>";
		}
			$apH .= "<td><span id=option_text_".$value['id'].">".$value['option_text']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=total_bets_".$value['id'].">".$value['total_pot']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=odd_".$value['id'].">".$value['odd']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=your_bet_".$value['id'].">".$value['your_bet']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=payout_".$value['id'].">".round($value['your_bet'] * $value['odd'])."</span></td>";
			if ($correct_option == $value['id']){
				$apH .= "<td class='won_info'>WON</td>";
				$valid_answer = true;
			} else {
				$apH .= "<td class='won_info'></td>";
			}				
		$apH .= "</tr>";	
		//$apAllRows = $apR;
	}
	
	//echo $apAllRows;
	$apH .= "</table>";
	echo $apH;
	if ($valid_answer){
		if($pot_distributed == "yes"){
			$disp_text = "<h6 style='text-align: center;'>Congratulations to all the winners!</h6><h5 class='question_end_info' style='text-align: center;'>Roadies Dollars has been credited based on your prediction</h5>";
		} else {
			$disp_text = "<h6 style='text-align: center;'>Congratulations to all the winners!</h6><h5 class='question_end_info' style='text-align: center;'>Roadies Dollars will be credited within 24 hours</h5>";
		}				
	} else {
		if ($correct_option == "cancelled")
			$disp_text = "<h5 class='question_end_info'>Your Bet Amount will be refunded with in 24 hours, since none of the answer is correct</h5>";
		else {
			$disp_text = "<h5 class='question_end_info'>Winners will be announced Soon.</h5>";
		} 
	}
	echo $disp_text;
//}

?>