<script>	
	var  install_array = '<?php echo $user_install_array; ?>';
	var parsed_array = JSON.parse(install_array);
	console.log(parsed_array);
	var newarray = new Array();
	var array1 = ['Date', 'Installation'];
	newarray.push(array1);
	//newarray.push(array2);newarray.push(array3);newarray.push(array4);
	for (var i=0; i < parsed_array.length; i++) {
	  //console.log(parsed_array[i].date);
	  var array_x = new Array();
	  array_x = [parsed_array[i].date, parseInt(parsed_array[i].install_count)];
	  newarray.push(array_x);
	};
	//console.log(JSON.parse(instalinstall_countl_array));	
</script>


<?php
	

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(newarray);

        var options = {
          title: 'New Installed Daily'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>