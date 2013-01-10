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
		
      <h1 class="title">Stay Fit Challenge Information</h1>
        <p>Don&rsquo;t necessarily need to lose weight but would like to participate in  a wellness competition to develop or maintain healthy habits?&nbsp; If so, the Stay Fit Challenge is for you!</p>
        <ul>
          <li>Register as an individual.</li>
          <li>$20 per participant.</li>
          <li>We are partnering with Bally Total Fitness for  weigh-ins, wellness workshops and more!</li>
          <li>Winners will be determined based on most points  earned.</li>
          <li>You can earn points by participating in the  different wellness challenges, submitting to the weekly &ldquo;activity log and  nutrition journal&rdquo; as well as earning bonus points throughout.&nbsp; </li>
          <li>Top two winners will win cash!</li>
          <li>Submissions accepted each week by using this  website!</li>
          <li>The point distribution is at the bottom of this  page.</li>
          <li>There will be multiple raffles throughout the competition  for those who participate in the challenges to win other wellness type prizes!</li>
        </ul>

		<p><strong><a href="files/Sign-up_Form_Stay Fit.pdf" target="_blank">Sign up for the Stay Fit Wellness Challenge</a></strong></p>
		    <p><strong>Weekly Movement Tracker</strong><br>
		      During this 8 week challenge, you will earn points if you exercise for  2.5 or more hours each week.&nbsp; Experts say  to exercise at least 30 minutes a day 5 days a week or 2.5 hours each  week.&nbsp; To earn points, you need to track  and submit what you have done each week.&nbsp;  Also, you can earn bonus points by outlining your goal before each week  of what you want to accomplish during the following week.&nbsp; Then each week, submit your exercise activity  here and indicate if you reached your goal or not.<br>
		      Ways to increase your activity each week: </p>
		    <ul>
		      <li>Make it fun!&nbsp;  Do something you like (play golf, bike ride, bowling, playing catch,  etc).</li>
		      <li>Find an exercise or walking/jogging/running  partner (it&rsquo;s better to exercise with someone else!)<strong></strong></li>
		      <li>Take 10 minutes during your lunch to walk around  the building</li>
		      <li>During commercial breaks do a couple of push-ups</li>
		      <li>Play outside with your kids</li>
		      <li>Dance while you are doing the dishes</li>
		      <li>Sit on a yoga ball while you watch TV</li>
		      <li>Go to the gym twice a week</li>
	        </ul>
		
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
	else if($_SESSION['challenge']=='get_fit'){
		?>
		<h3 class="title_red">Exercise Challenge Worksheet</h3>
		<?php
			$date=date('Y-m-d',$date_today);
			$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" and challenge="Exercise Challenge" order by week asc';
			//echo $select_weeks;
			$select_result=@mysql_query($select_weeks);
				if(@mysql_num_rows($select_result)){
					while($row=@mysql_fetch_array($select_result)){
						$temp=explode("-",$row['start']);
						$start=mktime(00,01,01,$temp[1],$temp[2],$temp[0]);
				?>		
				<table align="center" cellpadding="20" border="1" width="100%">
				<tr><th colspan="2" align="center"><h3 class="title_blue"><?php echo "Week ".$row['week'] ?></h3></th></tr>
				<tr><th align="center" width="100px">Day</th><th align="center">Exercise and Duration</th></tr>
				<?php 
				
				for($w=0;$w<7;$w++){
				$this_date=date('Y-m-d', ($start+($w*86400)));
				$display_date=date('m/d/Y', ($start+($w*86400)));
				?>
				<tr><td valign="middle"><strong><?php echo $display_date; ?></strong></td>
				<td><?php 
				$get_activities='select * from wellness_log where exercise!="" 
				and eid="'.$_SESSION['eid'].'" 
				and challenge='.$row[id].' 
				and date="'.$this_date.'"'; 	
				//echo $get_activities;
				$activities_result=@mysql_query($get_activities);
				if(@mysql_num_rows($activities_result)>0)
					while($row2=mysql_fetch_array($activities_result)){
						$activity_name=mysql_result(mysql_query('select name from exercise where id ='.$row2['exercise']),0,0);
						echo($activity_name.' for '.$row2['duration'].' minutes<br>');
					}
				
				?>
				<a href="javascript:add_exercise('<?php echo $this_date ?>','<?php echo $row[id] ?>')">Click here to add an activity to your log.</a>
				
				</td></tr>
			<?php
				}
			$get_goal='select goal, accomplished from goals where eid="'.$_SESSION[eid].'" and challenge_id="'.$row['id'].'"';
			$goal_result=@mysql_query($get_goal);
			
			if(@mysql_num_rows($goal_result)>0){
			?>
			<tr><td colspan="3" valign="top"><strong>Goal:</strong> <?php echo mysql_result($goal_result,0,0) ?><br>
			<?php
				if(mysql_result($goal_result,0,1)==0){ ?>
				<form name="wellness" id="wellness" action="add_goal.php"><strong>Did you accomplish your goal? </strong> (10 Points) <input type="radio" name="accomplished" value="1"> Yes <input type="radio" name="accomplished" value="2"> No 
			<input type="hidden" name="challenge_id" id="challenge_id" value="<?php echo $row['id'] ?>"><br>
			<strong>Did you accomplish at least 2.5 hours of exercise this week?</strong> (50 points) <input type="radio" name="accomplished2" value="1"> Yes <input type="radio" name="accomplished2" value="2"> No &nbsp;&nbsp;<input type="submit" name="goal_submit" value="Submit"></form>
				<?php }
				else if(mysql_result($goal_result,0,1)==1){ ?>
					Congratulations you earned an extra 10 points.
					<?php
				}
				else if(mysql_result($goal_result,0,1)==2){ ?>
					<?php
				} ?> 
			
			</td></tr>
			<?php
			}
			else { ?>
			<tr><td colspan="2" valign="top"><form name="wellness" id="wellness" action="add_goal.php">10 bonus points if you meet your goal for next week: &nbsp;&nbsp; <input type="submit" name="goal_submit" value="Submit Goal"><br><textarea name="goal" id="goal" cols="60" rows="1"></textarea>
			<input type="hidden" name="challenge_id" id="challenge_id" value="<?php echo $row['id'] ?>"></form><br>You must accomplish 2.5 hours of exercise per week for 50 Points.</td></tr></table>
			<?php } ?>
			
		
		<br>
<?php	}
}
else { ?>
 <p><strong>Exercise Challenge </strong><div style="float:right"><img src="images/50points.png"></div><br>
		      Experts say to exercise for 30 minutes a day 5 days a week or 2.5 hours  per week.&nbsp; Sometimes life gets in the way  to take 30 minutes to exercise.&nbsp; To make  it easier for you, break it up into smaller and more attainable  increments.&nbsp; During this challenge, we  challenge you to exercise 3 hours each week for two weeks!&nbsp; Ways to do this:</p>
		    <ul>
		      <li>Make it fun!&nbsp;  Do something you like (play golf, bike ride, bowling, playing catch,  etc).</li>
		      <li>Take 10 minutes during your lunch to walk around  the building</li>
		      <li>During commercial breaks do a couple of push-ups</li>
		      <li>Play outside with your kids</li>
		      <li>Dance while you are doing the dishes</li>
		      <li>Sit on a yoga ball while you watch TV</li>
		      <li>Find someone to exercise with!&nbsp; It more fun that way!</li>
	        </ul>
		    <p>Any extra &ldquo;movement&rdquo; will help you accomplish your goals!</p>
		    <p>This challenge will run from April 30 &ndash; May 13</p>

<?php }	 }
	 else if($_SESSION['challenge']=='stay_fit'){
	 ?>
		<h3 class="title_red">Exercise Tracking Log  </h3><div style="float:right"><img src="images/50points.png"></div>
		<a href="files/wellness_example.pdf" target="_blank">Click here for an example of a completed form</a><br>

		<?php
			
			$date=date('Y-m-d',$date_today);
			$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" and challenge="Exercise Log" order by week asc';
			//echo $select_weeks;
			$select_result=@mysql_query($select_weeks);
			if(@mysql_num_rows($select_result))
				while($row=@mysql_fetch_array($select_result)){
					$temp=explode("-",$row['start']);
					$start=mktime(00,01,01,$temp[1],$temp[2],$temp[0]);
			?>		
			<table align="center" cellpadding="20" border="1" width="100%">
			<tr><th colspan="2" align="center"><h3 class="title_blue"><?php echo "Week ".$row['week'] ?></h3></th></tr>
			<tr><th align="center" width="100px">Day</th><th align="center">Exercise and Duration</th></tr>
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
					echo($activity_name.' for '.$row1['duration'].' minutes<br>');
				}
			
			?>
			<a href="javascript:add_exercise('<?php echo $this_date ?>','<?php echo $row[id] ?>')">Click here to add an activity to your log.</a>
			
			</td></tr>
		<?php
			}
		
		$get_goal='select goal, accomplished from goals where eid="'.$_SESSION[eid].'" and challenge_id="'.$row['id'].'"';
		$goal_result=@mysql_query($get_goal);
		
		if(@mysql_num_rows($goal_result)>0){
			?>
			<tr><td colspan="3" valign="top"><strong>Goal:</strong> <?php echo mysql_result($goal_result,0,0) ?><br>
			<?php
			if(mysql_result($goal_result,0,1)==0){ ?>
				<form name="wellness" id="wellness" action="add_goal.php"><strong>Did you accomplish your goal? </strong> (10 Points) <input type="radio" name="accomplished" value="1"> Yes <input type="radio" name="accomplished" value="2"> No 
				<input type="hidden" name="challenge_id" id="challenge_id" value="<?php echo $row['id'] ?>"><br>
				<strong>Did you accomplish at least 2.5 hours of exercise this week?</strong> (50 points) <input type="radio" name="accomplished2" value="1"> Yes <input type="radio" name="accomplished2" value="2"> No &nbsp;&nbsp;<input type="submit" name="goal_submit" value="Submit"></form>
				<?php 		
			}
			else if(mysql_result($goal_result,0,1)==1){ ?>
				Congratulations you earned 10 points.
				<?php
			}
			else if(mysql_result($goal_result,0,1)==2){ ?>
				<?php
			} ?>
			
				</td></tr></table>
<?php	}
		else { ?>
			<tr><td colspan="2" valign="top"><form name="wellness" id="wellness" action="add_goal.php">Goal for next week: &nbsp;&nbsp; <input type="submit" name="goal_submit" value="Submit Goal"><br><textarea name="goal" id="goal" cols="60" rows="1"></textarea>
			<input type="hidden" name="challenge_id" id="challenge_id" value="<?php echo $row['id'] ?>"></form></td></tr></table>
  <?php } ?>
		
		
		<br>
<?php	
	}
 } ?>	

		</div>
    </div>
    <!-- end content -->
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
