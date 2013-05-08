<div id="roadies_intro">
	<h4>About Roadies Predictions</h4>
	<p>
		Make your predictions on each episodes and win loads of Roadies X Merchandise.
	</p>
</div>	
<table id="main_page_table" >	
	<tr>
		<td class="primary_td" >
			<p class="main_page_headers"><span>CURRENT EVENTS</span></p>
			<div id="extra_div_current" >
				
			</div>
		</td>
		<td class="sidebar_td" >
			<p class="main_page_headers"><span>UPCOMING EVENTS</span></p>
			<div id="extra_div_upcoming" >
				
			</div>
		</td>
	</tr>
	<tr>
		<td class="primary_td" >
			<p class="main_page_headers">
				<span>
				COMPLETED EVENTS
				</span>
			</p>
			<div id="extra_div_closed" >
				
			</div>
		</td>
		<td class="sidebar_td" >
			<p class="main_page_headers">
				<span>
				LEADERBOARD
				</span>
			</p>
			<div id="extra_div_lb" >
				
			</div>
		</td>
	</tr>
</table>
<div id="congo_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h3>Congratulations!!!</h3>	    
	  </div>
	  <div class="modal-body">	    
		<p id="congo_text"></p>
	  </div>
</div>
<script>
	$(document).ready(
		loadEntireData
	);
	$('#congo_popup').modal({
	  	show: false
	});	
	
	function get_hash_keys(hsh) {
			    var keys = [];
			    for(var i in hsh) { if (hsh.hasOwnProperty(i)) keys.push(i); }
			    return keys;
	}
	function loadEntireData() {
		getUpcomingEventsData();
		getCurrentEventsData();
		getClosedEventsData();
		getLeaderboardData();
	}
	function getUpcomingEventsData() {
		//alert('hi');
		var html = '<table id="upcoming_event_entity_table">';
		$.ajax({
			url: '<?php echo $this->createUrl("/application/upcomingEventsData"); ?>',
			success: function(response) {
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				for(i=0; i< keys.length; i++) {
					key = keys[i];
					$.each(d[key], function (index, element) {
						if (index == "id") {
                  		} else if (index == "title") {
                  			html += '<tr><td><h4>'+element+'</h4><p>Opens</p>';
                  		} else if (index == "start_time") {
                  			html += '<p>'+element+'</p></td></tr>';
                  		}
					});
				}
				html += '</table>';
					document.getElementById('extra_div_upcoming').innerHTML = html;
					setTimeout(
						function () {
							getUpcomingEventsData();
						}	
					,30000);
			}
		});
	}
	function getCurrentEventsData() {
		$.ajax({
			url: '<?php echo $this->createUrl("/application/currentEventsData"); ?>',
			success: function(response) {
				var data_id_array = new Array();
				var data_title_array = new Array();
				var data_total_pot_array = new Array();
				var keys = new Array();
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				var html = '<table id="current_event_entity_table" >';
				var event_id;
					for(var k=0;k<keys.length;k++) {
						key = keys[k];
						$.each(d[key], function (index, element) {
							if (index == "id"){
								event_id = element;
	                  		} else if (index == "title") {
	                  			html += '<tr><table class="current_event_info"><tr><td style="width: 60%; padding-left: 15px;"><h4 style="min-height: 40px; font-size: 17px;">'+element+'</h4>';
	                  		} else if (index == "total_pot") {
	                  			html += '<td><div class="total_pot"><h4>TOTAL POT</h4><h3>R$ '+element+'</h3><button onclick="gotoEvent('+ event_id +')" class="btn-danger" style="font-size: 12px;">PREDICT NOW</button></div></td></tr></table></tr>';
	                  		} else if (index == "start_time") {
	                  			html += '<p class="current_event_meta_data"><span>Start Date: '+element;
	                  		} else if (index == "end_time") {
	                  			html += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date: '+element+'</span></p>';
	                  		} else if (index == "total_bets") {
	                  			//html += '<p class="current_event_meta_data" style="border: none;"><span>Total Predications: '+element+'</span></p></td>';
	                  		}
						});
					}
					html += '</table>'
					document.getElementById('extra_div_current').innerHTML = html;
					setTimeout(
						function () {
							getCurrentEventsData();
						}	
					,30000);
			}
		});
	}
	function getClosedEventsData() {	
		$.ajax({
			url: '<?php echo $this->createUrl("/application/closedEventsData"); ?>',
			success: function(response) {
				var data_id_array = new Array();
				var data_title_array = new Array();
				var data_total_bets_array = new Array();
				var keys = new Array();
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				var html = '<table id="closed_event_entry_table">';
				var event_id;
				//alert(response);
					for(var k=0;k<keys.length;k++) {
						key = keys[k];
						$.each(d[key], function (index, element) {
	                  		if (index == "id"){
	                  			event_id = element;
	                  		} else if (index == "title") {
	                  			html += '<tr><td style="width:50%;"><h4><a href="javascript:gotoEvent('+event_id+')" >'+element+'</a></h4>';
	                  		} else if (index == "total_bets") {
	                  			//html += '<p>Total Predictions: '+element+' predictions</p>';
	                  		} else if (index == "end_time") {
	                  			html += '<p>Closed on '+element+'</p></td><td style="width:30%; vertical-align:middle;"><button class="view_event_btn" onclick="gotoEventLeaderBoard('+event_id+')" >Leaderboard</button></td><td class="view_closed_event"><button class="view_event_btn" onclick="gotoEvent('+event_id+')" >View Event</button></td></tr>';
	                  		}
						});
					}
					//alert(html);
					html += '</table>'
					document.getElementById('extra_div_closed').innerHTML = html;
					setTimeout(
						function () {
							getClosedEventsData();
						}	
					,30000);
			}
		});
	}
	function getTopBetData() {
		$.ajax({
			url: '<?php echo $this->createUrl("/application/getTopBetData"); ?>',
			success: function(response) {
				var data_id_array = new Array();
				var data_title_array = new Array();
				var data_status_array = new Array();
				var data_total_pot_array = new Array();
				var data_total_bets_array = new Array();
				var data_start_time_array = new Array();
				var data_end_time_array = new Array();
				var data_event_id_array = new Array();
				var keys = new Array();
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				var html;
					for(var k=0;k<keys.length;k++) {
						key = keys[k];
	                  	value = d[key];
	                  	for (i=0; i< value.length; i++) {
	                  		if (key == "id"){
	                  			data_id_array.push(value[i]);
	                  		} else if (key == "title") {
	                  			data_title_array.push(value[i])
	                  			//document.getElementById('top_bet_question').innerHTML = value[i];
	                  		} else if (key == "status") {
	                  			data_status_array.push(value[i])
	                  		} else if (key == "start_time") {
	                  			data_start_time_array.push(value[i])
	                  			//document.getElementById('start_date_top_bet').innerHTML = value[i];
	                  		} else if (key == "end_time") {
	                  			data_end_time_array.push(value[i])
	                  		} else if (key == "total_pot") {
	                  			//document.getElementById('top_bet_amount').innerHTML = "R$ " + value[i];
	                  			data_total_pot_array.push(value[i])
	                  		} else if (key == "total_bets") {
	                  			//document.getElementById('top_bet_count').innerHTML = value[i];
	                  			data_total_bets_array.push(value[i]);
	                  		}
	                  		
	                  		//alert(data_title_array);
	                  		//document.getElementById('top_bet_question').innerHTML = data_title_array.pop();
	                  	}
	                  	
					}
					//alert(data_title_array);
					setTimeout(
						function () {
							getTopBetData();
						}	
					,30000);
			}
		});
	}
	function getUserData() {
		$.ajax({
			url: '<?php echo $this->createUrl("/application/getUserData"); ?>',
			data: {uid:'<?php echo $uid; ?>'},
			success: function(response) {
				var data_id_array = new Array();
				var data_first_name_array = new Array();
				var data_middle_name_array = new Array();
				var data_last_name_array = new Array();
				var data_closing_balance_array = new Array();
				var data_total_credits_array = new Array();
				var data_total_debits_array = new Array();
				var keys = new Array();
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				var html;
					for(var k=0;k<keys.length;k++) {
						key = keys[k];
	                  	value = d[key];
	                  	for (i=0; i< value.length; i++) {
	                  		if (key == "id"){
	                  			data_id_array.push(value[i]);
	                  		} else if (key == "first_name") {
	                  			data_first_name_array.push(value[i])
                  			} else if (key == "middle_name") {
                  			data_middle_name_array.push(value[i])
                  			} else if (key == "last_name") {
                  			data_last_name_array.push(value[i])
                  			} else if (key == "closing_balance") {
	                  			data_closing_balance_array.push(value[i])
                  			} else if (key == "total_credits") {
                  			data_total_credits_array.push(value[i])
	                  		} else if (key == "total_debits") {
	                  			data_total_debits_array.push(value[i]);
	                  		}
	                  	}
					}
					//alert(data_first_name_array);
					setTimeout(
						function () {
							getUserData();
						}	
					,30000);
			}
		});
	}
	function getUserRecentBets() {
		$.ajax({
			url: '<?php echo $this->createUrl("/application/getUserRecentBets"); ?>',
			data: {id:'<?php echo $pid; ?>'},
			success: function(response) {
				var data_id_array = new Array();
				var data_question_text_array = new Array();
				var data_bet_amount_array = new Array();
				var keys = new Array();
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				var html;
				for(var k=0;k<keys.length;k++) {
					key = keys[k];
                  	value = d[key];
                  	for (i=0; i< value.length; i++) {
                  		if (key == "id"){
                  			data_id_array.push(value[i]);
                  		} else if (key == "question_text") {
                  			data_question_text_array.push(value[i])
              			} 
                  	}
				}
				setTimeout(
					function () {
						getUserData();
					}	
				,30000);
			}
		});
	}
	function getLeaderboardData() {
		$.ajax({
			url: '<?php echo $this->createUrl("/application/getTop4"); ?>',
			success: function(response) {
				var keys = new Array();
				var d = jQuery.parseJSON(response);
				keys = get_hash_keys(d);
				var html = '<table id="lb_table">';
				for(var k=0;k<keys.length;k++) {
					key = keys[k];
					$.each(d[key], function (index, element) {
                  		if (index == "uid"){
                  			html += '<tr><td><img style="cursor: pointer;" onclick="gotoProfile('+ element +')" src="https://graph.facebook.com/'+element+'/picture"/></td>';
                  		} else if (index == "first_name") {
                  			html += '<td><p>'+element+' ';
                  		} else if (index == "last_name") {
                  			html += element+'</p>';
                  		} else if (index == "closing_balance") {
                  			html += '<p>R$ '+element+'</p><td><tr>';
                  		}
					});
				}
				html += "<tr><td>&gt;&gt; <a href='javascript:gotoLeaderBoard()' style='color: #0088cc !important;'>View List</a><td></tr>";
				html +- '</table>'
				//alert(html);
				document.getElementById('extra_div_lb').innerHTML = html;
				setTimeout(
					function () {
						getLeaderboardData();
					}	
				,30000);
			}
		});
	}
	
	function gotoEvent(event_id) {
		window.location = "<?php echo $this->createUrl('/site/getEventData'); ?>?id=" + event_id;
	}
	
	function gotoEventLeaderBoard(event_id) {
		window.location = "<?php echo $this->createUrl('/application/eventLeaderBoard'); ?>?event_id=" + event_id;
	}
	
	function gotoProfile(user_id) {
		window.open('https://www.facebook.com/'+user_id);
	}
	
	function gotoLeaderBoard(){
		window.location = "<?php echo $this->createUrl('/application/getLeaderBoardData'); ?>?uid=<?php echo $uid; ?>";
	}			
	
</script> 
<?php
	if($alert == 1) {
?>
	<script>
		$('#congo_text').html('<?php echo $alert_text; ?>');
		$('#congo_popup').modal('show');
	</script>
<?php		
	}
	else {
	}
?>