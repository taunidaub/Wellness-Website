<?
include_once ("includes/functions.php");
include ("../phpincludes/db.php");
include ("includes/includedb.php");
conn2('wellness');
include('../phpincludes/LDAP.class.php');
$sql = "SELECT * FROM participants where eid='E101063' order by last asc, first asc";
$result = mysql_query($sql) or die(mysql_error());
//echo $sql."<BR>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: katie.garippa@domain.com' . "\r\n" .
			'Reply-To: katie.garippa@domain.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
$email_body="<html>
		<head>
			<title>Wellness Challenge Summary</title>
		</head>
		<body>";
while($row = @mysql_fetch_array($result)) {
	if ($row[eid]){
		$eid=$row[eid];
		$to=$row[email];
		$name=$row[first];
		$lastname=$row[last];
		$challenge=$row[challenge];
		$team=$row[team];
		$date_today=mktime(date('H'),date('i'),00,date('n'),date('j'), date('Y'));
		$date=date('Y-m-d',$date_today);
		$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" 
		and (challenge = "Exercise Log" or 
		challenge = "Exercise Challenge" or 
		challenge = "Portion Control Challenge" or 
		challenge = "Wellness Log" or 
		challenge = "Food Log") order by week asc';
		//echo $select_weeks."<BR>";
		$week_results=@mysql_query($select_weeks);
		while ($challenge=mysql_fetch_array($week_results)){
			switch ($challenge['challenge']) {
				case "Exercise Challenge":
					$table="wellness_log";
					$col_date="date";
					$title=	"Exercise Challenge";
					$summary='select distinct '.$col_date.' as date from '.$table.' where eid="'.$row[eid].'" and challenge="'.	$challenge['id'].'" order by '.$col_date.' asc';
					break;
				case "Portion Control Challenge":
					$table="wellness_log";
					$col_date="date";
					$title=	"Portion Control Challenge";
					$summary='select distinct '.$col_date.' as date from '.$table.' where eid="'.$row[eid].'" and challenge="'.	$challenge['id'].'" order by '.$col_date.' asc';
					break;
				case "Wellness Log":
					$table="wellness_log";
					$col_date="date";
					$title=	"Wellness Log";
					$summary='select distinct '.$col_date.' as date from '.$table.' where eid="'.$row[eid].'" and challenge="'.	$challenge['id'].'" order by '.$col_date.' asc';
					break;
				case "Exercise Log":			
					$table="wellness_log";
					$col_date="date";
					$title=	"Exercise Log";
					$summary='select distinct '.$col_date.' as date from '.$table.' where eid="'.$row[eid].'" and challenge="'.	$challenge['id'].'" order by '.$col_date.' asc';

					break;			
				case "Food Log":			
					$table="wellness_log";
					$col_date="date";
					$title=	"Food Log";
					$summary='select distinct '.$col_date.' as date from '.$table.' where eid="'.$row[eid].'" and challenge="'.	$challenge['id'].'" order by '.$col_date.' asc';

					break;				
			}
			//echo $challenge['challenge']."<br>";
			if($challenge['challenge']=="Wellness Log"){
				$tblheader='<table width="100%">';
				$tblbody='';
				//echo $summary."<BR>";;
				$results=@mysql_query($summary);
				if(@mysql_num_rows($results)>0){
					$tblheader.="<tr><th colspan='7'><h4>> ".$title." Food Summary</h4></th></tr>";
					} ?>
					<?php
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness['date']);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					$tblheader.= "<th>".$display_date."</th>";
					$meal_summary='select * from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by meal asc';
					//echo $meal_summary."<BR>";;
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
				$email_body .= $tblheader;	
				$email_body .= "<tr>";
				$email_body .= $tblbody;
				$email_body .= "</tr></table>";

				$tblheader='<table width="100%">';
				$tblbody='';			
				$results=@mysql_query($summary);
					if(@mysql_num_rows($results)>0){
						$tblheader.="<tr><th colspan='7'><h4>> ".$title." Exercise Summary</h4></th></tr>";
					} 
					while ($wellness=mysql_fetch_array($results)){
				

					$temp=explode("-",$wellness['date']);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					$tblheader.= "<th>".$display_date."</th>";					
					$exercise_summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by exercise asc';
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
				
				$email_body .= $tblheader;	
				$email_body .= "<tr>";
				$email_body .= $tblbody;
				$email_body .= "</tr></table>";
	
				
			
			}

		}
	}
			
			
} 
$tblheader='<table width="100%">';
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
					$tblheader.="<tr><th><h4>> Goal Summary</h4></th></tr>";
					$shown=1;
				}
				
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness[set_date]);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
		
				$goal_item="select challenge from challenge_timelines where id='".$wellness[challenge_id]."'";
				$goal_name=@mysql_result(@mysql_query($goal_item),0,0);
				if($wellness[accomplished]=='1')
					$accomp= "<strong>Accomplished </strong>: ";
				else
					$accomp='';
				$tblbody.= "<tr><td>".$accomp." ".$goal_name.": ".$wellness[goal]."</td></tr>";
				}
			}
		}
	} 
}
	$email_body .= $tblheader;	
	$email_body .= "<tr>";
	$email_body .= $tblbody;
	$email_body .= "</tr></table>";
		
	$email_body.="</body></html>";
mail ($to,"Wellness Summary for this week",$email_body,$headers);		
			
?>