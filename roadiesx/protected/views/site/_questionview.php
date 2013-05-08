<?php 
	if($status == "current"){
		echo "<h4 class='question_bg'>".$question_text."<span class='bet_alive_info'>Prediction Open</span></h4>";
	} else {
		echo "<h4 class='question_bg'>".$question_text."<span class='bet_alive_info'>Prediction Closed</span></h4>";
	}
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
		$apH .= "<tr>";
			$apH .= "<td><span id=option_text_".$value['id'].">".$value['option_text']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=total_bets_".$value['id'].">".$value['total_pot']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=odd_".$value['id'].">".$value['odd']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=your_bet_".$value['id'].">".$value['your_bet']."</span></td>";
			$apH .= "<td style='text-align: center;'><span id=payout_".$value['id'].">".round($value['your_bet'] * $value['odd'])."</span></td>";
			if($status == "current"){
				$apH .= "<td style='text-align: center;'>";
				$apH .= "<button class='btn-danger' onclick='populateBet(".$count.",".$value['id'].",".$question_id.",\"".CHtml::encode($question_text)."\",\"".CHtml::encode($value['option_text'])."\",".$question_max_bid_amount.")'>PREDICT</button>";
				$apH .= "</td>";
			} else {
				$apH .= "<td class='won_info'></td>";
			}
		$apH .= "</tr>";	
		//$apAllRows = $apR;
	}
	
	//echo $apAllRows;
	$apH .= "</table>";
	echo $apH;
	if($status == "current"){
		echo "<h5 class='question_end_info'>Predictions open till ".date("jS F, g:i a",$end_date) .'</h5>';
	} else {
		echo "<h5 class='question_end_info'>Predictions closed on ".date("jS F, g:i a",$end_date) .'</h5>';
	}
?>

<script>
	
</script>