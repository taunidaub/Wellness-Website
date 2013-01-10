<?php
session_start();
	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');
	$_SESSION['page'] = $_SERVER["REQUEST_URI"];
	include ('includes/head.php');
?>

<body>
  <div id="page">
	<div id="wrapper">
	<?php include ('includes/header2.php'); ?>
	<?php include ('includes/left-bar.php') ?>
    <!-- start content -->
    <div id="content">
      <div class="post"><div style="float:right"><img src="images/50points.png"></div>
        <h2 class="title">Fitness Test – <?php echo ucwords(str_replace("_"," ",$_SESSION['challenge'])) ?> Challenge</h2>
        See how many push-ups and sit-ups you can do in one minute, and how long it takes you to complete 1 mile.</p>
		<?php
		$date=date('Y-m-d');//'2012-04-18';//
		$start = '2012-04-09';
		$end = '2012-04-29';
		$start2 = '2012-06-04';
		$end2 = '2012-06-08';
		if (($date>=$start)&&($date<=$end)) { 
			$check_status ='select * from fitness_test where type="initial" and eid = "'.$_SESSION['eid'].'"';
			$status_result=@mysql_query($check_status);
			?>		
			<h3 class="title_green">Initial Fitness Test (April 16 – April 29):</h3>
			<?php 
			if(@mysql_num_rows($status_result))
			while($status=@mysql_fetch_array($status_result)){
				if($status['pushups'])
					echo ("Number of Push-ups: ".$status['pushups']."<br>");
				if($status['situps'])
					echo ("Number of Sit-ups: ".$status['situps']."<br>");				
				if($status['mile_time'])
					echo ("Mile Time:  ".$status['mile_time']."<br>");
			}
			else{ ?>
			<form name="initial" method="get">			 
				Number of Push-ups: <input type="text" name="pups" id="pups" /><br />
				Number of Sit-ups: <input type="text" name="sups" id="sups" /><br />
				Mile Time: <input type="text" name="mtime" id="mtime" /><br />
			
			<?php 
				if ($_SESSION[eid]!=''){ ?>&nbsp;&nbsp;<input type="button" name="submit" value="Submit" onClick="javascript:add_initial();" />
				<?php } ?>
			</form>
		<?php	 }?>		
				<br>
        <p><strong>Submit fitness results by April 22 to earn points.</strong></p>
		<br>
		<?php }
		if (($date>=$start)&&($date<=$end2)) { 
	
			$check_status ='select * from fitness_test where type="goals" and eid = "'.$_SESSION['eid'].'"';
			$status_result=@mysql_query($check_status);
			?>		
			<h3 class="title_green">Goals for the Final Fitness Test</h3>
			<?php 
			if(@mysql_num_rows($status_result)){
				while($status=@mysql_fetch_array($status_result)){
					if($status['pushups'])
						echo ("Number of Push-ups: ".$status['pushups']."<br>");
					if($status['situps'])
						echo ("Number of Sit-ups: ".$status['situps']."<br>");				
					if($status['mile_time'])
						echo ("Mile Time:  ".$status['mile_time']."<br>");
				}
			}
			else{ ?>
			<form name="goals" method="get">
				Number of Push-ups: <input type="text" name="pups" id="pups" /><br />
				Number of Sit-ups: <input type="text" name="sups" id="sups" /><br />
				Mile Time: <input type="text" name="mtime" id="mtime" /><br />
				
				<?php if ($_SESSION[eid]!=''){ ?>&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" onClick="javascript:add_goals();" />
			
				<?php	} 	?>			
				<br>
			</form>	
		<p><strong>Submit fitness goals by April 29 to earn points.</strong></p>
	<?php	} 	?>			
			<br>

		<form name="wellness" id="wellness" action="add_goal.php">Add a personal goal for your fitness challenge:<br>
		<textarea name="goal" id="goal" cols="60" rows="1"></textarea><br>
		<input type="hidden" name="challenge_id" id="challenge_id" value="2">
		<input type="submit" name="goal_submit" value="Submit Goal"></form>
	

		<?php	

		} 
		 if (($date>=$start2)&&($date<=$end2)) { 
			$check_status ='select * from fitness_test where type="final" and eid = "'.$_SESSION['eid'].'"';
			$status_result=@mysql_query($check_status);	
			?>
			<h3 class="title_green">Final Fitness Test (June 4 - June 8):</h3>
			<form name="final">
			<?php 
				if(@mysql_num_rows($status_result)){
					while($status=@mysql_fetch_array($status_result)){
						if($status['pushups'])
							echo ("Number of Push-ups: ".$status['pushups']."<br>");
						if($status['situps'])
							echo ("Number of Sit-ups: ".$status['situps']."<br>");				
						if($status['mile_time'])
							echo ("Mile Time:  ".$status['mile_time']."<br>");
					}
				}
				else{ ?>
					Number of Push-ups: <input type="text" name="pups" id="pups" /><br />
					Number of Sit-ups: <input type="text" name="sups" id="sups" /><br />
					Mile Time: <input type="text" name="mtime" id="mtime" /><br />
					
					<?php if ($_SESSION[eid]!=''){ 
						?>&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" onClick="javascript:add_final();" />
					<?php } ?>						
					<p><strong>Submit fitness results by June 8 to earn points.</strong></p>
		   <?php } ?>
	</form>
	<?php }
	   elseif (($date<=$start)&&($date>=$end2)) {  ?>
				<h3 class="title_green">Initial Fitness Test (April 16 – April 29)</h3>
				<h3 class="title_green">Fitness Test Goals (April 16 – April 29)</h3>
				<h3 class="title_green">Final Fitness Test (June 4 - June 8)</h3>
		<?php
		}?>
      </div>
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
