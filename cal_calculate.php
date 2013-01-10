<?php
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	conn2('wellness');
	$calc_sql='select * from exercise where id='.$_REQUEST['id'];
	$calc_result=mysql_query($calc_sql);
	$calc=mysql_fetch_array($calc_result);
	$percent_time=$time/60;
	switch($weight){
	case ($weight<=130):
		$percent_weight= $weight/130;
		$calories_used=$calc['130'];
		break;
	case ($weight<=155):
		$percent_weight= $weight/155;
		$calories_used=$calc['155'];
		break;
	case ($weight<=180):
		$percent_weight= $weight/180;
		$calories_used=$calc['180'];
		break;
	case ($weight<=205):
		$percent_weight= $weight/205;
		$calories_used=$calc['205'];
		break;
	case ($weight>205):
		$percent_weight= $weight/205;
		$calories_used=$calc['205'];
		break;
	}
	$total_cals=round($percent_weight*$calories_used*$percent_time,0);
	
	echo("The total number of calories for $time minutes of ".$calc['name']." is $total_cals.");
		

?>