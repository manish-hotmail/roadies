<style>
	span {
		margin: 3px;
	}
</style>
<script>
	function gotoEvent(event_id) {
		window.location = "<?php echo $this->createUrl('/site/getEventData'); ?>?id=" + event_id;
	}
</script>
<p class="main_page_headers"><span>RESULTS</span></p>
<?php		
	$apH = "<table class='td_bg' id='completed_td'>";
		$apH .= "<tr class='tr_bg'>";
			$apH .= "<td style='width: 35%; text-align: center;'></td>";
			$apH .= "<td style='text-align: center;'><h5>Date Closed</h5></td>";
			$apH .= "<td style='text-align: center;'><h5>Total Pot</h5></td>";
			$apH .= "<td style='text-align: center;'><h5>Your Investment</h5></td>";
			$apH .= "<td style='text-align: center;'><h5>Winnings</h5></td>";
			$apH .= "<td></td>";
		$apH .= "</tr>";
		//echo $apH;
		//$apAllRows = '';
		foreach ($completed_events_array as $key => $event) {
			$apH .= "<tr>";
				$apH .= "<td style='padding: 18px;'><span>".$event['title']."</span></td>";
				$apH .= "<td style='padding: 18px;'><span>".date('d/m/y',strtotime($event['end_time']))."</span></td>";
				$apH .= "<td><span style='float: right; margin-top: 16px;' >".$event['total_pot']."</span></td>";
				$apH .= "<td><span style='float: right; margin-top: 16px;'>". $event['investment'] ."</span></td>";
				$apH .= "<td><span style='float: right; margin-top: 16px;'>". $event['winnings'] ."</span></td>";
				$apH .= "<td style='padding: 12px;'><span>"."<button class='view_event_btn' onclick='gotoEvent(".$event['id'].")'>View Event</button>"."</span></td>";
			$apH .= "</tr>";	
		}
	
	//echo $apAllRows;
	$apH .= "</table>";
	echo $apH;
?>

<?php
	$this->pageTitle=Yii::app()->name . ' | RESULTS';
	$this->breadcrumbs=array(
		'RESULTS',
	);
?>