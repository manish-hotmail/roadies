<script>
	var like_analysis_array = '<?php print_r($like_analysis_array); ?>';
	//alert(like_analysis_array);
	console.log(like_analysis_array);
	var parsed_like_array = JSON.parse(like_analysis_array);
	console.log(parsed_like_array);
	var new_likes_array = new Array();
	var array1 = ['Idont know', 'no chance'];
	var array_x = ['Not Liked', parseInt(parsed_like_array.rest_users)];
	var array_y = ['Already Liked', parseInt(parsed_like_array.already_likes)];
	var array_z = ['New Likes', parseInt(parsed_like_array.new_likes)];
	new_likes_array.push(array1);
	new_likes_array.push(array_x);
	new_likes_array.push(array_y);
	new_likes_array.push(array_z);
</script>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(new_likes_array);

        var options = {
          title: 'Airtel Advantage Like Analysis',
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>