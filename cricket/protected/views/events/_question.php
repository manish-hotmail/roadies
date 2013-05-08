<style>
	.question_info span{
		font-weight: bold;
		font-size: 1.1em;
	}
</style>
<?php
	echo '<div style="border: 1px solid #bbb; box-shadow: 2px 2px 8px #888; margin:20px 0px; padding: 20px;">';
		echo '<div class="question_info" style="border-bottom: 1px solid #bbb; padding-bottom: 10px;">';
			echo "<p><span>Title: </span>".$question['title'].'</p>';
			echo "<p><span>Status:  </span>".$question['status'].'</p>';
			echo "<p><span>Maximum Bid Amount:  </span>".$question['maximum_bid_amount'].'</p>';
			echo "<p><span>Start Time:  </span>".$question['start_time'].'</p>';
			echo "<p><span>End Time:  </span>".$question['end_time'].'</p>';
			echo "<p><span>Correct Option:  </span>";
			if ($question['correct_option'] != ""){
				echo $question['correct_option'].'</p>';
			} else {
				echo 'Not Mentioned. </p>';
			}
		echo '</div>';
		echo '<div style="margin-top: 10px;">';
			echo '<button class="btn" onclick="gotoQuestion('.$question['id'].')"> Update/Edit </button>';
		echo '</div>';		
	echo '</div>';
?>