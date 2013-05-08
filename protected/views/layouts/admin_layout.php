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
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-modal.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-transition.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/mainpage.js"></script>
</head>
<body>
	<?php echo $content; ?>
</body>
</html>