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
		       appId: '142283812604018', // App ID
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
</head>

<body style="background:#000000 url(http://mtv.in.com/roadies/images/skin02.jpg?t=14) no-repeat top center fixed">
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
	<div style="position:relative">
		<div style="position:absolute; top:0px">
			<div><a href="http://mtv.in.com/roadies/"><img src="http://mtv.in.com/roadies/images/logoRoadies_new.png" alt="" /></a></div>
			<div>
				<!--<div class="FL" style="width:105px; text-align:right">
					<h1 style="font-size:11px; color:#d5d4d1; padding:13px 8px 0px 0px">Follow Us:</h1>
				</div>-->
				<!--<div class="FL" style="width:145px"><a href="http://twitter.com/mtvroadies" target="_blank"><img src="http://mtv.in.com/roadies/images/iconTwit.png" class="MR5" alt="" /></a><a href="https://www.facebook.com/mtvroadies" target="_blank"><img src="http://mtv.in.com/roadies/images/iconFb.png" class="MR5" alt="" /></a><a href="http://www.youtube.com/mtvroadies" target="_blank"><img src="http://mtv.in.com/roadies/images/iconYtube.png" class="MR5" alt="" /></a></div>-->
				<div class="CL"></div>
			</div>
		</div>
	</div>
	
	<div style="background:url(http://mtv.in.com/roadies/images/bgLogo.gif) no-repeat left bottom; height:145px">
		<div class="FL" style="width:250px">&nbsp;</div>
		<div class="FL" style="width:740px">
			<div style="background:url(http://mtv.in.com/roadies/images/bg728x90.gif) no-repeat left bottom; height:50px">
				<div class="FL" style="width:330px">
					<!--<h1 style="font-size:11px; padding:35px 0px 0px 20px"><font style="color:#e1d60c"><b>Every Sat 7 PM</b></font>  &nbsp;|&nbsp;  
                    Click Like to receive updates from Roadies</h1>-->
				</div>
				<div class="FL" style="width:50%">
					<h1 style="padding-top:28px; margin: 0px !important;"><fb:like href="http://www.facebook.com/mtvroadies" layout="button_count" show_faces="false" colorscheme="dark"></fb:like></h1>
				</div>
								<div class="FL" style="width:50%">
					<h1 align="right" style="padding-right:30px; margin: 0px !important;"><a href="http://mtv.tl/27d?utm_source=toplogo&utm_medium=roadies_website&utm_campaign=logo" target="_blank">
					<img src="http://mtv.in.com/roadies/images/internet-partners.png"/></a></h1>
				</div>
								<div class="CL"></div>
			</div>
			<div style="width:728px; height:90px; border:#757339 1px solid; background:#000000"><script type="text/javascript" src="http://mtv.in.com/js/728x90.js"></script></div>
		</div>
		<div class="CL"></div>
	</div>

    <a name="top"></a>
	<div style="background:url(http://mtv.in.com/roadies/images/bgNav.gif) no-repeat; height:80px">
		<ul class="nav">
			
			<!--<li><a href="/roadies/#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav01','','images/navHomeMo.gif',1)"><img src="images/navHome.gif" name="nav01" id="nav01" alt="" /></a></li>-->
			
            <!--li><a href="http://mtv.in.com/roadies/game/index.php" target="_blank" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav10','','images/navGameMo.gif',1)"><img src="images/navGame.gif" name="nav10" id="nav10" alt="" /></a></li-->
            <li><a href="http://mtv.in.com/roadies/videos.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav02','','http://mtv.in.com/roadies/images/navVideosMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navVideos.gif" name="nav02" id="nav02" alt="" /></a></li>
			<li><a href="http://mtv.in.com/roadies/webisodes.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav03','','http://mtv.in.com/roadies/images/navWebiMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navWebi.gif" name="nav03" id="nav03" alt="" /></a></li>
			<li><a href="http://www.theroadiesstore.in/" target="_blank" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav04','','http://predictions.mtv.in.com/images/store-button-hover.gif',1)"> <img src="http://predictions.mtv.in.com/images/store-button.gif" name="nav04" id="nav04" alt="" /></a></li>
			<li><a href="http://mtv.in.com/roadies/audiosodes.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav05','','http://mtv.in.com/roadies/images/audiosodes-hover.gif',1)"><img src="http://mtv.in.com/roadies/images/audiosodes.gif" name="nav05" id="nav05" alt="" /></a></li>
			<!--<li><a href="whats.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav07','','http://mtv.in.com/roadies/images/whatsh.gif',1)"><img src="http://mtv.in.com/roadies/images/whatsh.gif" name="nav07" id="nav07" alt="" /></a></li>-->
			<li><a href="http://mtv.in.com/roadies/dew-zone.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav09','','http://mtv.in.com/roadies/images/navDevzoneMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navDevzone.gif" name="nav09" id="nav09" alt="" /></a></li>
			
			<!--  <li><a href="videoblog.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav04','','http://mtv.in.com/roadies/images/navVbMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navVb.gif" name="nav04" id="nav04" alt="" /></a></li>
			<li><a href="contestants.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav08','','http://mtv.in.com/roadies/images/navContestantsMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navContestants.gif" name="nav08" id="nav08" alt="" /></a></li>
            <!--li><a href="caption.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav08','','http://mtv.in.com/roadies/images/navContestMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navContest.gif" name="nav08" id="nav08" alt="" /></a></li-->
            <!--li><a href="contestants.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav08','','http://mtv.in.com/roadies/images/navContestMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navContest.gif" name="nav08" id="nav08" alt="" /></a></li-->
           <!-- <li><a href="manmaani.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav09','','http://mtv.in.com/roadies/images/navSongMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navSong.gif" name="nav09" id="nav09" alt="" /></a></li>
            <li id="winParent"><a href="contest_crusoe.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav07','','http://mtv.in.com/roadies/images/navContestMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navContest.gif" name="nav07" id="nav07" alt="" /></a></li> -->
            <div id="winChild" class="subnav">
				<a href="http://mtv.in.com/roadies/contestants.php#top"><b>.</b> Vote for the DOER</a>
				<a href="http://mtv.in.com/roadies/contest_crusoe.php#top" style="border:#cccccc 1px solid"><b>.</b> Roadies Adventure Task</a>
			</div>
            <!-- <script type="text/javascript">at_attach("winParent", "winChild", "hover", "y", "pointer");</script> -->
			<li><a href="http://mtv.in.com/roadies/jajabor.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav08','','http://mtv.in.com/roadies/images/jajabor-hover.gif',1)"><img src="http://mtv.in.com/roadies/images/jajabor.gif" name="nav08" id="nav08" alt="" /></a></li>
        	<!--li><a href="forum.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav05','','http://mtv.in.com/roadies/images/navForumMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navForum.gif" name="nav05" id="nav05" alt="" /></a></li-->
			
			<li><a href="http://mtv.in.com/roadies/photos.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav06','','http://mtv.in.com/roadies/images/navPhotosMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navPhotos.gif" name="nav06" id="nav06" alt="" /></a></li>
			<li><a href="http://predictions.mtv.in.com#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav07','','http://mtv.in.com/roadies/images/predictions-hover.gif',1)"><img src="http://mtv.in.com/roadies/images/predictions-hover.gif" name="nav07" id="nav07" alt="" /></a></li>
			<!--li><a href="downloads.php#top" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav07','','http://mtv.in.com/roadies/images/navDwnlMo.gif',1)"><img src="http://mtv.in.com/roadies/images/navDwnl.gif" name="nav07" id="nav07" alt="" /></a></li-->
         <!--   <li><a href="roadies.mtv.in.com" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav06','','http://mtv.in.com/roadies/images/navPhotosMo.gif',1)">Xplorer</a></li>
			<li><a href="http://mtv.in.com/roadies/forum.php#top    " onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav06','','http://mtv.in.com/roadies/images/navPhotosMo.gif',1)">Forums</a></li> -->
			
            
		</ul>
	</div>

</div>
<div class="main">
	<div class="bgContent">
		<div class="PR20 PB20 PL20">
			<div class="title">
				<h1 style="text-transform: uppercase; font-size: 16px !important; font-weight: bold !important; color: #fff !important;">Roadies Prediction</h1>
			</div>
			<div style="background:#000000">
				<div class="breadcrumbs">You are here: <a href="http://mtv.in.com/roadies/index.php#top" style="color: #fff !important;">Home</a> &#8250; <acronym>Roadies Predictions</acronym></div>
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
			window.location = "<?php echo $this->createUrl('/application/getLeaderBoardData'); ?>?uid="+global_user_id;
		}
		
		function showAirtel() {
			window.open('http://www.airtel.in/wps/wcm/connect/airtel.in/airtel.in/betting_app');
		}
	</script>
</body>
</html>
