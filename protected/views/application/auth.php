<div style="height: 745px; width: 760px; margin: 0 auto; background: url(<?php echo Yii::app()->request->baseUrl; ?>/images/fbconnect-bg.jpg);" >
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fb-connect.jpg" style="position: relative; margin: 0 auto; cursor: pointer; top: 20%; left: 35%;" onclick="authenticate()"/>
</div>

<script language="JavaScript">
function authenticate(){
top.location.href = "<?php echo $status; ?>";
}
</script>