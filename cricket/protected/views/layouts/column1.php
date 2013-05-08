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
		<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cricket-predictions1.jpg" />
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
					C$ <span id="user_invested_amount"></span>
				</td>
				<td style="width: 16%;">
					<p>Winnings</p>
					C$ <span id="user_winnings"></span>
				</td>
				<td style="width: 17%; border: none;">
					<p>Available Cash</p>
					C$ <span id="user_available_cash"></span>
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
				array('label'=>'OPEN PREDICTIONS', 'url'=>array('/application/latestEvents')),
				array('label'=>'|'),
				array('label'=>'RESULTS', 'url'=>array('/site/completedEvents')),
				array('label'=>'|'),
				array('label'=>'MY TRANSACTIONS', 'url'=>array('/application/myBets')), 
				array('label'=>'|'),
				array('label'=>'WINNERS', 'url'=>'javascript:gotoLeaderBoardMain()'),
				array('label'=>'|'),
				array('label'=>'PRIZES', 'url'=>array('application/prizes')),          
				array('label'=>'|'),
				array('label'=>'HOW TO PLAY', 'url'=>'javascript:showFaq()'),          
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
		<table>
			<tr>
				<td id="share_with_friends" style='width: 33.3%;'>
					<table style="margin: 0px;">
						<tr>
							<td>
								<button class="view_event_btn" onclick="invite()">Invite</button>
							</td>
							<td>
								<span>Friends and get Bonus C$ 500</span>
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
                            array('label'=>'Terms and Conditions', 'url'=>array('/application/tnc')),
                            array('label'=>'|'),
							array('label'=>'Privacy Policy', 'url'=>'http://mtv.in.com/privacy-policy.html','linkOptions'=>array("target"=>"_blank")),                                       
						),                                             
			      )); ?>
				</td>				
				<td id="like_airtel_india">
					<table style="margin: 0px;">
						<tr>
							<td>
								<fb:like href="http://www.facebook.com/mtvindia" send="false" layout="button_count" width="100" height="100" show_faces="false"></fb:like>
							</td>
							<td>
								<span>MTV India PAGE TO GET BONUS C$ 1000</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
		<img style="float: right;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/lmw.png" />
		<label style="float: left; color: white; " >
			Any Questions? Mail us at <a href="mailto:cricketpredictions@mtvindia.com" >cricketpredictions@mtvindia.com</a>
		</label>
	</div>
</div>
<div id="faq_popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	    <p><h2 style="font-size: 20px; font-weight: bold;" >How to Play</h2></p>
	  </div>
	  <div class="modal-body">	  
	  	<p>  
	    	1.    You get C$10,000 (virtual money) in your account on joining the game.
	    </p>
	    <p>
	    	2.    Pick match events and questions that are open for predictions.
	    </p>
	    <p>
	    	3.    Place your virtual cricket cash (C$) on the outcome/s you predict.
	    </p>
	    <p>
	    	4.    If your predictions turn out right, you earn more C$ based on the final odds, else the amount is deducted from your total. Your account will be updated once the results are declared and event is closed.
	    </p>	
	    <p>
	    	5.    You can invest a maximum of C$1000 per question.
	    </p>
	    <p>6.    Earn bonus C$:</p>
	    <br>
	    <p>
	    	a.    Get a bonus of C$500 for each friend you invite. This will be transferred to your account when your friend makes his/her first prediction.
	    </p>
	    <p>
	    	b.    Visit Cricket Predictions every day to collect your C$500 daily bonus
	    </p>
	    <p>
	    	7.    Predict every day and earn as much C$ you can by investing and your virtual cash wisely to top the leader board and win!
	    </p>
	    <p><b>Here are some quick definitions to help you -</b></p>
	    <p><b>C$</b></p>
	    <p>
	    	C$ or Cricket Cash is virtual money used for transactions specifically for MTV Cricket Predictions.
	    </p>
	    <p>
	    	<b>Odds</b>
	    </p>
	    <p>
	    	The percentage value of the probability a given prediction will come true. Odds indicate the C$'s that you will win in return for each C$ you placed if your prediction comes true. Odds in the game may vary while the prediction is open.
	    </p>
	    <p>
	    	<b>Total Pot</b>
	    </p>
	    <p>
	    	The total amount that has been invested in a particular event by everyone.
	    </p>
	    <p>
	    	<b>Leaderboard</b>
	    </p>
	    <p>
	    	The leaderboard displays the rankings of all users of MTV Cricket Predictions ordered by the Available Cash.
	    </p>
	  </div>
	</div>
<?php $this->endContent(); ?>