<html>
	<head>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jsimple-slider.js"></script>
		<style>
			.imgDiv {
				position: absolute;
				top: 100px;
				left: 0px;
				width: 120px;
				height: 400px;
				border: 1px solid black;
			}
			#img1 {
				background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/van.jpg') 0 0;
				opacity: 0;
			}
			#img2 {
				background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/van.jpg') 120px 0;
				opacity: 0;
			}
			#img3 {
				background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/van.jpg') 240px 0;
				opacity: 0;
			}
			#img4 {
				background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/van.jpg') 360px 0;
				opacity: 0;
			}
			#img5 {
				background: url('<?php echo Yii::app()->request->baseUrl; ?>/images/van.jpg') 480px 0;
				opacity: 0;
			}
			.slider {
				width: 250px;
			}
			#sliders div {
				margin-top: 40px;
			}
		</style>
		<script>
			var value1;
			var value2;
			var value3;
			var value4;
			var value5;
			 $(document).ready(function() {
			    $(".slider").slider({animate: true, min: 0, max: 100, step: 1, value: 0, slide: function( event, ui ) {
				//$( "#amount" ).val( "$" + ui.value );
				// //alert('hi')
					// valueNum = parseInt($( "#range3" ).slider( "option", "value" ));
					// alert($( "#range3" ).slider( "option", "value" ));
					value1 = parseInt($( "#range1" ).slider( "option", "value" ));
					value2 = parseInt($( "#range2" ).slider( "option", "value" ));
					value3 = parseInt($( "#range3" ).slider( "option", "value" ));
					value4 = parseInt($( "#range4" ).slider( "option", "value" ));
					value5 = parseInt($( "#range5" ).slider( "option", "value" ));
					var totalRange = value1 + value2 + value3 + value4 + value5;
					if(totalRange > 100) {
						alert('going above 100!!');
						document.getElementById('img' + num).style.opacity = (valueNum - (totalRange - 100))/100;
					}
				} });
			  });
			  
			  $( ".slider" ).on( "slidechange", function( event, ui ) {
			  	alert('hi');
			  } );
		
		function setFinaly(num) {
			valueNum = parseInt(document.getElementById('range' + num).value);
			value1 = parseInt(document.getElementById('range1').value);
			value2 = parseInt(document.getElementById('range2').value);
			value3 = parseInt(document.getElementById('range3').value);
			value4 = parseInt(document.getElementById('range4').value);
			value5 = parseInt(document.getElementById('range5').value);
			var totalRange = value1 + value2 + value3 + value4 + value5;
			if(totalRange > 100) {
				
				//alert(totalRange)
				document.getElementById('range' + num).value = valueNum - (totalRange - 100); 
				document.getElementById('img' + num).style.opacity = (valueNum - (totalRange - 100))/100;
				alert("can't exceed 100!!!!!!");
			}
			document.getElementById('img' + num).style.opacity = (document.getElementById('range' + num).value)/100;
		}
		</script>
		
	</head>
	
	<body>
		<div class="imgDiv" id="img1"></div>
		<div class="imgDiv" id="img2"></div>
		<div class="imgDiv" id="img3"></div>
		<div class="imgDiv" id="img4"></div>
		<div class="imgDiv" id="img5"></div>
		<div id="sliders" >
			<div class="slider" id="range1"></div>
			<div class="slider" id="range2"></div>
			<div class="slider" id="range3"></div>
			<div class="slider" id="range4"></div>
			<div class="slider" id="range5"></div>
		</div>
	</body>
</html>