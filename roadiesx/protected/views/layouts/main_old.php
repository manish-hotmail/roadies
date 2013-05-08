<?php /* @var $this Controller */
date_default_timezone_set('Asia/Calcutta');
    $datestr = date("Y-m-d H:i:s");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /> -->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/scrollbar.css" media="all"/>
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "20ce095b-e628-4eba-8900-38d47fa364ad"});</script>
	<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
	
	
	<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tweet.js'></script>
	<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flexslider.js'></script>
	<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flexslider-min.js'></script>
	
	<script>
	   function gotoFacebook(){
	       window.open("http://www.facebook.com/MicrosoftIndia");
	   }
	   
	   function gotoTwitter() {
	       window.open("http://www.twitter.com/MicrosoftIndia");
	   }
	   
	   function gotoNewWindow(href){
	       window.open(href);
	   }
	    
	</script>
	<script>
            function tweeting(){
                var txt = document.getElementById('twt').value;
                var hre = 'https://twitter.com/home/?status='+txt ;
                window.open(hre,'abc','width=500,height=400,top=300,left=300');
            }
        </script>
	<style>
	    
	</style>
	
</head>

<body>

<div class="container" id="page">

	<div id="header">		
		<div id="social-menu">			
			<span>Follow Us:</span>
				<img style="cursor: pointer; margin-left: 85px; height: 25px; width: 25px; " onclick="gotoFacebook()" src="<?php echo Yii::app()->request->baseUrl;?>/css/f_logo.png"  >
				<img style="cursor: pointer; padding: 5px 5px 0px 20px; height: 25px; width: 25px;" onclick="gotoTwitter()" src="<?php echo Yii::app()->request->baseUrl;?>/css/t_logo.png">
			
		</div>
	</div><!-- header -->

	<div class="myfont">
		<ul class="menu">
		 
		    <li id="home"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/index">Home</a></li>
		    <li id="products"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/product">Products</a>
		        <ul>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/windows" class="windows">Windows</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/office" class="office">Office</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/internetExplorer" class="internetExplorer">Internet Explorer</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/xbox_360" class="xbox360">Xbox 360</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/cloud" class="cloud">Cloud</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/server_and_tools" class="server_and_tools">Server and Tools</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/dynamics" class="dynamics">Dynamics</a></li>
		            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/project_and_visio" class="project">Project and Visio</a></li>		            
		        </ul>
		    </li>
			<li id="events"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/events">Events</a></li>		    
		    <li id="csr"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/customer">Citizenship</a></li>
		    <li id="demos"><a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/site/demo">How-to Videos</a></li>		 
		</ul>
	</div>		
				<?php /*$this->widget('zii.widgets.CMenu',array(
					'activateParents'=>true,
					'items'=>array(
						//array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'Product', 'url'=>array('/site/product'), 'items'=>array(
									array('label'=>'Windows' , 'url'=>array('/site/windows')),
									array('label'=>'Office' , 'url'=>array('/site/office')),
									array('label'=>'Internet Explorer' , 'url'=>array('/site/internetExplorer')),
									array('label'=>'Xbox 360' , 'url'=>array('/site/xbox_360')),
									array('label'=>'Cloud' , 'url'=>array('/site/cloud')),
									array('label'=>'Server and Tools' , 'url'=>array('/site/server_and_tools')),
									array('label'=>'Dynamics' , 'url'=>array('/site/dynamics')),
																													
								)),
						//array('label'=>'Demos/How to', 'url'=>array('/site/demo')),
						//array('label'=>'CSR', 'url'=>array('/site/customer')),
						//array('label'=>'Events', 'url'=>array('/site/events')),
						//array('label'=>'Login', 'CSR'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					),
				));*/ ?>
		<?php
			require 'vendors/php-sdk/facebook.php';
			
			$facebook = new Facebook(array(
				  'appId'  => '498007800224634',
			  	  'secret' => 'fa2ac87e9cdb4b822e1a083b358bacc4',
				  'cookie' => true,
				  'fileUpload' => true,
				));
			
			$token = $facebook->getAccessToken();
			
			$post_url = "https://graph.facebook.com/163364503715353/posts?access_token=".$token;
			$response = '';
			$response = $response.file_get_contents( $post_url );
			$obj = json_decode( $response );
			$statuslen = count($obj->data);
	        //echo $statuslen;
			
			 $status = array();
	               $status_array = array();
	       
	               for ($i=0; $i < $statuslen; $i++) {
	                       $post_name = $obj->data[$i]->from->name;
	                       if(isset($obj->data[$i]->message))
	                               $disp_message = $obj->data[$i]->message;
	                       else {
	                               continue;
	                       }
	                       if(isset($obj->data[$i]->likes->count))
	                               $post_likes_count = $obj->data[$i]->likes->count;
	                       else {
	                               continue;
	                       }
	                       if(isset($obj->data[$i]->comments->count))
	                               $post_comments_count = $obj->data[$i]->comments->count;
	                       else {
	                               continue;
	                       }
	                       if(isset($obj->data[$i]->picture)){
	                               $image_url = $obj->data[$i]->picture;
	                       } 
	                       else {
	                               continue;
	                       }
	                       $create_time = $obj->data[$i]->created_time;
	                       /*
	                       $this->renderPartial('_main',array(
	                               'post_name'=>$post_name,
	                               'message'=>$disp_message,
	                               'post_likes_count'=>$post_likes_count,
	                               'post_comments_count'=>$post_comments_count,
	                               'create_time'=>$create_time,
	                               'image_url'=>$image_url,
	                       ));
	                       */
	                       $status = array(
	                               'post_name'=>$post_name,
	                               'message'=>$disp_message,
	                               'post_likes_count'=>$post_likes_count,
	                               'post_comments_count'=>$post_comments_count,
	                               'create_time'=>$create_time,
	                               'image_url'=>$image_url
	                       );
	                       array_push($status_array, $status);
	                       //print_r($status);
	               }
		   ?>
		   
	<?php echo $content; ?>
	
	<div style="z-index: 12000;">
		<img style="cursor: pointer; position: relative; padding: 10px 4px 10px 12px;" onclick="gotoNewWindow('http://windows.microsoft.com/en-US/internet-explorer/products/ie/home')" src="<?php echo Yii::app()->request->baseUrl; ?>/css/intexp.jpg"/>
		<img style="cursor: pointer; position: relative; padding: 10px 4px 10px 4px;" onclick="gotoNewWindow('https://apps.facebook.com/haloquest/')" src="<?php echo Yii::app()->request->baseUrl; ?>/css/halo_quest.jpg"/>
		<img style="cursor: pointer; position: relative; padding: 10px 8px 10px 4px;" onclick="gotoNewWindow('http://windows.microsoft.com/en-IN/windows-8/release-preview')" src="<?php echo Yii::app()->request->baseUrl; ?>/css/w8.jpg"/>
		
		<div id="facebookfeeds" class="facebookfeeds" style=" padding: 20px; margin-right: -10px; ">
			<div style="float: right; background-color: #ffffff; width: 425px; height: 400px; border: 1px solid #888888; padding: 20px;">
				<div style="height: 75px;">
					<img style=" width: 50px; height: 50px; " src="<?php echo Yii::app()->request->baseUrl; ?>/css/f_logo.png" />
	           		<label  style=" position: relative; margin-left: 10px; top: -12px; margin-top: -20px; color: #00188f; font-family: Segoe-light; font-size: 26px;"> Facebook Feed </label>
				</div>
				<div style=" height: 300px; overflow: auto;">
				<?php	        
		        	for ($i=0; $i < count($status_array); $i++) {
		            ?> 
	          		<div onclick="gotoFacebook()" style="height: 100px; cursor: pointer; overflow: hidden; ">
			           <div style="float: left; width: 70px; height: 100px; ">
			           		<?php echo "<img style='width: 50px; margin-top: 5px; height: 50px;' src='https://graph.facebook.com/163364503715353/picture?access_token=". $token . "'/>"; ?>
			           </div>
			           <div>		        
				            <div class="row"  >
				                <label style="color: #00bcf2; font-size: 16px; left: 10px; ">
				                    <?php echo $status_array[$i]['post_name']; ?>
				                </label>
				            	
				            </div>
				            
				            <div class="row" >
				                <label style="color: #000000; font-size: 14px; left: 10px; ">
				                    <?php 
					                    if (strlen($status_array[$i]['message']) > 100) {
											echo substr($status_array[$i]['message'], 0, 100).'...';
										} else {
											echo $status_array[$i]['message'];
										}
				                    ?>
				                </label>
				            	
				            </div>
				            
				            <div class="row" style="color: #969696; font-size: 12px; ">
				                <?php 
				                   $min = (strtotime($datestr) - strtotime($status_array[$i]['create_time']))/60;
                                   if($min < 60) {
                                       echo ceil($min) . " minutes ago . " . $status_array[$i]['post_likes_count'] .  " People Like This . " . $status_array[$i]['post_comments_count'] . " Comments" ;
                                   }
                                   else if($min < 1440) {
                                       echo ceil($min/60) . " hours ago . " . $status_array[$i]['post_likes_count'] .  " People Like This . " . $status_array[$i]['post_comments_count'] . " Comments" ;
                                   }
                                   else {
                                       if(round($min/1440) == 1)
                                       echo ceil($min/1440) . " day ago . " . $status_array[$i]['post_likes_count'] .  " People Like This . " . $status_array[$i]['post_comments_count'] . " Comments" ;
                                       else
                                       echo ceil($min/1440) . " days ago . " . $status_array[$i]['post_likes_count'] .  " People Like This . " . $status_array[$i]['post_comments_count'] . " Comments" ;    
                                   }
				                 ?>
				                
				            </div>
					   </div>
				   </div>
					<?php
		   				 }
			        ?>
			    </div>
			</div>
		
			<div id="favorites" style="width: 450px;">			
				<script>
				//alert("hello");
				
			     </script>
			</div>
		</div>
		
		<div id="twitterfeeds" style="background-color: #ffffff; font-family: Segoe-light; float: left; width: 450px; margin-top: -20px; margin-left: 11px; height: 440px; position: relative;  border: 1px solid #888888;" >
		    <div style="font-size: 26px; height: 150px;">
		        <img style="width: 80px; height: 80px;" src="<?php echo Yii::app()->request->baseUrl;?>/css/t_logo.png"  />		 
		        <p style="position: absolute; color: #00bcf2; font-family: Segoe-light; top: 27px; left: 80px;">tweet@microsoftIndia</p>
		        <div>
			        <textarea  style=" border-color: rgba(0,0,0,0); background-image: url('tweet_box.png'); background-color: #cce9f4; margin-left: 19px; width: 380px; " id="twt" cols="20" rows="3"></textarea>
	                
			    </div>
			    <div style="margin-left: 316px; margin-top: 8px; ">
			    	<input type="image" src="<?php echo Yii::app()->request->baseUrl;?>/images/tweet_button.png" value="tweet" onclick="tweeting()"/>
			    </div>
		    </div>		    
            <div style=" height: 200px; overflow: auto; margin-top: 44px; margin-left: 20px; margin-right: 20px;">
                <?php                    
	                $username = "MicrosoftIndia"; // <-- You did not use quotes here?! Typo?
	                $xml1 = simplexml_load_file("http://twitter.com/users/".$username.".xml");
	                $path = $xml1->profile_image_url; // <-- No $xml->user here!
	                $twitter_user = "MicrosoftIndia";
	                $twitter_url = 'https://api.twitter.com/1/statuses/user_timeline.xml?include_entities=true&include_rts=false&screen_name=MicrosoftIndia&count=100';
	                $buffer = file_get_contents($twitter_url);
	                $xml = new SimpleXMLElement($buffer);
	                
	                foreach ($xml->status as $status) {
	                	$tweet =  $status -> text;
		                $date = $status -> created_at;
		                $id = $status -> id;                          
		                $tweet = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a target='_blank' href=\"\\2\">\\2</a>", $tweet);
		                $tweet = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a target='_blank' href=\"http://\\2\">\\2</a>", $tweet);
		                $tweet = preg_replace("/@(\w+)/", "<a target='_blank' href=\"http://twitter.com/\\1\">@\\1</a>", $tweet);
		                $tweet = preg_replace("/#(\w+)/", "<a target='_blank' href=\"http://search.twitter.com/search?q=\\1\">#\\1</a>", $tweet);
		                $formatted_date = date("M jS g:i a", strtotime($date));                                         
                ?>    
                	<div>           
                    	<div style="float: left; width: 70px; height: 70px; min-height: 70px; ">
                        	<?php echo "<img style='width: 60px; height: 60px;' src='$path'/>"; ?>                    
                    	</div>
                    	<label style="color: #00bcf2; font-size: 14px; left: 10px;">
                <?php
                    		echo "<p style='height: 60px; color: #000000; font-size: 14px;' class=\"tweet\">".$tweet." <a target='_blank' style='color: #00bcf2; font-size: 14px;' href=\"http://twitter.com/".$twitter_user."/status/".$id."\">on ".$formatted_date."</a></p>";
        				echo '</label>'; 
					echo '</div>';
		            }
                ?>
                     
              
            </div>
		</div>
	<div class="clear"></div>
	</div>
</body>

</html>
