
<script>
	var array1 = ['Idont know', 'no chance'];
	var invite_analysis_array = new Array();
	var total_invites = '<?php echo $total_invites; ?>';
	var accepted = '<?php echo $invites_accepted; ?>';
	//alert(total_invites);
	//alert(accepted);
	var arrayx = ['Invites Not Accepted', parseInt(total_invites)];
	var arrayy = ['Invites Accepted', parseInt(accepted)];
	invite_analysis_array.push(array1);
	invite_analysis_array.push(arrayx);
	invite_analysis_array.push(arrayy);
</script>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(invite_analysis_array);

        var options = {
          title: 'Invite Friend Analysis',
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