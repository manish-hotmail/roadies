<p class="main_page_headers"><span>OPEN PREDICTIONS</span></p>
<table>
	<tr>
		<td style="width: 60%; border: 0 !important; " class="primary_td">
			<div id="extra_div_current" >
				
			</div>
		</td>
		<td>
			
		</td>
	</tr>
</table>
<style>
	#current_event_entity_table tbody {
		margin-top: 30px !important;
	}
</style>
<script>
	function get_hash_keys(hsh) {
			    var keys = [];
			    for(var i in hsh) { if (hsh.hasOwnProperty(i)) keys.push(i); }
			    return keys;
	}
	function gotoEvent(event_id) {
		window.location = "<?php echo $this->createUrl('/site/getEventData'); ?>?id=" + event_id;
	}
	var response = '<?php echo $response ?>';
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
          			html += '&nbsp;&nbsp;End Date: '+element+'</span></p>';
          		} else if (index == "total_bets") {
          			//html += '<p class="current_event_meta_data" style="border: none;"><span>Total Precdictions: '+element+'</span></p></td>';
          		}
			});
		}
		html += '</table>';
		document.getElementById('extra_div_current').innerHTML = html;
</script>

<?php
	$this->breadcrumbs=array(
		'OPEN PREDICTIONS'
	);
?>