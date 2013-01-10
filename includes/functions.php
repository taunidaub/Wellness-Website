<?PHP

function conn($dbname) {
require 'constants.php';
if (!$db = @mysql_pconnect($dbHost, $dbUser, $dbPass)) { die("<strong>MySQL Connection failed:</strong> $dbUser:$dbPass@$dbHost"); }
        mysql_select_db($dbname, $db) OR die("<strong>MySQL database selection error:</strong> $dbname");
}

function q($sql) {
	if ($_SESSION['debug']) { echo $sql; }
	$query = mysql_query($sql) OR die("<strong>MySQL query error:</strong> $sql<br />\n" . mysql_error());
	return $query;
}

function qe($sql) {
	if ($_SESSION['debug']) { echo $sql; }
	$query = @mysql_query($sql);
	return $query;
}

function qrow($sql) {
	if ($_SESSION['debug']) { echo $sql; }
	$query = q($sql);
	$row = mysql_fetch_assoc($query) OR die("<strong>MySQL query error:</strong> <br />\n" . mysql_error());
	return $row;
}

function qrowe($sql) {
	if ($_SESSION['debug']) { echo $sql; }
	$query = q($sql);
	return mysql_fetch_assoc($query);
}

function get_challenge_week($date){
	$check_dates='select * from challenge_timelines where start <="'.$date.'" and end>="'.$date.'" and challenge="Wellness Log"';
	$date_result=@mysql_query($check_dates);
	if(@mysql_num_rows($date_result)>0)
		while($row=mysql_fetch_array($date_result)){
			$send['week_start']=$row['start'];
			$send['week_end']=$row['end'];
			$send['week']=$row['week'];
		}
	return($send);
}
	
function get_meal_log($eid){
	$tblheader='';
	$tblbody='';
	$wc_weeks_array=array(11,12,13,14,15,16,17,18,19);
	$shown=0;
	for($x=0;$x<count($wc_weeks_array);$x++){
		$tblheader='';
		$tblbody='';
		$summary='select distinct date from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$wc_weeks_array[$x].' order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			if($shown==0){ ?>
				<h4 class="title_blue_a" onClick="javascript:show_div('meals');">> Meal Summary</h4>
				<div id="meals" style="display:none">
				
		<?php 	$shown=1;
				} ?>

			<h4 class='title_green_a' onClick="javascript:show_div('week<?php echo $x ?>');">>Show Week <?php echo ($x+1) ?>
			</h4>			
			<div id='week<?php echo $x ?>' style='display:none'>
			<table width='100%'>
			
			<?php
			while ($wellness=mysql_fetch_array($results)){
			
				$temp=explode("-",$wellness['date']);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				$tblheader.= "<th>".$display_date."</th>";
	
				$meal_summary='select * from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$wc_weeks_array[$x].' and date = "'.$wellness['date'].'" order by meal asc';
				//echo $meal_summary;
				$meal_results=@mysql_query($meal_summary) or die (mysql_error()."<br>".$meal_summary);
				if(@mysql_num_rows($meal_results)>0){
					$old_meal='';
					$tblbody.="<td valign='top'>";
					while ($menu=mysql_fetch_array($meal_results)){
						if($menu[meal]!=$old_meal)
							$tblbody.= "<strong>".strtoupper($menu[meal]).":</strong><br>";
							
						$food_item="select name from diet where id='".$menu[food]."'";
						$food_name=mysql_result(mysql_query($food_item),0,0);
						if($menu[servings]>1)
							$plu='s';
						else 
							$plu="";
					
						$tblbody.= $menu[servings]." serving".$plu." of ".$food_name."<br>";
						$old_meal=$menu[meal];
					} 
				$tblbody.="</td>";
				}
			}
			echo "<tr>";	
			echo $tblheader;	
			echo "</tr>";	
			echo "<tr>";	
			echo $tblbody;
			echo "</tr>";
						
		?>
			</table>
			</div>			
	<?php 		
	
		} 
		if($x==count($wc_weeks_array)-1)
		echo "</div>";

	} 
}

function get_activity_log($eid){
	$tblheader='';
	$tblbody='';
	$shown=0;
	$wc_weeks_array=array(11,12,13,14,15,16,17,18,19);
	for($x=0;$x<count($wc_weeks_array);$x++){
		$summary='select distinct date from wellness_log where eid="'.$eid.'" and exercise !="" and challenge='.$wc_weeks_array[$x].' order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			if($shown==0){ ?>
				<h4 class="title_blue_a" onClick="javascript:show_div('exercise');">> Activity Summary</h4>
				<div id="exercise" style="display:none">
		<?php 	$shown=1;
				} ?>
			<h4 class='title_green_a' onClick="javascript:show_div('eweek<?php echo $x ?>');">>Show Week <?php echo ($x+1) ?></h4>			
			<div id='eweek<?php echo $x ?>' style='display:none'>			
			<?php
	
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness['date']);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				$tblheader.= "<th>".$display_date."</th>";
	
				$exercise_summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge='.$wc_weeks_array[$x].' and date = "'.$wellness['date'].'" order by exercise asc';
				//echo $exercise_summary;
				$exercise_results=@mysql_query($exercise_summary) or die (mysql_error()."<br>".exercise_summary);
				if(@mysql_num_rows($exercise_results)>0){
					$tblbody.="<td valign='top'>";
					while ($exer=mysql_fetch_array($exercise_results)){					
						$exer_item="select name from exercise where id='".$exer[exercise]."'";
						$exer_name=mysql_result(mysql_query($exer_item),0,0);
						$tblbody.= $exer_name." for ".$exer[duration]." minutes<br><br>";
							
					} 
					$tblbody.="</td>";
				}
			}
			echo "<table width='100%'><tr>";	
			echo $tblheader;	
			echo "</tr>";	
			echo "<tr>";	
			echo $tblbody;
			echo "</tr></table>";
						
			?>
			</div>			
	<?php }
		if($x==count($wc_weeks_array)-1)
		echo "</div>";
	}

}


function get_food_log($eid){
	$tblheader='';
	$tblbody='';
	$wc_weeks_array=array(31,32,33,34,35,36,37,38);
	$shown=0;
	for($x=0;$x<count($wc_weeks_array);$x++){
		$summary='select distinct date from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$wc_weeks_array[$x].' order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			if($shown==0){ ?>
				<h4 class="title_blue_a" onClick="javascript:show_div('meals');">> Food Log</h4>
				<div id="meals" style="display:none">
		<?php 	$shown=1;
				} ?>

			<h4 class='title_green_a' onClick="javascript:show_div('week<?php echo $x ?>');">>Show Week <?php echo ($x+1) ?>
			</h4>			
			<div id='week<?php echo $x ?>' style='display:none'>
			<table width='100%'>
			
			<?php
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness['date']);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				$tblheader.= "<th>".$display_date."</th>";
	
				$meal_summary='select * from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$wc_weeks_array[$x].' and date = "'.$wellness['date'].'" order by meal asc';
				//echo $meal_summary;
				$meal_results=@mysql_query($meal_summary) or die (mysql_error()."<br>".$meal_summary);
				if(@mysql_num_rows($meal_results)>0){
					$old_meal='';
					$tblbody.="<td valign='top'>";
					while ($menu=mysql_fetch_array($meal_results)){
						if($menu[meal]!=$old_meal)
							$tblbody.= "<strong>".strtoupper($menu[meal]).":</strong><br>";
							
						$food_item="select name from diet where id='".$menu[food]."'";
						$food_name=mysql_result(mysql_query($food_item),0,0);
						if($menu[servings]>1)
							$plu='s';
						else 
							$plu="";
					
						$tblbody.= $menu[servings]." serving".$plu." of ".$food_name."<br>";
						$old_meal=$menu[meal];
					} 
				$tblbody.="</td>";
				}
			
		
			}
			echo "<tr>";	
			echo $tblheader;	
			echo "</tr>";	
			echo "<tr>";	
			echo $tblbody;
			echo "</tr>";
						
		?>
			</table>
			</div>			
	<?php
	 	if($x==count($wc_weeks_array)-1)
		echo "</div>";
		} 
			
	} 
}

function get_exercise_log($eid){
	$tblheader='';
	$tblbody='';
	$shown=0;
	$wc_weeks_array=array(11,12,13,14,15,16,17,18,19);
	for($x=0;$x<count($wc_weeks_array);$x++){
		$summary='select distinct date from wellness_log where eid="'.$eid.'" and exercise !="" and challenge='.$wc_weeks_array[$x].' order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			if($shown==0){ ?>
				<h4 class="title_blue_a" onClick="javascript:show_div('exercise');">> Exercise Log Summary</h4>
				<div id="exercise" style="display:none">
				<?php 	$shown=1;
				} //if($shown==0 ){  
				?>
			<h4 class='title_green_a' onClick="javascript:show_div('eweek<?php echo $x ?>');">>Show Week <?php echo ($x+1) ?></h4>			
			<div id='eweek<?php echo $x ?>' style='display:none'>			
			<?php
	
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness['date']);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				$tblheader.= "<th>".$display_date."</th>";
	
				$exercise_summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge='.$wc_weeks_array[$x].' and date = "'.$wellness['date'].'" order by exercise asc';
				//echo $exercise_summary;
				$exercise_results=@mysql_query($exercise_summary) or die (mysql_error()."<br>".exercise_summary);
				if(@mysql_num_rows($exercise_results)>0){
					$tblbody.="<td valign='top'>";
					while ($exer=mysql_fetch_array($exercise_results)){					
						$exer_item="select name from exercise where id='".$exer[exercise]."'";
						$exer_name=mysql_result(mysql_query($exer_item),0,0);
						$tblbody.= $exer_name." for ".$exer[duration]." minutes<br><br>";
							
					} //while ($exer=mysql_fetch_array($exercise_results)){	
					$tblbody.="</td>";
				} //if(@mysql_num_rows($exercise_results)>0){
			} //while ($wellness=mysql_fetch_array($results)){
			echo "<table width='100%'><tr>";	
			echo $tblheader;	
			echo "</tr>";	
			echo "<tr>";	
			echo $tblbody;
			echo "</tr></table>";
						
			?>
			</div>			
	<?php 	
			if($x==count($wc_weeks_array)-1)
			echo "</div>";
		} //if(@mysql_num_rows($results)>0){
	}//for($x=0;$x<count($wc_weeks_array);$x++){
}
	
function get_rswc_log($eid){
	$tblheader='';
	$tblbody='';

	$summary='select * from rswc where eid="'.$eid.'" order by day desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
		?>
		<h4 class="title_blue_a" onClick="javascript:show_div('rswc');">> Ready, Set, Walk Challenge Summary</h4>
		<div id="rswc" style="display:none">
		<?php
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[day]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					echo "<span class='title_green_a'>".$display_date.":</span> ". $wellness[steps]." steps<br>";
			
			} ?>	
		</div>
		<?php
	 } 
}

function exercise_challenge($eid){
	$tblheader='';
	$tblbody='';
	$shown=0;
	$wc_weeks_array=array(21,5);
	for($x=0;$x<count($wc_weeks_array);$x++){
		$summary='select distinct date from wellness_log where eid="'.$eid.'" and exercise !="" and challenge='.$wc_weeks_array[$x].' order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			if($shown==0){ ?>
				<h4 class="title_blue_a" onClick="javascript:show_div('els');">> Exercise Challenge Summary</h4>
				<div id="els" style="display:none">
			<?php $shown=1;
			}  ?>
			<h4 class='title_green_a' onClick="javascript:show_div('elweek<?php echo $x ?>');">>Show Week <?php echo ($x+1) ?></h4>			
			<div id='elweek<?php echo $x ?>' style='display:none'>
			<table width='100%'>
			
			<?php
			$div=0;

			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness['date']);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				$tblheader.= "<th>".$display_date."</th>";

				$exercise_summary='select * from wellness_log where eid="'.$eid.'" and exercise !="" and challenge='.$wc_weeks_array[$x].' and date = "'.$wellness['date'].'" order by meal asc';
				//echo $meal_summary;
				$exercise_results=@mysql_query($exercise_summary) or die (mysql_error()."<br>".exercise_summary);
				if(@mysql_num_rows($exercise_results)>0){
					$tblbody.="<td valign='top'>";
					while ($exer=mysql_fetch_array($exercise_results)){					
						$exer_item="select name from exercise where id='".$exer[exercise]."'";
						$exer_name=mysql_result(mysql_query($exer_item),0,0);
						$tblbody.= $exer_name." for ".$exer[duration]." minutes<br><br>";
							
					} 
				$tblbody.="</td>";
				}
			}
			echo "<tr>";	
			echo $tblheader;	
			echo "</tr>";	
			echo "<tr>";	
			echo $tblbody;
			echo "</tr>";
						
			?>
			</table>
			</div>			
		<?php 
		 //if($x==count($wc_weeks_array)-1)
			
		}
	} echo "</div>";
}

function calorie_counts($eid){
	$tblheader='';
	$tblbody='';	
	$shown=0;
	$wc_weeks_array=array(11,12,13,14,15,16,17,18,19);
	for($x=0;$x<count($wc_weeks_array);$x++){
		$week='select start, end, week from challenge_timelines where id ='.$wc_weeks_array[$x];
		$week_results=@mysql_query($week);
		$tblheader= "";
		$tblbody1= "";
		$tblbody2= "";
		$tblheader.= "<th>Type</th>";
		$tblbody1.= "<td><strong>Consumed: </strong></td>";
		$tblbody2.= "<td><strong>Burned: </strong></td>";

		if(@mysql_num_rows($week_results)>0){
			while ($weeks=mysql_fetch_array($week_results)){
				$summary='select * from calorie_tracker where eid="'.$eid.'" and date <="'.$weeks['end'].'" and date >="'.$weeks['start'].'" order by date asc';
				//echo $summary;
				$results=@mysql_query($summary);
				if(@mysql_num_rows($results)>0){
					if($shown==0){?>
						<h4 class="title_blue_a" onClick="javascript:show_div('cal');">> Calorie Summary</h4>
						<div id="cal" style="display:none">
						
						<?php
						$shown=1;
					}
					$old_date='';
					$total_food_cals=0;
					$total_exer_cals=0;
					while ($cal=mysql_fetch_array($results)){
						$temp=explode("-",$cal[date]);		
						$display_date=$temp[1]."/".	$temp[2];	
						if($display_date!=$old_date){
							$tblheader.= "<th align='center'><h4 class='title_red'>$display_date</h4></th>";
							if($total_food_cals!=0)
								$tblbody1.= "<td align='center'>".$total_food_cals."&nbsp;</td>";	
							if($total_exer_cals!=0)
								$tblbody2.=  "<td align='center'>".$total_exer_cals."&nbsp;</td>";	
							$total_food_cals=0;
							$total_exer_cals=0;
							}
							
						$current_cals=$cal['calories'];
						if($current_cals>0)
								$total_food_cals=$total_food_cals+$current_cals;
						if($current_cals<0)
								$total_exer_cals=$total_exer_cals+$current_cals;
												
						$old_date=$display_date;
					}
					
				echo "<h4 class='title_green_a' onClick=\"javascript:show_div('cweek".$x."');\">Show Week ".($x+1)."</h4>";
				echo "<div id='cweek".$x."' style='display:none'>";
				echo "<table border='1' cellpadding='6'>";
				echo "<tr>".$tblheader."<tr>";
				echo "<tr>".$tblbody1."<tr>";
				echo "<tr>".$tblbody2."<tr>";
				echo "</table></div>";
				}				
			}
			if($x==count($wc_weeks_array)-1)
				echo "</div>";
		
		}
	}
}

function goal_summary($eid){
	$tblheader='';
	$tblbody='';	
	$shown=0;
	$wc_weeks_array=array(11,12,13,14,15,16,17,18,19);
	for($x=0;$x<count($wc_weeks_array);$x++){
		$week='select start, end, week from challenge_timelines where id ='.$wc_weeks_array[$x];
		$week_results=@mysql_query($week);
		if(@mysql_num_rows($week_results)>0){
			while ($weeks=mysql_fetch_array($week_results)){
				$summary='select * from goals where eid="'.$eid.'" and set_date <="'.$weeks['end'].'" and set_date >="'.$weeks['start'].'" order by set_date asc';
				$results=@mysql_query($summary);
				if(@mysql_num_rows($results)>0){
					if($shown==0){
						?>
						<h4 class="title_blue_a" onClick="javascript:show_div('goals');">> Goal Summary</h4>
						<div id="goals" style="display:none">
					<?php $shown=1;
					}
					
					while ($wellness=mysql_fetch_array($results)){
						$temp=explode("-",$wellness[set_date]);		
						$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
						?>
						<h4 class='title_green'>>Week <?php echo ($x+1) ?> Goals</h4>			
						<?php
						$goal_item="select challenge from challenge_timelines where id='".$wellness[challenge_id]."'";
						$goal_name=@mysql_result(@mysql_query($goal_item),0,0);
						if($wellness[accomplished]=='1')
							echo "<strong>Accomplished: </strong>: ";
						
						echo  $goal_name.": ".$wellness[goal]."<br>";
					}
				}
			}

		} 
	}	
}
?>