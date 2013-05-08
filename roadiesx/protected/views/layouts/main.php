<?php /* @var $this Controller */
	date_default_timezone_set('Asia/Calcutta');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<meta charset="utf-8" />

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="" />

	<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->

	<!-- <link rel="shortcut icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/apple-touch-icon.png" /> -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-modal.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-transition.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/mainpage.js"></script>
	<script>
		$(document).ready(function() {
			$(function(){
				//alert('hi');
				$('.navbar-inner ul li').click(function(){
					$('.navbar-inner ul li').removeClass('active');
					$(this).addClass('active');
				}); 
				
			});
		});
	</script>
	<!-- Google Analytical code START -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	
	  _gaq.push(['_setAccount', 'UA-16752562-1']);
	
	  _gaq.push(['_setDomainName', 'none']);
	
	  _gaq.push(['_setAllowLinker', true]);
	
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	
	  })();
	
	</script>
	<!-- Google Analytical code END -->
	<style>
		.fbpdl {
			display: none !important;
		}
		
		._5v4 ._5vc ._5v8 {
			display: none !important;
		}
	</style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script>
		function invite() {	
		FB.ui({
       	 	method: 'apprequests',
        	picture : '',		        
       		 message: "Play and Predict",
        	data: "Roadies Prediction"
    	}, function(response) {
    		//alert(response.to);
    		if(response)
    			updateInviteData(response.to);
        	}
    	);	
	}
	</script>
	<script>
		window.fbAsyncInit = function () {
		   FB.init({
		       appId: '500399773343892', // App ID
		       channelUrl: 'https://apps.facebook.com/roadiesprediction/index.php/site/channel', // Channel File
		       status: true, // check login status
		       cookie: true, // enable cookies to allow the server to access the session
		       xfbml: true,  // parse XFBML
		       authResponse: true
		   });
		   var uid;
		   var accessToken;
		   FB.getLoginStatus(function(response) {
			  if (response.status === 'connected') {
			    // the user is logged in and has authenticated your
			    // app, and response.authResponse supplies
			    // the user's ID, a valid access token, a signed
			    // request, and the time the access token 
			    // and signed request each expire
			    uid = response.authResponse.userID;
			    accessToken = response.authResponse.accessToken;			    
				updateUserProfileInfo(uid);
			  } else if (response.status === 'not_authorized') {
			    // the user is logged in to Facebook, 
			    // but has not authenticated your app
			  } else {
			    // the user isn't logged in to Facebook.
			  }
			 });
		   FB.Canvas.setAutoGrow(); //Resizes the iframe to fit content
		   	//CALLBACK FOR LIKING
		  	FB.Event.subscribe('edge.create',
			function(response) {
				//alert('liked');
				$.ajax({
					url: '<?php echo $this->createUrl("/application/giveAirtelAdvantageBonus"); ?>',
					success: function(response) {
						//alert(response);
						if(response == 1) {
							$('#congo_layout_text').html('Hey, You have just grabbed your Airtel Bonus.');
							$('#congo_layout_popup').modal('show');
						}
					}
				});
			}
			);
		};
		// Load the SDK Asynchronously
		(function (d) {
		   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		   if (d.getElementById(id)) { return; }
		   js = d.createElement('script'); js.id = id; js.async = true;
		   js.src = "//connect.facebook.net/en_US/all.js";
		   ref.parentNode.insertBefore(js, ref);
		} (document));
	</script>
	<script>
		
		
	</script>
</head>

<body>
<div id="fb-root"></div> 
<!--
<div class="navbar">
  <div class="navbar-inner">
    
    <ul class="nav">
      <li class="active"><a href="#">Home</a></li>
      <li ><a href="#">Latest Bets</a></li>
      <li><a href="#">Completed Bets</a></li>
      <li><a href="http://localhost/roadiesx/index.php/site/index">Airtel Alright</a></li>
    </ul>
  </div>
</div>
-->
	<div id="congo_layout_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <p>Congratulations!!!</p>	    
	  </div>
	  <div class="modal-body">	    
		<p id="congo_layout_text"></p>
	  </div>
	</div>
	
	<div id="tinfo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <h3 style="color: #9e0000;"> Enter your Roadies Store Order id below to earn bonus Roadies Dollars.</h3>	    
	  </div>
	  <div class="modal-body">	    
	  	<input id="enter_order_id" type="text"/>
		<!-- <p id="congo_layout_text"></p> -->
		 <button class="btn-danger" onclick="getTinfo()" aria-hidden="true" style="display: block;">Submit</button>		
		<p style="margin-top: 10px;">
			Dont have an order id ? <br>
			Visit <a style="color: #6c5600 !important; text-decoration: underline;" href="http://theroadiesstore.in" target="_blank">theroadiesstore.in</a> to buy official Roadies T-shirts.
		</p>
	  </div>
	  <div id="prize_model_footer" class="modal-footer">
	    <p style="color: red;" id="prize_error_msg"></p>
	  </div>	
	</div>
	
	<div id="faq_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <p><h2>FAQ</h2></p>
	  </div>
	  <div class="modal-body">	    
		<p><b>How to play Roadies X Predictions?</b></p>
	    <p>
	    	You have R$10,000 (virtual money) at the beginning. The aim is to invest Roadies Dollars wisely in predictions about the questions asked for an event. An event features multiple questions with multiple options. The maximum amount you can invest per question is R$1000. If your predictions turn out right, you earn more Roadies Dollars which you can plow back in to other predictions, or get a better ranking on our leaderboard.
	    </p>
	    <p>
	    	Note that, at the end of every event the system automatically sells all predictions you have made for the completed event. Also, everyday you log in to Roadies X Predictions you get a bonus R$500.
	    </p>
	    <p>
	    	Every week a new event opens up for predictions.
	    </p>
	    <p>
	    	Here are some quick definitions to help you -
	    </p>	    
	    <p><b>R$</b></p>
	    <p>
	    	R$ or Roadies Dollars is virtual money used for transactions specifically for Roadies X Predictions. 
	    </p>
	    <p><b>Odds</b></p>
	    <p>
	    	The percentage value of the probability a given prediction will come true. These odds change all the time.
	    </p>
	    <p><b>Total Pot</b></p>
	    <p>
	    	The total amount that has been invested in a particular event by everyone.
	    </p>
	    <p><b>Total Predictions</b></p>
	    <p>
	    	The total number of people who have placed their predictions.
	    </p>
	    <p><b>Leaderboard</b></p>
	    <p>
	    	The leaderboard displays the rankings of all users of Roadies X Predictions ordered by the Available Cash.
	    </p>
	    <p>
	    	<b>Bonus</b>
	    </p>
	    <p>
	    	Like the Airtel Facebook Page to get bonus R$1000. If you have already liked the airtel page before, R$1000 will automatically be added to your account.
	    </p>
	    <p>
	    	Get R$500 bonus for each friend you invite.  This will be transferred to your account when your friend makes his/her first prediction.
	    </p>
	  </div>
	</div>
	
	<!-- <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/header.jpg" /> -->
	<div id="flashContent">
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="760" height="161" id="Roadies" align="middle">
			<param name="movie" value="<?php echo Yii::app()->request->baseUrl;?>/images/Roadies.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="true" />
			<param name="wmode" value="window" />
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
			<param name="allowScriptAccess" value="sameDomain" />
			<!--[if !IE]>-->
			<object type="application/x-shockwave-flash" data="<?php echo Yii::app()->request->baseUrl;?>/images/Roadies.swf" width="760" height="161">
				<param name="movie" value="<?php echo Yii::app()->request->baseUrl;?>/images/Roadies.swf" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
			<!--<![endif]-->
				<a href="http://www.adobe.com/go/getflash">
					<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
				</a>
			<!--[if !IE]>-->
			</object>
			<!--<![endif]-->
		</object>
	</div>
	
	<div id="main_user_info" style="height: 60px;">
		<table>
			<tr>
				<td style='width: 10%; border: none;' id="user_profile">			
							
				</td>
				<td style='width: 40%;' id="user_profile_info">			
							
				</td>
				<td style="width: 17%;">
					<p>Invested Amount</p>
					R$ <span id="user_invested_amount"></span>
				</td>
				<td style="width: 16%;">
					<p>Winnings</p>
					R$ <span id="user_winnings"></span>
				</td>
				<td style="width: 17%; border: none;">
					<p>Available Cash</p>
					R$ <span id="user_available_cash"></span>
				</td>
			</tr>
		</table>
	</div>
	<div id="mainmenu" >
		<?php $this->widget('zii.widgets.CMenu',array(                                    
            'activateParents'=>true,                                              
			'items'=>array(                                         
				array('label'=>'HOME', 'url'=>array('/application/main')),
				array('label'=>'|'),
				array('label'=>'LATEST EVENTS', 'url'=>array('/application/latestEvents')),
				array('label'=>'|'),
				array('label'=>'COMPLETED EVENTS', 'url'=>array('/site/completedEvents')),
				array('label'=>'|'),
				array('label'=>'AIRTEL ADVANTAGE', 'url'=>'javascript:showAirtel()'),
				array('label'=>'|'),
				array('label'=>'MY TRANSACTIONS', 'url'=>array('application/myBets')),
				array('label'=>'|'),
				array('label'=>'LEADERBOARD', 'url'=>'javascript:gotoLeaderBoardMain()'),                                                      
			),                                             
      )); ?>      
	</div>
	<div class="breadcrumbs">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
	</div> <!-- end breadcrumbs -->	
	
		<?php echo $content; ?>	

	<div id="footer">
		<table style="margin: 0px; padding: 0px; border: 0px;">
			<tr>
				<td style="padding: 0px;">
					<img style="cursor: pointer;" onclick="showTinfo()" src="<?php echo Yii::app()->request->baseUrl;?>/images/redeem.jpg" />
				</td>
				<td style="padding: 0px;">
					<img src="<?php echo Yii::app()->request->baseUrl;?>/images/earn.jpg" />
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td id="share_with_friends" style='width: 33.3%;'>
					<table style="margin: 0px;">
						<tr>
							<td>
								<button class="view_event_btn" onclick="invite()">Invite</button>
							</td>
							<td>
								<span>Friends and get Bonus R$ 500</span>
							</td>
						</tr>
					</table>
				</td>
				<td>
					<?php $this->widget('zii.widgets.CMenu',array(                                    
			            'activateParents'=>true,                                              
						'items'=>array(                                         
							array('label'=>'FAQs', 'url'=>'javascript:showFaq()'),
							array('label'=>'|'),
							array('label'=>'Terms & Conditions', 'url'=>array("/application/tnc")),
							array('label'=>'|'),
							array('label'=>'Privacy Policy', 'url'=>'http://mtv.in.com/privacy-policy.html','linkOptions'=>array("target"=>"_blank")),                                       
						),                                             
			      )); ?>
				</td>				
				<td id="like_airtel_india">
					<table style="margin: 0px;">
						<tr>
							<td>
								<fb:like href="https://www.facebook.com/AirtelIndia" send="false" layout="button_count" width="100" height="100" show_faces="false"></fb:like>
							</td>
							<td>
								<span>AIRTEL PAGE TO GET BONUS R$ 1000</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<img style="float: right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/lmw.png" />
		<label style="float: left; color: black; " >
			Any Questions? Mail us at <a href="mailto:roadies@mtvindia.com" >roadies@mtvindia.com</a>
		</label>
	</div>
	<script>		
		var global_user_id = ''; 
		var global_participant_id = '';
		var user_name ='';
		var balance = '';
		var winnings = '';
		var investedAmount = '';
		var myrank_info = '';
		function updateUserProfileInfo(user_id){			
			$.ajax({
				url: '<?php echo $this->createUrl("/site/getUserProfileData"); ?>',
				data: {uid: user_id},
				success: function(response) {
					if (response.substr(0,5) == 'error'){
						setInterval(
							function () {
								updateUserProfileInfo();
							}	
						,30000);						
					} else {
						data = jQuery.parseJSON(response);
						$.each(data, function(index, element) {
							//alert(element);
							if (index == "id")
							{
								global_user_id = element;
							} else if (index == "name"){
								user_name = element;
							} else if (index == "balance"){
								balance = element;
							} else if (index == "winnings"){
								winnings = element; 
							} else if (index == "invested_amount"){
								investedAmount = element;
							} else if (index == "rank"){
								myrank_info = element;
							} else if (index == "participant_id"){
								global_participant_id = element;
							}
						});
						apL = "<img src='https://graph.facebook.com/"+global_user_id+"/picture' />";				
						document.getElementById('user_profile').innerHTML = apL;
						apL = "<p> Hello "+user_name+",</p>";
						apL += "<span> Your Overall Rank is "+myrank_info;
						document.getElementById('user_profile_info').innerHTML = apL;
						document.getElementById('user_invested_amount').innerHTML = investedAmount;
						document.getElementById('user_winnings').innerHTML = winnings;
						document.getElementById('user_available_cash').innerHTML = balance;
					}				
				}
			});
		}
		
		$('#congo_layout_popup').modal({
		  	show: false
		});	
		$('#faq').modal({
		  	show: false
		});	
		$('#tinfo').modal({
		  	show: false
		});
		
		function showTinfo(){
			$('#tinfo').modal('show');	
		}
		
		function updateInviteData(response) {
			//alert(global_participant_id);		
			$.ajax({
				url: '<?php echo $this->createUrl("/application/updateInviteData"); ?>',
				data: {invited_friends:response, pid: global_participant_id},
				success:function(result) {
					//alert(result);
				}
			});
		}
		function showFaq() {
			$('#congo_popup').modal('hide');	
			$('#faq_popup').modal('show');
		}
		
		function getTinfo(){
			document.getElementById('prize_error_msg').style.display = "none";
			var orderId = document.getElementById('enter_order_id').value;
			$.ajax({
				url: '<?php echo $this->createUrl("/application/getTinfo"); ?>',
				data: {order_id:orderId, pid: global_participant_id},
				success:function(result) {
					//alert(result);					
					if(result.substr(0,5) == 'ERROR'){
						document.getElementById('prize_error_msg').innerHTML = result;
					} else {
						document.getElementById('user_available_cash').innerHTML = parseInt(document.getElementById('user_available_cash').innerHTML) + parseInt(result);
						document.getElementById('prize_error_msg').innerHTML = "R$2000 has been credited to your account";						
					}
					document.getElementById('prize_error_msg').style.display = "block";
				}
			});
		}
		
		function gotoLeaderBoardMain(){
			window.location = "<?php echo $this->createUrl('/application/getLeaderBoardData'); ?>?uid="+global_user_id;
		}
		
		function showAirtel() {
			window.open('http://www.airtel.in/wps/wcm/connect/airtel.in/airtel.in/betting_app');
		}
	</script>
</body>
</html>
