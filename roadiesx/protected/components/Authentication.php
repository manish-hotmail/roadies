<?php
	require dirname(__FILE__).'/../../vendor/php-sdk/facebook.php';
	class Authentication extends CComponent {
	    public $facebook;
		public $uid;
		public $me;
	    
	    public function authenticate() {
	        $status;
	        $facebook = new Facebook(array('appId' => '500399773343892', 'secret' => '38420b125ce59c194f22668b1c59996a'));
	        $this->facebook = $facebook;
	        $uid = $facebook -> getUser();
			$access_token = $facebook->getAccessToken();
	        if ($uid) {
	            try {
	                $this->me = $facebook -> api('/me?access_token='.$access_token);
	            } catch (FacebookApiException $e) {
	                error_log($e);
	            }
	        }
	        $pram = array('scope' => 'user_likes, user_location, email', 'redirect_uri' => 'https://apps.facebook.com/roadiesprediction');
	        if ($this->me) {
	            $logoutUrl = $facebook -> getLogoutUrl();
	        } else {
	            $loginUrl = $facebook -> getLoginUrl($pram);
	        }
	        if ($this->me) {
	            $status = 'TRUE';
	        } else {
	            $status = $loginUrl;
	        	error_log($status);			
	        }
			//echo $this->me;
	        return $status;
	    }
		
		public function getMe() {
			return $this->me;
		}
		
		public function getFbPageLikes($pageId) {
			return $this->facebook->api('/me/likes/'.$pageId);
		}
		
		public function doAutoPost($args) {	
			//$facebook = new Facebook( array('appId' => '388427241238668', 'secret' => '11644b44bcfe7e666eb856d5ef868de9', 'cookie' => true, 'fileUpload' => true));	        			
			
			$result = $facebook->api("me/feed","POST",$args);
			$postid1 = '';
			foreach ($result as $key => $value) {
				$postid1=$value;
			} 
			return "<br>Photo post id = ".$postid1;
			//return $args;  	
		}
		
		public function getFbRef(){
			return $this->facebook;
		}
	}
?>