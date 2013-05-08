<p class="main_page_headers"><span>LEADERBOARD</span></p>
<div style=" margin-bottom: 20px; " >
	<div id="extra_div_lb" style="width: 47%; float: left;">
	</div>
	<div style="position: relative; width: 47%; float: left; margin-left: 6%;" >
		<table id="lb_my" class="td_bg">
			<tr class='tr_bg'>
				<td style="text-align: center; width: 15%;" >
					<h5>My Rank</h5> 
				</td>
				<td style="text-align: center; width: 62%; ">
					<h5>Name</h5>	
				</td>
				<td style="text-align: center; width: 23%;">
					<h5>Net Worth</h5>
				</td>
			</tr>
			<tr>
				<td style="text-align: center; width: 15%;" >
					<span id="my_rank"></span>
				</td>
				<td id="my_name" style=" width: 62%;" >
				</td>
				<td style=" width: 23%;" >
					<span style="float: right; margin-right: 3px;" id="my_nw"></span>
				</td>
			</tr>
		</table>
		<table style="margin-top: 40px;">
			<tr>
				<td>
					<img style=""src="<?php echo Yii::app()->request->baseUrl;?>/images/prize.jpg" />
				</td>
			</tr>
			<tr>
				<td>
					<img style="cursor: pointer;" onclick="gotoRoadiesStore()" src="<?php echo Yii::app()->request->baseUrl;?>/images/prize2.jpg" />
				</td>
			</tr>
			<tr>
				<td>
					<img style="cursor: pointer;" onclick="gotoRoadiesStore()" src="<?php echo Yii::app()->request->baseUrl;?>/images/prize3.jpg" />
				</td>
			</tr>
			<tr>
				<td>
					<img id="invite_ecom" onclick="inviteEcom()" src="<?php echo Yii::app()->request->baseUrl;?>/images/prize4.jpg" />
				</td>
			</tr>
		</table>
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
function get_hash_keys(hsh) {
			    var keys = [];
			    for(var i in hsh) { if (hsh.hasOwnProperty(i)) keys.push(i); }
			    return keys;
	}
	
	function gotoProfile(uid) {
		window.open('https://www.facebook.com/'+uid);
	}
	
	function gotoRoadiesStore(){
		var win=window.open('http://www.theroadiesstore.in/', '_blank');
  		win.focus();
	}
	
	var response = '<?php echo $response ?>';
	var keys = new Array();
	var d = jQuery.parseJSON(response);
	//alert(response);
	keys = get_hash_keys(d);
	var html = "<table class='td_bg' id='lb_table' ><tr class='tr_bg'><td style='text-align: center;'><h5>Rank</h5></td><td style='text-align: center;'><h5>Name</h5></td><td style='text-align: center;'><h5>Net Worth</h5></td></tr>";
	var count = 1;
	var my_name;
	var my_uid;
	var row_count = 1;
	var red_row = 0;
	var user_id = '<?php echo $uid; ?>';
	
		for(var k=0;k<keys.length;k++) {
			key = keys[k];
			
			$.each(d[key], function (index, element) {
				if(index == "rank") {
					html += '<tr id="'+row_count+'" ><td style="text-align: center; width: 15%;"><span>' + element + '</span></td>'
				}else if (index == "uid"){
					if(element == user_id) {
						red_row = row_count;
						//document.getElementById((row_count-1)).style.backgroundColor = 'red';
						html += '<td style="width: 62%;"><img style="cursor: pointer;" onclick="gotoProfile('+element+')" class="user_img" src="https://graph.facebook.com/'+element+'/picture"/>';
					}
					else {
          				html += '<td style="width: 62%;"><img style="cursor: pointer;" onclick="gotoProfile('+element+')" class="user_img" src="https://graph.facebook.com/'+element+'/picture"/>';
					}
          		} else if (index == "first_name") {
          			html += '<span class="user_name" >' + element + ' ';
          		} else if (index == "last_name") {
          			html += element+'</span></td>';
          		} else if (index == "myrank") {
          			
          			document.getElementById('my_rank').innerHTML = element;
          		} else if (index == "myclosing_balance") {
          			document.getElementById('my_nw').innerHTML = element;
          		} else if (index == "myfirst_name") {
          			my_name = element;
          		} else if (index == "mylast_name") {
          			my_name += ' ' + element; 
      			} else if (index == "myuid") {
      			my_uid =element; 
          		} else if (index == "closing_balance") {
          			html += '<td style="width: 23%; " ><span style=" float: right; margin-right: 3px;" >'+element+'</span></td><tr>';
          			row_count++;
          		}
			});
          		count++;
          		
		}
		html += '</table>';
		var html2 = '<img  style="cursor: pointer;" onclick="gotoProfile('+my_uid+')" class="user_img" src="https://graph.facebook.com/'+my_uid+'/picture"/><span class="user_name" >'+ my_name + '</span>';
		document.getElementById('extra_div_lb').innerHTML = html;
		document.getElementById('my_name').innerHTML = html2;
		document.getElementById(red_row).setAttribute('class','leaderboard_me');
		//$("table :last-child").addClass("last-item");
		
		function inviteEcom() {
			
			
		    send_wall_invitation();
		   //window.open('https://www.facebook.com/dialog/send?app_id=142283812604018&name=Invite%Friend&link=https://www.google.com/&redirect_uri=http://predictions.mtv.in.com');
		   
		}
		
		function send_wall_invitation() {
		   // alert(response.to);
		   var ref_code = +(new Date).getTime()+'_'+my_uid;
		   FB.ui({
	        app_id:'500399773343892',
	        method: 'send',
	        name: "Buy Roadies T-shirt",
	        link: 'http://www.theroadiesstore.in/index.php/arrive?referral='+ref_code,
	        max_recipients: 1,
	        to:'',
	        description:'You buy and I win.'
	    },function(response) {
	    	//alert(JSON.stringify(response));
	    	if(response != null) {
	    		//alert('before');
	    		$.ajax({
	    			url: '<?php echo $this->createUrl("/application/saveReferal"); ?>',
	    			data: {uid: my_uid, ref_code:ref_code},
	    			success: function(result) {
	    				//alert(result);
	    			}
	    		});
	    		
	    	}
	    }
	    	);
		}
</script>

<?php
	$this->breadcrumbs=array(
		'Leaderboard'
	);
?>