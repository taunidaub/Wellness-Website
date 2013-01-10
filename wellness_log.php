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
		
        <h1 class="title">Get Fit Challenge Information</h1>
        <p>Want to lose weight and develop healthy habits?&nbsp; Participate in the Get Fit Challenge!</p>
        <ul>
          <li>Register a team of 5 or as an individual.</li>
          <li>$20 per participant.</li>
          <li>Weigh-ins will be from April 9 &ndash; April 13.</li>
          <li>We are partnering with Bally Total Fitness for  weigh-ins, wellness workshops and more!</li>
          <li>Winners will be determined based on average  weight loss percentage and the points earned by participating in the different  challenges.&nbsp; </li>
          <li>Top two winners in each category (team and  individual) will win cash!</li>
          <li>Submissions accepted each week by using this  website!</li>
          <li>The point distribution is at the bottom of this  page.</li>
          <li>There will be multiple raffles throughout the  competition for those who participate in the challenges to win other wellness  type prizes!</li>
        </ul>
		<p><strong><a href="files/Sign-up_Form_Get Fit.pdf" target="_blank">Sign up for the Get Fit Weight Loss Challenge</a></strong></p>
		    <p><strong>Wellness Tracking Log</strong><img src="images/5points.png"></div><br>
		      Track the amount of exercise you accomplish each week and how much food  you consume to earn points.&nbsp; Keeping an  account for how much activity you are doing and how much food you are eating  will help you determine what you can improve on (examples &ndash; not walking enough  each day or drinking enough water during the day).&nbsp; </p>

		
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
		if($_SESSION['challenge']=='fall_fitness'){

		?>
		<h3 class="title_red">Weekly Wellness Tracking Log</h3>
		<a href="files/wellness_example.pdf" target="_blank">Click here for an example of a completed form</a><br>

		<?php
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
				while($row1=@mysql_fetch_array($activities_result)){
					$activity_name=@mysql_result(@mysql_query('select name from exercise where id ='.$row1['exercise']),0,0);
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
