<?php
	session_start();
	$_SESSION['page'] = $_SERVER["REQUEST_URI"];
		
if (!isset($_SESSION[eid]))
	header("Location: small_login.php");

	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');

include ('includes/head.php');
$get_weight='select weight, date from weight_tracking where eid="'.$_SESSION['eid'].'" and date = (select max(date) from weight_tracking where eid="'.$_SESSION['eid'].'")';
$weight_result=@mysql_query($get_weight);
if(@mysql_num_rows($weight_result)>0){
	$date_info=get_challenge_week(mysql_result($weight_result,0,1));
	$_SESSION['weight']=mysql_result($weight_result,0,0);
	$current_date_info=get_challenge_week(date('Y-m-d'));//'2012-04-12'
	if($current_date_info['week']==$date_info['week'])
		$current_weight=true;
	else 
	$current_weight=false;
}


?>
<html>
<head>
<script language="javascript">
window.onunload = function(){ 
  window.opener.location.reload(); 
}; 
</script>
</head>
<body>
  <div id="page">
	<div id="wrapper">
        <h1 class="title">Activity Calculator</h1>
		<div class="entry">Enter an activity into the search field (ex. Bicycling) or select one from the drop down menu below and the amount of time you spend exercising to estimate the calories you have burned. <br><br>
		<? 
		$list_sql = "select id, name from exercise order by name asc";
		$list_result=mysql_query($list_sql);
		while ($list=mysql_fetch_array($list_result)){
			$options.='<option value="'.$list['id'].'">'.$list['name'].'</option>';
			}
		
		$fav_list_sql = "select exercise.id, name from exercise, favorites where favorites.eid='".$_SESSION['eid']."' and favorites.table = 'exercise' and exercise.id=favorites.id order by name asc";
		$fav_list_result=@mysql_query($fav_list_sql);
		$fav_options='';
		while ($fav_list=@mysql_fetch_array($fav_list_result)){
			$fav_options.='<option value="'.$fav_list['id'].'">'.$fav_list['name'].'</option>';
			}
		?>
		
		<form method="post" name="exercise" action="javascript:submit_activity()">
     	<table cellpadding="5">
		<?php if ($fav_options!=''){ ?>
		<tr><td>Select from your saved favorites: 
		</td><td><select name="fav_select_exercise" id="fav_select_exercise">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $fav_options ?>
			</select>
		</td></tr>
		<tr><td>Show all exercises:</td><td><input type="checkbox" name="showall" id="showall" onClick="javascript:show_div('addexercise');show_div('addexercise1');" /></td></tr>
		<tr id="addexercise" style="display:none"><td>Type in an exercise here: </td><td>and/or select one from the drop down below:</td></tr>
		<tr id="addexercise1" style="display:none"><td><input type="text" name="lookup_exercise" id="lookup_exercise" onKeyUp="javascript:exercise_lookup()" />
		</td><td><select name="select_exercise" id="select_exercise">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $options ?>
			</select>
		</td></tr>		
		<? } 
		else { ?>
		<tr><td>Type in an exercise here: </td><td>and/or select one from the drop down below:</td></tr>
		<tr><td><input type="text" name="lookup_exercise" id="lookup_exercise" onKeyUp="javascript:exercise_lookup()" />
		</td><td><select name="select_exercise" id="select_exercise">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $options ?>
			</select>
		</td></tr>

		<?php }
		if ($current_weight==false){ ?>
		<tr><td colspan="2">Your current weight (pounds): <input type="text" name="current_weight" id="current_weight" maxlength="3" size="4" value="" /> (Your most recent entry: <?php echo $_SESSION['weight']?>)</td></tr>
		
		<?php } 
		else 
		echo ('<input type="hidden" name="current_weight" id="current_weight" value="'.$_SESSION['weight'].'" />');
		
		echo ('<input type="hidden" name="date" id="date" value="'.$_GET['date'].'" />');
		echo ('<input type="hidden" name="challenge" id="challenge" value="'.$_GET['id'].'" />');
		?>
		<tr><td>	
			
			Duration (minutes): <input type="text" name="duration" id="duration" maxlength="3" size="4" onBlur="javascript:calorie_calc()" /></td><td>		
			Add this exercise to my favorites list: <input type="checkbox" name="fav" id="fav" value="true" /></td>
			<tr><td><input type="button" name="calc" value="Calculate Calories Spent" onClick="javascript:calorie_calc()" /> </td><td>	<input type="submit" name="submit" value="Submit to Wellness Log" />
		</td></tr>			
		</table>
		<div id="total"></div>
		</form>
		</div>
		<br><br>
		
		<div class="entry">Add an exercise to the Dropdown List and to your weekly log.
		<table cellpadding="5" cellspacing="5">
     	<form method="post" name="food" action="javascript:submit_new_activity()">
		

		<tr><td>Type in an exercise to add here:</td>
			<td><input type="text" name="new_exer" id="new_exer" size="60" /></td></tr>
		<tr><td>Calories burned per HOUR:</td>
			<td><input type="text" name="calories" id="calories" /></td></tr>
		<tr><td>Weight:</td>
			<td><input type="text" name="weight" id="weight" /></td></tr>
		<tr><td valign="top">Duration you performed this exercise :</td>
			<td><input type="text" name="duration2" id="duration2" maxlength="3" size="4" /></td></tr>
		<tr><td>		
			Add this exercise to my favorites list:</td>
			<td><input type="checkbox" name="fav" id="fav" value="true" /></td></tr>

		<tr><td colspan="2" align="center">
		<input type="hidden" name="date" id="date" value="<?php echo $_GET['date'] ?>">
		<input type="hidden" name="challenge" id="challenge" value="<?php echo $_GET['id'] ?>">
		<input type="submit" name="submit" value="Add this item to the Dropdown List and Your log" /></table>
		</td></tr>
		</form>
		</div>
	</div><br />
	<div class="byline">
	 Note: Figures are based on moderate (as opposed to vigorous) activity. A heavier person burns more calories, so the same amount of physical activity can actually burn the same number of calories but more quickly. But remember, exercising harder and faster only increases the calories expended slightly. To burn more calories it is better to exercise for a longer time.<br />
<strong>
	Determining how many calories you burn is not an exact science. This number should only be used as an estimate of calorie expenditure.</strong>
	</div>
	<br /><br />
    </div>
</body>
</html>