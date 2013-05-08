<p class="main_page_headers"><span>EVENT <?php echo $event_id; ?> LEADERBOARD</span></p>
<div style=" margin-bottom: 20px; " >
	<div id="extra_div_lb" style="width: 70%; float: left;">
	</div>
	
</div>
<style>
	#lb_table tbody > tr:last-of-type{
		background-color: red; 
	}
	
	td {
		vertical-align: middle;
	}
	
	.user_img {
		margin-left: 10px;
		height: 40px;
	}
	
	.user_name {
		margin-left: 10px;
	}
</style>
<script>
	function gotoProfile(uid) {
		window.open('https://www.facebook.com/'+uid);
	}
	var event_toppers_array = '<?php echo $event_toppers_array; ?>';
	var parsed_array = JSON.parse(event_toppers_array);
	console.log(parsed_array);
	var html = "<table class='td_bg' id='lb_table' ><tr class='tr_bg'><td style='text-align: center;'><h5>Rank</h5></td><td style='text-align: center;'><h5>Name</h5></td><td style='text-align: center;'><h5>Net Winnings</h5></td></tr>";
	for (var i=0; i < parsed_array.length; i++) {
	  html += '<tr><td style="text-align: center; width: 15%;"><span>' + parsed_array[i].rank + '</span></td>';
	  html += '<td style="width: 62%;"><img style="cursor: pointer;" onclick="gotoProfile('+parsed_array[i].uid+')" class="user_img" src="https://graph.facebook.com/'+parsed_array[i].uid+'/picture"/>';
	  html += '<span class="user_name" >' + parsed_array[i].first_name + ' ';
	  html += parsed_array[i].last_name+'</span></td>';
	  html += '<td style="width: 23%; " ><span style=" float: right; margin-right: 3px;" >'+parsed_array[i].sum_amount+'</span></td><tr>';
	};
	html += '</table>';
	document.getElementById('extra_div_lb').innerHTML = html;
</script>

<?php
	$this->breadcrumbs=array(
		'Event ' . $event_id . ' Leaderboard'
	);
?>