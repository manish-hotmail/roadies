

<?php
   $con = mysql_connect('localhost', 'root', 'LMWadmin12345');
   mysql_select_db('MTVbetting', $con);
   $question_id = $_GET['qid'];
   //echo $question_id;
   $query = "select * from options where question_id=" . $question_id;
   $result = mysql_query($query);
   $arr = array();
   $odds = array();
   $sum = 0;
   while ($row = mysql_fetch_array($result)) {
   	//echo $sum;
       $sum += $row['total_pot'];
	   $arr['option'][] = $row['id'];
	   $arr['total_pot'][] = $row['total_pot'];
   }
   $i = 0;
   while ($i < count($arr['option'])) {
       $op = $arr['option'][$i];
	   
	   $arr['odd'][] =  $sum / $arr['total_pot'][$i];
	   $odd = $arr['odd'][$i];
	   $i++;
	   //$query = "insert into question_temp values(".$arr['option'][$i].", ".$question_id, 0, $arr['odd'][$i])";
	   $query = "insert into question_temp values('$op','$question_id','0','$odd')";
	   mysql_query($query);
   }
   print_r($arr);
   $query = ""
   
?>