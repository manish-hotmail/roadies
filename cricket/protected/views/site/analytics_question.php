<?php

	//print_r($bets);

?>

<script>	
	var  install_array = '<?php echo $bets; ?>';
	var parsed_array = JSON.parse(install_array);
	console.log(parsed_array);
	var newarray = new Array();
	var array1 = ['Question', 'Bet Count'];
	newarray.push(array1);
	//newarray.push(array2);newarray.push(array3);newarray.push(array4);
	for (var i=0; i < parsed_array.length; i++) {
	  //console.log(parsed_array[i].date);
	  var array_x = new Array();
	  array_x = [parsed_array[i].date, parseInt(parsed_array[i].bet_count)];
	  newarray.push(array_x);
	};
	//console.log(JSON.parse(instalinstall_countl_array));	
</script>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(newarray);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Question No.',},
          vAxis: {title: 'Bet Count'},
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; overflow: hidden;  height: 175px;"></div>
  </body>
</html>