<?php
	echo "<h4 class='main_page_headers'><span>My Transactions : </spn></h4>";
	$apH = "<table class='td_bg' id='my_trns_td'>";
	$apH .= "<tr class='tr_bg'>";
		$apH .= "<td style='width: 20%; text-align: center;'><h5>Time</h5></td>";
		$apH .= "<td style='width: 50%; text-align: center;'><h5>Event</h5></td>";
		$apH .= "<td style='width: 15%; text-align: center;'><h5>Invested</h5></td>";
		$apH .= "<td style='width: 15%; text-align: center;'><h5>Bonus</h5></td>";
	$apH .= "</tr>";
	foreach ($user_bets as $key => $value) {			
		$apH .= "<tr>";
			$apH .= "<td style='text-align: center;'>".date("jS F, g:i a",strtotime($value['create_time']))."</span></td>";	
			if ($value['transaction_question']){
				$apH .= "<td>".$value['transaction_description']." - ".$value['transaction_question']." on option ".$value['transaction_option']."</td>";	
			} else {
				$apH .= "<td>".$value['transaction_description']."</td>";
			}		
			if ($value['sign'] == "+"){
				$apH .= "<td style='text-align: center;'></td>";
				$apH .= "<td style='text-align: center;'>".$value['amount']."</td>";
			} else {				
				$apH .= "<td style='text-align: center;'>".$value['amount']."</td>";
				$apH .= "<td style='text-align: center;'></td>";
			}		
		$apH .= "</tr>";	
	}
	$apH .= "</table>";
	echo $apH;
?>