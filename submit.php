<?
session_start();
if (!isset($_SESSION['eid']))
	header("location:login_form.php");
	
	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');
	$eid=$_SESSION['eid'];
	$date=date('Y-m-d');

	if($table=='fitness_test')
		$sql="insert into $table (`eid`,`pushups`,`situps`,`mile_time`,`type`,`timestamp`) values  ('$eid','".$_GET[pups]."','".$_GET[sups]."','".$_GET[mile]."','".$_GET[type]."','$date')";
	
	else if(($table=='wellness_log')&&($exercise!='')){
		$sql="insert into $table (`eid`,`date`,`exercise`,`duration`,`challenge`) values  ('$eid','".$_GET['date']."','".$_GET[exercise]."','".$_GET[duration]."','".$_GET[challenge]."')";	
		
		$calc_sql='select * from exercise where id='.$_GET[exercise];
		$calc_result=mysql_query($calc_sql);
		$calc=mysql_fetch_array($calc_result);
		$percent_time=$_GET[duration]/60;
		$weight=$_GET['weight'];
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
		
		$sql1="insert into weight_tracking (`eid`,`date`,`weight`) values  ('$eid','".$_GET['date']."','".$weight."')";	
		@mysql_query($sql1);
		$_SESSION['weight']=$weight;
		
		if($_GET['fav']==true)
			mysql_query("insert into favorites (`eid`,`id`,`table`) values ('$eid','".$_GET[exercise]."','exercise')");
		
		
		$sql2="insert into calorie_tracker (`eid`,`date`,`calories`) values  ('$eid','".$_GET['date']."','-".$total_cals."')";	
		@mysql_query($sql2);
	
	}
	else if(($table=='wellness_log')&&($new_exer!='')){
		$weight=$_GET['weight'];
		$cal1=round((130/$weight)*$_GET['calories']);
		$cal2=round((155/$weight)*$_GET['calories']);
		$cal3=round((180/$weight)*$_GET['calories']);
		$cal4=round((205/$weight)*$_GET['calories']);
		
		$sql1="insert into exercise (`name`,`130`,`155`,`180`,`205`) values  ('".$_GET[new_exer]."','$cal1','$cal2','$cal3','$cal4')";
		@mysql_query($sql1);
		
		$calc_sql='select * from exercise where name="'.$_GET[new_exer].'"';
		$calc_result=mysql_query($calc_sql);
		$calc=mysql_fetch_array($calc_result);		
		
		$sql="insert into $table (`eid`,`date`,`exercise`,`duration`,`challenge`) values  ('$eid','".$_GET['date']."','".$calc[id]."','".$_GET[duration]."','".$_GET[challenge]."')";	
		
		if($_GET['fav']==true)
			mysql_query("insert into favorites (`eid`,`id`,`table`) values ('$eid','".$calc[id]."','exercise')");

		$percent_time=$_GET[duration]/60;
		
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
		
		$sql1="insert into weight_tracking (`eid`,`date`,`weight`) values  ('$eid','".$_GET['date']."','".$weight."')";	
		@mysql_query($sql1);
		$_SESSION['weight']=$weight;
		
		$sql2="insert into calorie_tracker (`eid`,`date`,`calories`) values  ('$eid','".$_GET['date']."','-".$total_cals."')";	
		@mysql_query($sql2);

	}


	else if(($table=='wellness_log')&&($_GET['select_food']!='')){
		$sql="insert into $table (`eid`,`date`,`food`,`servings`,`meal`,`challenge`) values  ('$eid','".$_GET['date']."','".$_GET['select_food']."','".$_GET['servings']."','".$_GET['selected_meal']."','".$_GET['challenge']."')";	
		$calc_sql='select * from diet where id='.$_GET['select_food'];
		$calc_result=mysql_query($calc_sql);
		$calc=mysql_fetch_array($calc_result);
		$total_cals=$total_cals=round($calc['calories']*$_GET['servings'],0);		

		if($_GET['fav']==true)
			mysql_query("insert into favorites (`eid`,`id`,`table`) values ('$eid','".$calc[id]."','diet')");
		
		$sql2="insert into calorie_tracker (`eid`,`date`,`calories`) values  ('$eid','".$_GET['date']."','".$total_cals."')";	
		@mysql_query($sql2);
		//echo $sql;
		//$result=@mysql_query($sql);
		header("location:get_diet.php?date=".$_GET[date]."&id=".$_GET['challenge']);
	}
	
	else if(($table=='wellness_log')&&($food!='')){
		$sql="insert into $table (`eid`,`date`,`food`,`servings`,`meal`,`challenge`) values  ('$eid','".$_GET['date']."','".$_GET[food]."','".$_GET['servings']."','".$_GET['meal']."','".$_GET['challenge']."')";	
		$calc_sql='select * from diet where id='.$_GET[food];
		$calc_result=mysql_query($calc_sql);
		$calc=mysql_fetch_array($calc_result);
		$total_cals=$total_cals=round($calc['calories']*$_GET['servings'],0);		
		$sql2="insert into calorie_tracker (`eid`,`date`,`calories`) values  ('$eid','".$_GET['date']."','".$total_cals."')";	
		@mysql_query($sql2);
		
		if($_GET['fav']==true)
			mysql_query("insert into favorites (`eid`,`id`,`table`) values ('$eid','".$calc[id]."','diet')");
	}
	else if(($table=='wellness_log')&&($new_food!='')){
		
		$sql1="insert into diet (`name`,`serving_size`,`fat`,`calories`,`saturated_fat`,`carbohydrates`) values  ('".$_GET['new_food']."','".$_GET['s_size']."','".$_GET['fat']."','".$_GET['calories']."','".$_GET['s_fat']."','".$_GET['carbs']."')";	
		@mysql_query($sql1);
		$food_id=@mysql_result(mysql_query("select id from diet where name='".$_GET['new_food']."' and calories ='".$_GET['calories']."'"),0);
		//echo ("select id from diet where name='".$_GET['new_food']."' and calories ='".$_GET['calories']."'");
		 $sql="insert into $table (`eid`,`date`,`food`,`servings`,`meal`,`challenge`) values  ('$eid','".$_GET['date']."','".$food_id."','".$_GET['servings']."','".$_GET['meal']."','".$_GET['challenge']."')";
		$total_cals=$total_cals=round($_GET['calories']*$_GET['servings'],0);		
		$sql2="insert into calorie_tracker (`eid`,`date`,`calories`) values  ('$eid','".$_GET['date']."','".$total_cals."')";	
		@mysql_query($sql2);
		
		if($_GET['fav']==true)
			mysql_query("insert into favorites (`eid`,`id`,`table`) values ('$eid','".$food_id."','diet')");
	}
	else if(($table=='wellness_log')&&($id!='')){
		$sql="delete from $table where id=".$id;
		$get_info="select * from $table where id=".$id;
		$get_info_results=@mysql_query($get_info);
		while($rows=@mysql_fetch_array($get_info_results)){
			if($rows[exercise]!=''){
				$calc_sql='select * from exercise where id='.$rows[exercise];
				$calc_result=mysql_query($calc_sql);
				$calc=mysql_fetch_array($calc_result);
				$percent_time=$rows[duration]/60;
				$weight=$_SESSION['weight'];
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
				$sql2='delete from calorie_tracker where eid="'.$_SESSION[eid].'" and calories="-'.$total_cals.'" and date ="'.$rows[date].'"';	
			}
			else if($rows[food]!=''){
				$calc_sql='select * from diet where id='.$rows[food];
				$calc_result=mysql_query($calc_sql);
				$calc=mysql_fetch_array($calc_result);
				$total_cals=$total_cals=round($calc['calories']*$rows['servings'],0);		
				$sql2='delete from calorie_tracker where eid="'.$_SESSION[eid].'" and calories="'.$total_cals.'" and date ="'.$rows[date].'"';	
			}
		}
			//mail('tauni.daub@domain.com','Query2',$sql2);
			@mysql_query($sql2);

			
	}

		//mail('tauni.daub@domain.com','Query1',$sql);
		$result=@mysql_query($sql);
		//echo $sql;
		//echo $sql2;
		echo 1;
	
?>