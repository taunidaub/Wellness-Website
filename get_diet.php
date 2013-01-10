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
	$current_date_info=get_challenge_week('2012-04-10');//date('Y-m-d')
	if($current_date_info['week']==$date_info['week'])
		$current_weight=true;
	else 
	$current_weight=false;
}


?>



<body>
<script language="javascript">
 window.opener.location.reload(true);
</script> 
 <div id="page">
	<div id="wrapper">

        <h1 class="title">Food Log</h1>
				<div class="entry">Simply enter an food into the search field  or select one from the drop down menu below. Then select the meal it was for and click add. Your profile will be updated immediately and you can continue to add items until you are finished.</div>

		<? 
		$list_sql = "select id, name, serving_size from diet order by name asc";
		$list_result=mysql_query($list_sql);
		while ($list=mysql_fetch_array($list_result)){
			$options.='<option value="'.$list['id'].'">'.$list['name'].'-'.$list['serving_size'].' serving</option>';
			}
		$fav_list_sql = "select diet.id, name from diet, favorites where favorites.eid='".$_SESSION['eid']."' and favorites.table = 'diet' and diet.id=favorites.id order by name asc";
		$fav_list_result=@mysql_query($fav_list_sql);
		$fav_options='';
		while ($fav_list=@mysql_fetch_array($fav_list_result)){
			$fav_options.='<option value="'.$fav_list['id'].'">'.$fav_list['name'].'</option>';
			}
		?>
     	<form method="get" name="add_a_food" action="submit.php" return="javascript:submit_food()">
		<input type="hidden" name="table" value="wellness_log">
     	<table cellpadding="5" cellspacing="5">
		<?php if ($fav_options!=''){ ?>
		<tr><td>Select from your saved favorites: 
		</td><td><select name="fav_select_food" id="fav_select_food">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $fav_options ?>
			</select>
		</td></tr>
		<tr><td>Show all foods:</td><td><input type="checkbox" name="showall" id="showall" onClick="javascript:show_div('addfoods');show_div('addfoods1');" /></td></tr>
		<tr id="addfoods" style="display:none"><td>Type in a food here</td><td>and/or select one from the drop down below:</td></tr>
		<tr id="addfoods1" style="display:none"><td><input type="text" name="lookup_food" id="lookup_food" onKeyUp="javascript:food_lookup()" /></td>
		<td><select name="select_food" id="select_food">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $options ?>
			</select>
		</td></tr>		
		<? } 
		else { ?>
		<tr><td>Type in a food here</td><td>and/or select one from the drop down below:</td></tr>
		<tr><td><input type="text" name="lookup_food" id="lookup_food" onKeyUp="javascript:food_lookup()" /></td>
		<td><select name="select_food" id="select_food">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $options ?>
			</select>
		</td></tr>	
		<? } ?>
		<tr><td valign="top">Number of servings: <input type="text" name="servings" id="servings" maxlength="3" size="4" /></td>
		<td>Meal: <select name="selected_meal" id="selected_meal">
				<option value="Not Selected" selected="selected">Please select one.</option>
				<option>Breakfast</option>
				<option>Morning Snack</option>
				<option>Lunch</option>
				<option>Afternoon Snack</option>
				<option>Dinner</option>
				<option>Evening Snack</option>
				<option>Beverages</option>			
			</select>
		</td></tr>
		<tr><td>		
			Add this food to my favorites list:</td>
			<td><input type="checkbox" name="fav" id="fav" value="true" /></td></tr>
		
		<tr><td colspan="2" align="center">
		<input type="hidden" name="date" id="date" value="<?php echo $_GET['date'] ?>">
		<input type="hidden" name="challenge" id="challenge" value="<?php echo $_GET['id'] ?>">
		<input type="button" name="submit" value="See Calories" onClick="javascript:food_calc()" /><input type="submit" name="submit" value="Add to Log" />
		</td></tr>
		</table>
		</form>
		<div id="total"></div>
		
		<br /><br />
		<div class="entry">Add a food item to the Food List and to your weekly log.</div>
     	<form method="post" name="food" action="javascript:submit_new_food()">
		<table cellpadding="5" cellspacing="5">

		<tr><td>Type in a food here:</td>
			<td><input type="text" name="new_food" id="new_food" size="60" /></td></tr>
		<tr><td>Serving Size:</td>
			<td><input type="text" name="s_size" id="s_size" /></td></tr>
		<tr><td>Calories:</td>
			<td><input type="text" name="calories" id="calories" /></td></tr>
		<tr><td>Fat:</td>
			<td><input type="text" name="fat" id="fat" /> grams</td></tr>
		<tr><td>Saturated Fat:</td>
			<td><input type="text" name="s_fat" id="s_fat" /> grams </td></tr>
		<tr><td>Carbohydrates:</td>
			<td><input type="text" name="carbs" id="carbs" /> grams</td></tr>
		<tr><td valign="top">Number of servings:</td>
			<td><input type="text" name="servings2" id="servings2" maxlength="3" size="4" /></td></tr>
		<tr><td>Meal:</td>
			<td><select name="select_meal2" id="select_meal2">
				<option value="" selected="selected">Please select one.</option>
				<option>Breakfast</option>
				<option>Morning Snack</option>
				<option>Lunch</option>
				<option>Afternoon Snack</option>
				<option>Dinner</option>
				<option>Evening Snack</option>
				<option>Beverages</option>			
			</select>
		</td></tr>
		<tr><td>		
			Add this food to my favorites list:</td>
			<td><input type="checkbox" name="fav" id="fav" value="true" /></td></tr>
		<tr><td colspan="2" align="center">
		<input type="hidden" name="date2" id="date2" value="<?php echo $_GET['date'] ?>">
		<input type="hidden" name="challenge" id="challenge" value="<?php echo $_GET['id'] ?>">
		<input type="submit" name="submit" value="Add this item to the Dropdown List and Your log" />
		</td></tr>
		</table>
		</form>
		
			
    </div>
  </div>
  <!-- end page -->
</body>
</html>
