<style>
	.question_info span{
		font-weight: bold;
		font-size: 1.1em;
	}
</style>
<?php
	echo '<div style="border: 1px solid #bbb; box-shadow: 2px 2px 8px #888; margin:20px 0px; padding: 20px;">';
		echo '<div class="question_info" style="border-bottom: 1px solid #bbb; padding-bottom: 10px;">';
			echo "<p><span>Title: </span>".$option['option_text'].'</p>';
		echo '</div>';
		echo '<div style="margin-top: 10px;">';
			echo '<button class="btn" onclick="gotoOption('.$option['id'].')"> Update/Edit </button>';
		echo '</div>';		
	echo '</div>';
?>