<div style="height: 745px; width: 760px; margin: 0 auto; background: url(<?php echo Yii::app()->request->baseUrl; ?>/images/cricket-predictions-opening2.jpg);" >
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fb-connect.jpg" style="position: relative; margin: 0 auto; cursor: pointer; top: 33%; left: 14%;" onclick="authenticate()"/>
</div>

<script language="JavaScript">
function authenticate(){
top.location.href = "<?php echo $status; ?>";
}
</script>