<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");

@extract($_POST);
include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
conn2('wellness');
	
include('../phpincludes/LDAP.class.php');
$ADhost='';
$LDAP = new LDAP('CORP\\'.$_SESSION['eid'],$_SESSION['p'],$ADhost);

	include ('includes/head.php');
?>

<body>
  <div id="page">
	<div id="wrapper">
	<?php include ('includes/header2.php'); ?>

  <!-- start page -->
    <div id="sidebarA" class="sidebar">
	 <ul>
        <li>
          <h2>Admin Menu</h2>
			<?php include ('admin_doc_menu.php') ?>
        </li>
      </ul>
    </div>
    <!-- start content -->
    <div id="content">
    	<div class="post">
<? if($type=='exercise'){ ?>
				
	<a href="exercise.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Total Duration</th>
	<th valign="top">Week</th>
	<th valign="top">Challenge</th>
	<th valign="top">Team</th>

	
	<?php
	$fp = fopen('exercise.xls', 'w');
	fwrite($fp, "EID\tName\tDuration\tWeek\tChallenge\tTeam\n");
	$sql="SELECT count(*), SUM(wellness_log.duration) as duration, challenge_timelines.*, challenge_timelines.challenge as chalname,  participants.* FROM wellness_log, participants, exercise, challenge_timelines WHERE wellness_log.eid = participants.eid AND challenge_timelines.id = wellness_log.challenge AND exercise.id = wellness_log.exercise AND exercise IS NOT NULL group BY participants.eid, challenge_timelines.id order by start asc";
	echo $sql;
	$result=@mysql_query($sql);
	
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$firstname=$row[first];
			$lastname=$row[last];
	
			?>
			<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ." - ".$firstname." ".$lastname ?> </td>

			<td valign="top" nowrap="nowrap"><? echo($row[duration])?> minutes</td>	
			<td valign="top" nowrap="nowrap"><? echo($row['start'] ." - ". $row['end'])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[chalname])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[team])?></td></tr>
		
			<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$row[duration]." minutes\t".$row['start'] ." - ". $row['end']."\t".$row[chalname]."\t".$row[team]."\n");
			}
		}
		echo "</table>";
	fclose($fp);	
	}
	else if ($type=='food'){
		?>
	<a href="diet.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Weekly Entries</th>
	<th valign="top">Date</th>
	<th valign="top">Challenge</th>
	<th valign="top">Team</th>
	</tr>
	<?
	$fp = fopen('diet.xls', 'w');	
	fwrite($fp, "EID\tName\tWeekly Entries\tWeek\tChallenge\tTeam\n");
	$sql="SELECT COUNT(*) as entries, challenge_timelines.challenge as chal_name, 
                challenge_timelines.*,
		participants.*
		FROM wellness_log, participants, diet, challenge_timelines
		WHERE wellness_log.eid = participants.eid
		AND wellness_log.food=diet.id
		AND challenge_timelines.id = wellness_log.challenge
		AND food IS NOT NULL
		GROUP BY challenge_timelines.id, participants.eid order by start asc";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$firstname=$row[first];
			$lastname=$row[last];
	
			?>
			<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ." - ".$firstname." ".$lastname ?> </td>

			<td valign="top" nowrap="nowrap"><? echo($row[entries])?> </td>	
			<td valign="top" nowrap="nowrap"><? echo($row['start'] ." - ". $row['end'])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[chalname])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[team])?></td></tr>
		
			<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$row[entries]."\t".$row['start'] ." - ". $row['end']."\t".$row[chalname]."\t".$row[team]."\n");
			}
		}	
		echo "</table>";
	fclose($fp);	
		}
	else if ($type=='rswc'){
		?>
	<a href="rswc.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Day</th>
	<th valign="top">Steps</th>
	<th valign="top">Team</th>
	</tr>
	<?	
	$fp = fopen('rswc.xls', 'w');
	fwrite($fp, "EID\tName\tDay\tSteps\tTeam\n");
	$sql="SELECT *
		FROM rswc, participants
		WHERE rswc.eid = participants.eid
		ORDER BY participants.eid ASC, day ASC";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$email=$row[email];
			$firstname=$row[first];
			$lastname=$row[last];
	
			?>
			<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid." - ".$firstname." ".$lastname ?></td>
			<td valign="top" nowrap="nowrap"><a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
			<td valign="top"><? echo($row[day])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[steps])?> steps</td>
			<td valign="top" nowrap="nowrap"><? echo($row[team])?></td>
			</tr>
		
			<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$email."\t".$row[day]."\t".$row[steps]."\t".$row[team]."\n");
			}
		}	
		echo "</table>";
	fclose($fp);	
	}	

	else if ($type=='goals'){
		?>
	<a href="goals.xls">Download Excel Spreadsheet</a>
	<br /><br />

	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Accomplished</th>
	<th valign="top">Goal</th>
	
	</tr>
	<?	
	$fp = fopen('goals.xls', 'w');
	fwrite($fp, "EID\tName\tGoal\tAccomplished?\tTeam\n");
	$sql="SELECT *
		FROM goals, participants
		WHERE goals.eid = participants.eid
		ORDER BY participants.eid ASC, set_date ASC";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$email=$row[email];
			$firstname=$row[first];
			$lastname=$row[last];
	
			?>
			<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ." - ".$firstname." ".$lastname?></td>
			<td valign="top" nowrap="nowrap"><a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
			<td valign="top"><? if($row[accomplished]==1)
								$accomp= "Yes"; 
								else 
								$accomp= "No";
								
								echo $accomp;
								?>
								</td>
			<td valign="top" nowrap="nowrap"><? echo($row[goal])?></td></tr>
		
			<?					
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$row[goal]."\t".$accomp."\t".$row[team]."\n");
			}
		}	
	fclose($fp);	
	
	?>
				</table>

	<? }
		else if ($type=='test'){
		?>
	<a href="fitness.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Pushups</th>
	<th valign="top">Situps</th>
	<th valign="top">Mile Time</th>
	<th valign="top">Entry Type</th>
	<th valign="top">Team</th>
	</tr>
	<?	
	$fp = fopen('fitness.xls', 'w');
	fwrite($fp, "EID\tName\tPushups\tSitups\tMile Time\tEntry Type\tTeam\n");
	$sql="SELECT *
		FROM fitness_test, participants
		WHERE fitness_test.eid = participants.eid
		ORDER BY participants.eid ASC, id ASC";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$firstname=$row[first];
			$lastname=$row[last];
	
			?>
			<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ." - ".$firstname." ".$lastname?></td>
			<td valign="top"><? echo($row[pushups])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[situps])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[mile_time])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[type])?></td>
			<td valign="top" nowrap="nowrap"><? echo($row[team])?></td>
			</tr>
		
			<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$row[pushups]."\t".$row[situps]."\t".$row[mile_time]."\t".$row[type]."\t".$row[team]."\n");
			}
		}	
		echo "</table>";
	fclose($fp);	
	}	
?>	
  	
	</div> 
    </div>
    <!-- end content -->
<?php include ('includes/footer.php'); ?>
  </div>
 </div>
</body>
</html>
