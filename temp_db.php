<?php
mysql_connect("localhost","root","LMWadmin12345");
mysql_select_db("MTVbetting");
$query = "select * from transaction_temp";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	$i++;
	$id = $row['id'];
	$user_id = $row['user_id'];
	$transaction_type = $row['transaction_type'];
	$amount = $row['amount'];
	$ques_id = $row['question_id'];
	$option_id = $row['option_id'];
	$event_id = $row['event_id'];
	$sub_query = "select * from questions where id=$ques_id";
	$sub_result = mysql_query($sub_query);
	while($arr=mysql_fetch_array($sub_result)){
		//$i++;
		$q_date = $arr['end_time'];
		$new_q_date = date('Y-m-d H:i:s', strtotime($q_date . ' + 6 hours'));
	}
	//echo $id." ".$user_id." ".$transaction_type." ".$amount." ".$ques_id." ".$option_id." ".$event_id." ".$new_q_date."<br/>";
	mysql_query("insert into transaction(user_id,transaction_type,amount,question_id,option_id,event_id,create_time) values('$user_id','$transaction_type','$amount','$ques_id','$option_id','$event_id','$new_q_date')");
}
echo $i;
?>