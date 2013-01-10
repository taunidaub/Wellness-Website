<?
session_start();
//if($_SESSION['eid']=="E101063")
	//$_SESSION['eid']="E146256";//"E101063;
//;
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
    <div id="content">
      <div class="post">
	  	 <?php if($_SESSION['challenge']==''){ ?>
        <h1 class="title">Welcome to the Health and Wellness Website</h1>
        
        <div>The Health and Wellness Challenge materials will be available starting April 9. <br>These materials will only be available to those participating in the different challenges.</div>
        <?php } 
		else{ 
			?>
			<h2 class='title'>Wellness Challenge Summary</h2>
			
			<?php	
			if($_SESSION['challenge']=='get_fit'){
				get_meal_log($_SESSION['eid']);
				get_activity_log($_SESSION['eid']);
				exercise_challenge($_SESSION['eid']);
				get_rswc_log($_SESSION['eid']);
				goal_summary($_SESSION['eid']);
				calorie_counts($_SESSION['eid']);
			}
			else if($_SESSION['challenge']=='stay_fit'){
				get_exercise_log($_SESSION['eid']);			
				get_food_log($_SESSION['eid']);
				get_rswc_log($_SESSION['eid']);
				goal_summary($_SESSION['eid']);
				calorie_counts($_SESSION['eid']);
			}
			else if($_SESSION['challenge']=='fall_fitness'){
				get_exercise_log($_SESSION['eid']);			
				get_food_log($_SESSION['eid']);
				calorie_counts($_SESSION['eid']);
				//graphs($_SESSION['eid']);
				
			}
			

		}
		?>

		<br><br>
		<?php $date=date('Y-m-d');
			if (($date <= '2012-04-22')&&($date >= '2012-06-04')){
			?>
		<li><a href="rswc.php">Ready Set Walk Challenge </a></li>
		<li><a href="cwtc.php">Workforce Team Challenge </a></li>
	
			<?php
			if (($date <= '2012-04-22')&&($date >= '2012-04-09')){
			?>
		<li><a href="fitness_test.php">Initial Fitness Test</a></li>
		<?php } 
		}
		?>
		<li><a href="fall_fitness.php">Fall Fitness Log</a></li>

		<?php 
			if (($date <= '2012-06-15')&&($date >= '2012-06-04')){
			?>
			<li><a href="fitness_test.php">Final Fitness Test</a></li>
			<?php } ?>
	
      </div>
    </div>

<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
