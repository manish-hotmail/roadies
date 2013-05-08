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
	<link href="http://mtv.in.com/roadies/css/style.css" rel="stylesheet" type="text/css" media="screen">
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
	<style>
		.fbpdl {
			display: none !important;
		}
		
		._5v4 ._5vc ._5v8 {
			display: none !important;
		}
		
		.nav {
			padding: 7px 0px 0px 13px !important;	
		}
		
		.title 	h1 {
			padding: 0px !important;	
		}
		
		.nav > li > a {
			display: inline !important;
		}
		
		.nav > li > a:hover {
			background: none !important;	
		}
	</style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script>
		function invite() {	
		FB.ui({
       	 	method: 'apprequests',
        	picture : '<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg',		        
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
		       appId: '414295275333239', // App ID
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
							$('#congo_layout_text').html('Hey, You have just grabbed your MTV India Page Like Bonus.');
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
	<script type="text/javascript">
	<!--
	function MM_swapImgRestore() { //v3.0
		var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}
	function MM_preloadImages() { //v3.0
		var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
			var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
			if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
	
	function MM_findObj(n, d) { //v4.01
		var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		if(!x && d.getElementById) x=d.getElementById(n); return x;
	}
	
	function MM_swapImage() { //v3.0
		var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
		if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}
	//-->
</script>
<!-- Google Analytical code START -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-16752562-4', 'in.com');
        ga('send', 'pageview');

    </script>
	<!-- Google Analytical code END -->
</head>

<body style="background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/cricket-predictions-bg.jpg') no-repeat top center fixed">
<div id="fb-root"></div> 
<style type="text/css">.nav li{ display:inline; padding-right:16px }</style>
<script type="text/javascript" src="http://mtv.in.com/js/mtvi_reporting_ads.js"></script>
<script type="text/javascript" src="http://mtv.in.com/js/ad_def_home.js"></script>
<script language="javascript">
var a_zone = "in_roadies";
var _onlyInhouseAds=false;
var _noBanner=false;
com.mtvi.ads.AdManager.setZone(a_zone);
com.mtvi.ads.AdManager.setDartSite("mtvindia");
com.mtvi.ads.AdManager.DART_SITE_DOMAIN=".com";
com.mtvi.ads.AdManager.setMedia("adj");
com.mtvi.ads.AdManager.setServer("ad.doubleclick.net");
</script>
<div class="main">
	<div  class="bgContent" style="background: url('') !important;" >
		<div class="PR20 PB20 PL20">
			<div style="">
				
				<table class="PB20" width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr valign="top">
						<td>							
							<?php echo $content; ?>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
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
		function formatMoney($number, $fractional) {
		    if ($fractional) {
		        $number = sprintf('%.2f', $number);
		    }
		    while (true) {
		        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
		        if ($replaced != $number) {
		            $number = $replaced;
		        } else {
		            break;
		        }
		    }
		    return $number;
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
			window.location = "<?php echo $this->createUrl('/application/winners'); ?>";
		}
		
		function showAirtel() {
			window.open('http://www.airtel.in/wps/wcm/connect/airtel.in/airtel.in/betting_app');
		}
	</script>
</body>
</html>
