<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div style="background-color: #fff; width: 760px; margin: 0 auto;">
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
	    <h3 style="color: #9e0000 !important; font-size: 24px; font-weight: bold;"> Enter your Roadies Store Order id below to earn bonus Roadies Dollars.</h3>	    
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
				array('label'=>'MY TRANSACTIONS', 'url'=>array('/application/myBets')), 
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
	
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->

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
		<label style="float: left; color: white; " >
			Any Questions? Mail us at <a href="mailto:roadies@mtvindia.com" >roadies@mtvindia.com</a>
		</label>
	</div>
</div>
<div id="faq_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <p><h2 style="font-size: 20px; font-weight: bold;" >FAQ</h2></p>
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
<?php $this->endContent(); ?>