<button style="font-size: 15px !important;" onclick="install_analysis()" class="btn-danger" >
	Daily Installs Analytics
</button>
<button style="font-size: 15px !important;" onclick="like_analysis()" class="btn-danger" >
	Airtel Advantage Like Analysis
</button>
<button style="font-size: 15px !important;" onclick="invite_analysis()" class="btn-danger" >
	Invite Friend Analysis
</button>

<script>
	function install_analysis() {
		window.location = '<?php echo $this->createUrl('analytics/installAnalytics'); ?>';
	}
	function like_analysis() {
		window.location = '<?php echo $this->createUrl('analytics/likeAnalysis'); ?>';
	}
	function invite_analysis() {
		window.location = '<?php echo $this->createUrl('analytics/inviteAnalysis'); ?>';
	}
</script>