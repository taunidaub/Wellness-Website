<?php
	session_start();
	$_SESSION['page'] = $_SERVER["REQUEST_URI"];
	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');

include ('includes/head.php');
?>

<body>
  <div id="page">
	<div id="wrapper">
	<?php include ('includes/header2.php'); ?>
	<?php include ('includes/left-bar.php') ?>
	<!-- start content -->
    <div id="content">
	<div class="post">
		<?php 
		$date_today=mktime(date('H'),date('i'),00,date('n'),date('j'), date('Y'));

		if($_SESSION['challenge']==''){ ?>
		
        <h1 class="title">Fall fitness Challenge</h1>
   		 <p>Want to participate in a wellness program where you can lose weight  and win prizes?&nbsp; </p>
	    <p>It is simple and it is no cost to you!</p>
	    <p> All you need  to do is enter your weight at the beginning of each month, make an attainable  goal to reach over each 30 day period, and then enter in your goal and weight  at the beginning of each following month.&nbsp; </p>
	    <p>The program starts the week of  September 3 and goes to the week of December 3.&nbsp; At the end of each month  if you accomplish or exceed your goal, you will be entered to win a wellness  prize.&nbsp; If you fully participate in the entire Fall Fitness Challenge, you  could win a cash prize.&nbsp; </p>
	    <p>Scales are located in the HR office in Rotterdam  and New Karner.&nbsp; Other locations will need to see their CAs to access a  scale.&nbsp; 
	<?php if ($_SESSION[eid]==''){ ?>
		<h4 class="title_red">Login to post your results.</h4>
		<form action="login.php">
		EID: <input type="text" name="logineid" id="logineid" />
		Password: <input type="password" name="password" id="password" />
		<input type="submit" name="login" value="Login" onClick="javascript:login();" />
		</form>
		<br />
	<?php } 
	} 
	else {	
		if($_SESSION['challenge']!=''){
			$last_entered=mysql_result(mysql_query('select max(date) from weight_tracking where eid="'.$_SESSION['eid'].'"'),0);
			if($last_entered!='')
				$temp=explode("-",$last_entered);
			$get_weight='select * from weight_tracking where eid="'.$_SESSION['eid'].'" and date = "'.$last_entered.'"';
			$weight_result=@mysql_query($get_weight);
			while ( $row=mysql_fetch_array($weight_result)){
				$_SESSION['weight']= $row[weight];
				$weight= $row[weight];
				$goal= $row['goal'];
				$met= $row['met'];
				$date=$row['date'];
				$temp=explode("-",$row['date']);
				if(@mktime(0,0,0,date('n'),date('j'),date('Y'))-@mktime(0,0,0,$temp[1],$temp[2],$temp[0])<604800)
					$get_weekly=true;
				}
			if(@mktime(0,0,0,date('n'),date('j'),date('Y'))-@mktime(0,0,0,$temp[1],$temp[2],$temp[0])<2419200)
			{
				$current_weight=true;
			}
			else 
				$current_weight=false;
			
			$current_date_info=get_challenge_week(date('Y-m-d'));//'2012-04-12'
			
		?>
		<h3 class="title_red">Fall Fitness Weekly Tracking Log</h3>
		
	    <p class="title_red">&nbsp;</p>
		<table align="center" cellpadding="20" border="1" width="100%">
		<form name='goals' action='submit_goals.php'>
		<tr><th>Goals for <?php echo date(F); ?></th></tr>
			<?php if(!$current_weight){ ?>
			<tr><td>Your current weight (pounds): <input type="text" name="current_weight" id="current_weight" maxlength="3" size="4" value="" /> (Your most recent entry: <?php echo $_SESSION['weight']?>)</td></tr>
			<tr><td>Your goal weight (pounds): <input type="text" name="goal" id="goal" maxlength="3" size="4" value="" /></td></tr>
				<tr><td><input type="submit" name="submit" value="Submit current weight and goal" /></td></tr>
		
			<? } 
			else {?>
			<tr><td>Your goal weight (pounds): <?php echo $goal ?></td></tr>
			<? if(!$get_weekly){ ?>
			<input type="hidden" name="goal" value="<?php echo $goal ?>">
			<input type="hidden" name="met" value="<?php echo $met ?>">
			<tr><td>You can update your current weight (pounds): <input type="text" name="current_weight" id="current_weight" maxlength="3" size="4" value="" /> (Your most recent entry: <?php echo $_SESSION['weight']?>)</td></tr>
				<tr><td><input type="submit" name="submit" value="Update Weekly Progress" /></td></tr>
				
			<?	} 
			else {?>
			<tr><td>Your most recent entry: <?php echo $_SESSION['weight']?> pounds</td></tr>
			
				<?
				}
			}?>
			
			<input type="hidden" name="month" value="<?php echo date(F); ?>">
		</form>
		</table>
		<br><br>
			
		
		<?php
			$get_weight='select * from weight_tracking where eid="'.$_SESSION['eid'].'" order by date asc';
			$weight_result=@mysql_query($get_weight);
			if(mysql_num_rows($weight_result)>0)
			
			?>
			<table width="50%">
			<tr><th>Date</th><th>Weight</th><th>Goal</th></tr>
			<?
			while ($row=mysql_fetch_array($weight_result)){
				$temp=explode("-",$row['date']);
				$date= $temp[1]."/".$temp[2]."/".$temp[0];	
				if($row['met']==1)
					$style= ' style="color:#00CC00;"';
				else
					$style='';
			?>
			<tr><td<?php echo $style ?>><?php echo $date ?></td>
			<td<?php echo $style ?>><?php echo $row[weight] ?></td>
			<td<?php echo $style ?>><?php echo $row[goal] ?></td></tr>
			
			<?
			
			}
			if(mysql_num_rows($weight_result)>0)
				echo 	"</table>";
			
			$date=date('Y-m-d',$date_today);
			$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" and challenge="Fall_fitness" order by week asc';
			//echo $select_weeks;
			$select_result=@mysql_query($select_weeks);
			if(@mysql_num_rows($select_result))
				while($row=@mysql_fetch_array($select_result)){
					$temp=explode("-",$row['start']);
					$start=mktime(00,01,01,$temp[1],$temp[2],$temp[0]);
			?>
			<br>
			
			<table align="center" cellpadding="20" border="1" width="100%">
			<tr><th colspan="3" align="center"><h3 class="title_blue"><?php echo "Week ".$row['week'] ?></h3></th></tr>
			<tr><th align="center" width="100px">Day</th><th align="center" width="40%">Exercise and Duration</th><th align="center" width="40%">Food</th></tr>
			<?php 
			
			for($w=0;$w<7;$w++){
			$this_date=date('Y-m-d', ($start+($w*86400)));
			$display_date=date('m/d/Y', ($start+($w*86400)));
			?>
			<tr><td valign="middle"><strong><?php echo $display_date; ?></strong></td>
			<td><?php 
			$get_activities='select * from wellness_log where exercise!="" and eid="'.$_SESSION['eid'].'" and date="'.$this_date.'"'; 	
			//echo $get_activities;
			$activities_result=@mysql_query($get_activities);
			if(@mysql_num_rows($activities_result)>0)
				while($row1=mysql_fetch_array($activities_result)){
					$activity_name=mysql_result(mysql_query('select name from exercise where id ='.$row1['exercise']),0,0);
					echo($activity_name.' for '.$row1['duration'].' minutes <a href="" onClick="javascript:delete_item(\''.$row1['id'].'\')"><img src="images/delete_sm.png" style="vertical-align:middle" title="Delete this item from your log." alt="Delete this item from your log."></a><br>');
				}
			
			?>
			<a href="javascript:add_exercise('<?php echo $this_date ?>','<?php echo $row['id'] ?>')">Click here to add an activity to your log.</a>
			
			</td><td>
			<?php 
			$get_meals='select * from wellness_log where food!="" and eid="'.$_SESSION['eid'].'" and date="'.$this_date.'" order by meal desc'; 	
			//echo $get_activities;
			$meals_result=@mysql_query($get_meals);
			if(@mysql_num_rows($meals_result)>0)
				while($row2=@mysql_fetch_array($meals_result)){
					if($row2['meal']!=$old_meal)
						echo '<h4 class="title_green">'.$row2['meal'].'</h4>';
					
					$food_name=mysql_result(mysql_query('select name from diet where id ='.$row2['food']),0,0);
					
					echo($row2['servings'].' serving');
					if($row2['servings']>1)
						echo 's';
					echo (' of '. $food_name.' <a href="" onClick="javascript:delete_item(\''.$row2['id'].'\')"><img src="images/delete_sm.png" style="vertical-align:middle" title="Delete this item from your log." alt="Delete this item from your log."></a>');
					echo '<br>';
					$old_meal=$row2['meal'];
				}
				
				?>
			<a href="javascript:add_food('<?php echo $this_date ?>','<?php echo $row['id'] ?>')">Click here to add meals to your log.</a>
		</td></tr>
		<?php
			}
		$get_goal='select goal, accomplished from goals where eid="'.$_SESSION[eid].'" and challenge_id="'.$row['id'].'"';
		$goal_result=@mysql_query($get_goal);
		
		if(@mysql_num_rows($goal_result)==1){
		?>
		<tr><td colspan="3" valign="top"><strong>Goal:</strong> <?php echo mysql_result($goal_result,0,0) ?><br>
		<?php
			if(mysql_result($goal_result,0,1)==0){ ?>
			<form name="wellness" id="wellness" action="add_goal.php"><strong>Did you accomplish your goal?:</strong> <input type="radio" name="accomplished" value="1"> Yes <input type="radio" name="accomplished" value="2"> No &nbsp;&nbsp;<input type="submit" name="goal_submit" value="Submit">
		<input type="hidden" name="challenge_id" id="challenge_id" value="<?php echo $row['id'] ?>"></form>
			<?php } ?>
		
		</td></tr>
		<?php
		}
		else { ?>
		<tr><td colspan="3" valign="top"><form name="wellness" id="wellness" action="add_goal.php">Goal for next week: &nbsp;&nbsp; <input type="submit" name="goal_submit" value="Submit Goal"><br><textarea name="goal" id="goal" cols="60" rows="1"></textarea>
		<input type="hidden" name="challenge_id" id="challenge_id" value="<?php echo $row['id'] ?>"></form></td></tr>
		<?php } ?>
		</table>
		
		<br>
<?php	}
	}
}
 ?>	

	  </div>
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
