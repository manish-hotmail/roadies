<ul>
	<li>
		<a href="javascript: install_download()" >Install Count Data</a>
	</li>
	<li>
		<a href="javascript: question_download()" >Bets On Questions Daily Data</a>
	</li>
</ul>





<script>
	function install_download() {
		window.location = '<?php echo $this->createUrl("/analytics/downloadData"); ?>';
	}
	function question_download() {
		window.location = '<?php echo $this->createUrl("/analytics/getBetsOnQuestions"); ?>';
	}
</script>