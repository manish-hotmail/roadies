<?php
	$option = $_POST['option'];
	$hostname = 'localhost';
	$dbname = 'harisadu';
	$username = 'root';
	$password = 'LMWadmin12345';
	$con = mysql_connect($hostname, $username, $password);
	if (!$con) {
		die('Unable to connect to the database: ' . mysql_error());
	}
	$dataArray = array();
	mysql_select_db($dbname, $con);
	$result = mysql_query("SELECT * FROM heroine_participants_entries where status='".$option."' order by create_date desc");
	$i = 0;
	while ($row = mysql_fetch_array($result)) {
		$data = array();	
		$data['id']='img'.$i;
		$data['pid']=$row['pid'];
		$data['path']=$row['img1'];
		$data['path1']=$row['img2'];
		$data['path2']=$row['img3'];
		$data['date']=$row['create_date'];
		$data['name']=$row['name'];
		$data['sname'] = $row['sname'];
		$data['contact']=$row['contact'];
		$data['email']=$row['email'];
		$data['linkProfile']="https://www.facebook.com/".$row['uid'];
		$data['uid']=$row['uid'];
		$data['address'] = $row['address'];
		$data['billno'] = $row['billno'];
		$result_location = mysql_query("SELECT * FROM city_info where id='".$row['city']."'");
		while ($row_loc =  mysql_fetch_array($result_location)) {
			$data['city'] = $row_loc['city_name'];
		}
		$result_store = mysql_query("SELECT * FROM location_info where city_id='".$row['city']."'");
		$cnt = 0;
		while ($row_store =  mysql_fetch_array($result_store)) {							
			$cnt++;	
			if($cnt == $row['loc']){
				$data['store'] = $row_store['location_name'];
			}			
		}
		array_push($dataArray, $data);
		$i++;
	}
	echo json_encode($dataArray);
?>