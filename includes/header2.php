<?php
$challenge=@mysql_result(@mysql_query('select challenge from participants where eid = "'.$_SESSION['eid'].'"'),0);
$_SESSION["challenge"] = $challenge;
		?>
<br />
<div class="nav">
<div class="table">

<ul class="select"><li><a href="#">Site Map</a>
<div class="select_sub">
	<ul class="sub">
		<li><a href="index.php">Home Page</a></li>
		<!-- <li><a href="get_fit.php">Get Fit Initiative</a></li>
		<li><a href="stay_fit.php">Stay Fit Initiative</a></li>
		<li><a href="cwtc.php">Workforce Team Challenge </a></li>-->
		<li><a href="fall_fitness.php">Fall Fitness</a></li>
		<li><a href="ahawalk.php">AHA Heart Walk</a></li>
		<li><a href="interaction.php">Healthy Expressions</a></li>
		<?php if ($_SESSION['eid'] == '') { ?>
		<li><a href="#">Login</a></li>
		<?php }
		if ($_SESSION["admin"]!=''){ ?>
		<li><a href="#">Administration</a></li>
		<?PHP } ?>
	</ul>
</div>
</li>
</ul>
<?php 
	if($_SESSION['challenge']=='get_fit'){ ?>
	<ul class="select"><li><a href="get_fit.php">Get Fit</a>
	<div class="select_sub">
		<ul class="sub">
			<?php $date=date('Y-m-d');
				if (($date <= '2012-04-29')&&($date >= '2012-04-09')){
				?>
			<li><a href="fitness_test.php">Initial Fitness Test</a></li>
			<?php } ?>
			<li><a href="wellness_log.php">Weekly Wellness Log</a></li>
			<li><a href="summary.php">Weekly Summary</a></li>
			<?php $date=date('Y-m-d');
				if (($date <= '2012-06-15')&&($date >= '2012-06-04')){
				?>
				<li><a href="fitness_test.php">Final Fitness Test</a></li>
		<?php } ?>
		</ul>
	</div>
	</li>
	</ul>
	
	<ul class="select"><li><a href="#">Challenges</a>
	<div class="select_sub">
		<ul class="sub">
			<li><a href="rswc.php">Ready, Set, Walk Challenge</a></li>
			<li><a href="exercise_log">Exercise Challenge</a></li>
			<li><a href="food_log.php">Portion Control Challenge</a></li>
			<li><a href="cwtc.php">Workforce Team Challenge</a></li>
		</ul>
	</div>
	</li>
	</ul>
	
	<ul class="select"><li><a href="#">Workforce Team Challenge</a>
	<div class="select_sub">
		<ul class="sub">
			<li><a href="cwtc.php?type=event">Event Information</a></li>
			<li><a href="cwtc.php?type=signup">How to sign up</a></li>
			<li><a href="files/WTCRegForm.pdf">Registration Form</a></li>
			<li><a href="cwtc.php">Couch to Workforce Team Challenge</a></li>
	
		</ul>
	</div>
	</li>
	</ul>
	<?php }
		else if($_SESSION['challenge']=='stay_fit'){ ?>
	
	<ul class="select"><li><a href="#">Stay Fit</a>
	<div class="select_sub">
		<ul class="sub">
			<?php $date=date('Y-m-d');
				if (($date <= '2012-04-29')&&($date >= '2012-04-09')){
				?>
			<li><a href="fitness_test.php">Initial Fitness Test</a></li>
			<?php } ?>
			<li><a href="exercise_log.php">Exercise log</a></li>
			<li><a href="food_log.php">Food Log</a></li>
			<li><a href="summary.php">Weekly Summary</a></li>
			<?php $date=date('Y-m-d');
				if (($date <= '2012-06-15')&&($date >= '2012-06-04')){
				?>
				<li><a href="fitness_test.php">Final Fitness Test</a></li>
		<?php } ?>
		</ul>
	</div>
	</li>
	</ul>
	
	<ul class="select"><li><a href="#">Challenges</a>
	<div class="select_sub">
		<ul class="sub">
			<li><a href="rswc.php">Ready, Set, Walk Challenge</a></li>
			<li><a href="cwtc.php">Workforce Team Challenge</a></li>
		</ul>
	</div>
	</li>
	</ul>
	
	<ul class="select"><li><a href="cwtc.php">Workforce Team Challenge</a>
	<div class="select_sub">
		<ul class="sub">
			<li><a href="cwtc.php?type=event">Event Information</a></li>
			<li><a href="cwtc.php?type=signup">How to sign up</a></li>
			<li><a href="cwtc.php">Couch to Workforce Team Challenge</a></li>
		</ul>
	</div>
	</li>
	</ul>
	<?php }
	else { ?>

<ul class="select"><li><a href="#">Initiatives</a>
<div class="select_sub">
	<ul class="sub">
		<li><a href="fall_fitness.php">Fall Fitness Challenge</a></li>
		<li><a href="ahawalk.php">AHA Heart Walk</a></li>
		<li><a href="get_fit.php">Get Fit</a></li>
		<li><a href="stay_fit.php">Stay Fit</a></li>
		<li><a href="cwtc.php">Workforce Team Challenge</a></li>
	</ul>
</div>
</li>
</ul>

<? }  ?>
<ul class="select"><li><a href="quiz.php">Weekly Quiz</a></li></ul>
<ul class="select"><li><a href="interaction.php">Healthy Expressions</a>
<div class="select_sub">
	<ul class="sub">
		<li><a href="interaction.php#recipe">Submit a Recipe</a></li>
		<li><a href="interaction.php?#tips">Submit a Healthy Tip</a></li>
	</ul>
</div>
</li>
</ul>

<?php if ($_SESSION['eid'] == ''){ ?>
	<ul class="select"><li><a href="login_form.php">Login</a></li></ul>
		<?php }
		else {?>
	<ul class="select"><li><a href="logout.php">Logout</a></li></ul>
		<?php }
		if ($_SESSION["admin"]!=''){ ?>
	<ul class="select"><li><a href="admin.php">Administration</a></li></ul>
		<?PHP } ?>
</div>
</div>
<br /><br />