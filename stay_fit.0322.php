<?
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
	<?php  ?>
        <h1 class="title">Stay Fit Challenge Submissions</h1>	
		<?php if ($_SESSION[eid]==''){ ?>
		<h4 class="title_red">Login to post your results.</h4>

		EID: <input type="text" name="logineid" id="logineid" />
		Password: <input type="password" name="password" id="password" />
		<input type="submit" name="login" value="Login" onClick="javascript:login();" /><br />
		<?php } ?>

		<h3 class="title_red"><a name="ped"></a>Pedometer Tracking Challenge</h3>
		<form name="pedometer">
			Steps: <input type="text" name="steps" id="steps" /><br />
			<?php if ($_SESSION[eid]!=''){ ?>&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" onClick="javascript:add_entry('steps','stay_fit');" />
			<?php } ?>		
		</form>
		
		<h3 class="title_red"><a name="stair"></a>Stairs Challenge</h3>
		<form name="stairs">
			Stairs: <input type="text" name="stairs" id="stairs" /><br />
			<?php if ($_SESSION[eid]!=''){ ?>&nbsp;&nbsp;<input type="submit" name="submit" value="Submit" onClick="javascript:add_entry('stairs','stay_fit');" />
			<?php } ?>		
		</form>
		
		<h3 class="title_red"><a name="incfit"></a>Increase Fitness Challenge</h3>
		<form name="fitness">
     	<form method="post" name="exercise" action="javascript:calorie_calc()">
		Type in an exercise here:
			<br /><input type="text" name="lookup_exercise" id="lookup_exercise" onKeyUp="javascript:exercise_lookup()" />
			<br />
			or select one from the drop down below:<br />
			<select name="select_exercise" id="select_exercise">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $options ?>
			</select>
			<br />
			
			Time spent (minutes): <input type="text" name="time_spent" id="time_spent" maxlength="3" size="4" />
			<br />
			Your current weight (pounds): <input type="text" name="current_weight" id="current_weight" maxlength="3" size="4" />
			<br />
			<input type="submit" name="submit" value="Calculate" onClick="javascript:calorie_calc()" />		
			<br /><div id="total"></div><br />
			Total Calories:<input type="text" name="fitness" id="fitness" /><br />
			<?php if ($_SESSION[eid]!=''){ ?>&nbsp;&nbsp;<input type="submit" name="submit" value="Add to Fitness Challenge" onClick="javascript:add_entry('fitness','stay_fit');" />
			<?php } ?>	
		</form>

	<br /><br />
				
	</div>
 
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
