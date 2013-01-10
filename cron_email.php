<?
include_once ("includes/functions.php");
include ("../phpincludes/db.php");
include ("includes/includedb.php");
conn2('wellness');
include('../phpincludes/LDAP.class.php');
$sql = "SELECT * FROM participants order by last asc, first asc";
$result = mysql_query($sql) or die(mysql_error());
//echo $sql."<BR>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: wellness@domain.com' . "\r\n" .
			'Reply-To: wellness@domain.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

while($row = @mysql_fetch_array($result)) {
$email_body="<html>
		<head>
			<title>Wellness Challenge Summary</title>
		</head>
		<body>";
		if ($row[eid]){
		$eid=$row[eid];
		$to=$row[email];
		$name=$row[first];
		$lastname=$row[last];
		$user_challenge=$row[challenge];
		$team=$row[team];
		$date_today=mktime(date('H'),date('i'),00,date('n'),date('j'), date('Y'));//date('j')
		$date=date('Y-m-d',$date_today);
		$week=1;
		$email_body.="Dear ".$name.",<br> Here are your weekly summaries for the ". ucwords(str_replace("_"," ",$user_challenge))." challenge.
		<br>If you haven't been to the website to fill out last week's log yet, there is still time!
		<br>Remember to check out the new Wellness Blog and the other resources at the website too!<br>
		<a href='http://wellness.alb.domain.com'>http://wellness.alb.domain.com</a><br><br>";
		if ($user_challenge=='stay_fit')
			$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" 
			and (challenge = "Exercise Log" or 
			challenge = "Food Log") order by week asc';
		
		else if ($user_challenge=='get_fit')
			$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" 
			and (challenge = "Exercise Challenge" or 
			challenge = "Portion Control Challenge" or 
			challenge = "Wellness Log") order by week asc';
		
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

			if($user_challenge=='get_fit'){
				if($title=="Exercise Challenge"){
					$tblheader='<table width="100%">';
					$tblbody='';			
					$tblheader.="<tr><th align='left'>".$title." Exercise Summary for Week ". $challenge['week']."</th></tr>";
					$results=@mysql_query($summary);
					
					$minutes=0;
					while ($wellness=mysql_fetch_array($results)){
				

						$temp=explode("-",$wellness['date']);		
						$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	

						$exercise_summary='select * from wellness_log where eid="'.$row[eid].'" and exercise !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by exercise asc ';
						//echo $exercise_summary."<br>";
						$exercise_results=@mysql_query($exercise_summary) or die (mysql_error()."<br>".exercise_summary);
						if(@mysql_num_rows($exercise_results)>0){
							
							while ($exer=mysql_fetch_array($exercise_results))
								$minutes+=$exer[duration];
						

						}
						if($user_challenge=='stay_fit'){
							if($minutes>=150)
									$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You have earned 10 points.</td>';
				
							else if($minutes<150)
									$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You should fill out at least 2.5 hours (or 150 minutes) of exercise in order to receive points.</td>';
						}
						else {
							if($minutes>=150)
								$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week.</td>';
							else
								$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You should try to do at least 2.5 hours of exercise a week';
							}

						if($tblheader!='<table width="100%">'){
							$email_body .= $tblheader;	
							$email_body .= "<tr>";
							$email_body .= $tblbody;
							$email_body .= "</tr></table>";
						}
					}
				}
				else if($title=="Portion Control Challenge"){
				
					
					$tblheader='<table width="100%">';
					$tblbody='';
					$meals=0;

					//echo $summary."<BR>";;
					$results=@mysql_query($summary);
					$tblheader.="<tr><th align='left'>".$title." Summary for Week ". $challenge['week']."</th></tr>";

					while ($wellness=mysql_fetch_array($results)){
						
							
						$meal_summary='select * from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by meal asc';
						//echo $meal_summary."<BR>";;
						$meal_results=@mysql_query($meal_summary) or die (mysql_error()."<br>".$meal_summary);
						if(@mysql_num_rows($meal_results)>0){
							$old_meal='';
							while ($menu=mysql_fetch_array($meal_results)){
								if($menu[meal]!=$old_meal)
									$meals++;
									
								$old_meal=$menu[meal];
							}

						}
						
					}
					if($meals>=29)
							$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You have earned 5 points.</td>';
					else if(($meals>=15)&&($meals<=28))
							$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You have earned 5 points.<br>Tip: Eating 5 or 6 meals spread out over every 2-3 hours prevents overeating and allows you to better control your portion sizes.</td>';
					else if($meals<15)
							$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You should fill out at least 3 meals a day in order to receive points.</td>';
											

						
					if($tblheader!='<table width="100%">'){
						$email_body .= $tblheader;	
						$email_body .= "<tr>";
						$email_body .= $tblbody;
						$email_body .= "</tr></table>";
					}
				
				}
				else {
					if($title=="Wellness Log"){
						$tblheader='<table width="100%">';
						$tblbody='';
						$meals=0;

						//echo $summary."<BR>";;
						$results=@mysql_query($summary);
						$tblheader.="<tr><th align='left'>".$title." Meal Summary for Week ". $challenge['week']."</th></tr>";

						while ($wellness=mysql_fetch_array($results)){
							
								
							$meal_summary='select * from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by meal asc';
							//echo $meal_summary."<BR>";;
							$meal_results=@mysql_query($meal_summary) or die (mysql_error()."<br>".$meal_summary);
							if(@mysql_num_rows($meal_results)>0){
								$old_meal='';
								while ($menu=mysql_fetch_array($meal_results)){
									if($menu[meal]!=$old_meal)
										$meals++;
										
									$old_meal=$menu[meal];
								}

							}
							
						}
						if($meals>=29)
								$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You have earned 5 points.</td>';
						else if(($meals>=15)&&($meals<=28))
								$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You have earned 5 points.<br>Tip: Eating 5 or 6 meals spread out over every 2-3 hours prevents overeating and allows you to better control your portion sizes.</td>';
						else if($meals<15)
								$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You should fill out at least 3 meals a day in order to receive points.</td>';
												
							
						if($tblheader!='<table width="100%">'){
							$email_body .= $tblheader;	
							$email_body .= "<tr>";
							$email_body .= $tblbody;
							$email_body .= "</tr></table>";
							}
						
						
						//exercise log
						$tblheader='<table width="100%">';
						$tblbody='';			
						$tblheader.="<tr><th align='left'>".$title." Exercise Summary for Week ". $challenge['week']."</th></tr>";
						$results=@mysql_query($summary);
						
						$minutes=0;
						while ($wellness=mysql_fetch_array($results)){
							$temp=explode("-",$wellness['date']);		
							$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	

							$exercise_summary='select * from wellness_log where eid="'.$row[eid].'" and exercise !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by exercise asc ';
							//echo $exercise_summary."<br>";
							$exercise_results=@mysql_query($exercise_summary) or die (mysql_error()."<br>".exercise_summary);
							if(@mysql_num_rows($exercise_results)>0){								
								while ($exer=mysql_fetch_array($exercise_results))
									$minutes+=$exer[duration];
							}
							
						}
						if($user_challenge=='stay_fit'){
							if($minutes>=150)
									$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You have earned 5 points.</td>';
				
							else if($minutes<150)
									$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You should fill out at least 2.5 hours (or 150 minutes) of exercise in order to receive points.</td>';
						}
						else {
							if($minutes>=150)
								$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week.</td>';
							else
								$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You should try to do at least 2.5 hours of exercise a week';
						}

					if($tblheader!='<table width="100%">'){
						$email_body .= $tblheader;	
						$email_body .= "<tr>";
						$email_body .= $tblbody;
						$email_body .= "</tr></table>";
						}
					}
				}
			}
	
		else {
			if($title=="Food Log"){
				$tblheader='<table width="100%">';
				$tblbody='';
				$meals=0;

				//echo $summary."<BR>";;
				$results=@mysql_query($summary);
				$tblheader.="<tr><th align='left'>".$title." Meal Summary for Week ". $challenge['week']."</th></tr>";

				while ($wellness=mysql_fetch_array($results)){
					
						
					$meal_summary='select * from wellness_log where eid="'.$eid.'" and meal !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by meal asc';
					//echo $meal_summary."<BR>";;
					$meal_results=@mysql_query($meal_summary) or die (mysql_error()."<br>".$meal_summary);
					if(@mysql_num_rows($meal_results)>0){
						$old_meal='';
						while ($menu=mysql_fetch_array($meal_results)){
							if($menu[meal]!=$old_meal)
								$meals++;
								
							$old_meal=$menu[meal];
						}

					}
					
				}
				if($meals>=29)
						$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You have earned 10 points.</td>';
				else if(($meals>=15)&&($meals<=28))
						$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You have earned 10 points.<br>Tip: Eating 5 or 6 meals spread out over every 2-3 hours prevents overeating and allows you to better control your portion sizes.</td>';
				else if($meals<15)
						$tblbody.='<td>You have filled out ' .$meals.' meals for the week. You should fill out at least 3 meals a day in order to receive points.</td>';
										
		
					
				if($tblheader!='<table width="100%">'){
					$email_body .= $tblheader;	
					$email_body .= "<tr>";
					$email_body .= $tblbody;
					$email_body .= "</tr></table>";
				}
				
			}
			else{
				$tblheader='<table width="100%">';
				$tblbody='';			
				$tblheader.="<tr><th align='left'>".$title." Exercise Summary for Week ". $challenge['week']."</th></tr>";
				$results=@mysql_query($summary);
				$minutes=0;
				while ($wellness=mysql_fetch_array($results)){
			

				$temp=explode("-",$wellness['date']);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	

				$exercise_summary='select * from wellness_log where eid="'.$row[eid].'" and exercise !="" and challenge='.$challenge['id'].' and date = "'.$wellness['date'].'" order by exercise asc ';
				//echo $exercise_summary."<br>";
				$exercise_results=@mysql_query($exercise_summary) or die (mysql_error()."<br>".exercise_summary);
					if(@mysql_num_rows($exercise_results)>0){
						
						while ($exer=mysql_fetch_array($exercise_results))
							$minutes+=$exer[duration];
					

					}
				}
				if($user_challenge=='stay_fit'){
					if($minutes>=150)
							$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You have earned 50 points.</td>';
		
					else if($minutes<150)
							$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You should fill out at least 2.5 hours (or 150 minutes) of exercise in order to receive points.</td>';
				}
				else {
					if($minutes>=150)
						$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week.</td>';
					else
						$tblbody.='<td>You have filled out ' .$minutes.' minutes of exercise for the week. You should try to do at least 2.5 hours of exercise a week';
				}

				if($tblheader!='<table width="100%">'){
					$email_body .= $tblheader;	
					$email_body .= "<tr>";
					$email_body .= $tblbody;
					$email_body .= "</tr></table>";
					}

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
						$tblheader.="<tr><th align='left'>Goal Summary</th></tr>";
						$shown=1;
					}
					
					while ($wellness=mysql_fetch_array($results)){
						$temp=explode("-",$wellness[set_date]);		
						$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
			
					$goal_item="select challenge from challenge_timelines where id='".$wellness[challenge_id]."'";
					$goal_name=@mysql_result(@mysql_query($goal_item),0,0);
					if($wellness[accomplished]=='1')
						if($user_challenge=='stay_fit')
							$accomp= "<strong>Accomplished (+10 Points) </strong>: ";
						else $accomp= "<strong>Accomplished </strong>: "; 
					else
						$accomp='';
					$tblbody.= "<tr><td>".$accomp." ".$goal_name.": ".$wellness[goal]."</td></tr>";
					}
				}
			}
		} 
	}
	if($tblheader!='<table width="100%">'){
		$email_body .= $tblheader;	
		$email_body .= "<tr>";
		$email_body .= $tblbody;
		$email_body .= "</tr></table>";
		}
		
	$email_body.="</body></html>";
	
	//echo $email_body;
	mail ($to,"Wellness Summary for this week",$email_body,$headers);		
	//mail ("tauni.daub@domain.com","Wellness Summary for this week",$email_body,$headers);	
	
} 			
?>