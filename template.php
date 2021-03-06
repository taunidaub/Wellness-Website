<?
	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Health and Wellness Website</title>
<meta name="keywords" content="" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<script src="../../jsincludes/mootools-core-1.3.2.js"></script>
<script src="../../jsincludes/mootools-more-1.3.2.1.js"></script>
<script src="includes/wellness.js" type="text/javascript"></script>
<script type = "text/javascript">

function validateForm(field)
{
	var str = document.getElementById(field).value;
	alert("Please fill in the " +document.getElementById(field).name+" field before submitting."); 
	if (str == ""){
		alert("Please fill in the " +document.getElementById(field).name+" field before submitting."); 
		return false;
	}
	return (true);
}
</script>

</head>
<body>
  <div id="page">
	<div id="wrapper">
	  <!-- start header --> 
	<?php include ('includes/header2.php'); ?>
	<!-- end header -->
  	<!-- start page -->
    <div id="sidebar1" class="sidebar">
	<br />
		<a href="index.php"><img src="images/wellness_logo.jpg" /></a>
<br /><br />
      <ul>
        <li>
          <form id="searchform" method="post" action="submit_search.php">
            <div>
              <h2>Site Search</h2>
             <div align="center">
			  <input type="text" name="s" id="s" size="15" value="" />
			  
			  <input type="submit" name="submit" value="Submit" />
			  </div>
            </div>
          </form>
        </li>
		<?php include ('includes/left-bar.php') ?>
      </ul>
    </div>
    <!-- start content -->
    <div id="content">
	<div class="post">
        <h1 class="title">Activity Calculator</h1>
		<? 
		$list_sql = "select id, name from exercise order by name asc";
		$list_result=mysql_query($list_sql);
		while ($list=mysql_fetch_array($list_result)){
			$options.='<option value="'.$list['id'].'">'.$list['name'].'</option>';
			}
		?>
     	<form method="post" name="exercise" action="javascript:calorie_calc()">
		Type in an exercise here:
			<br /><input type="text" name="lookup_exercise" id="lookup_exercise" onkeyup="javascript:exercise_lookup()" />
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
			<input type="submit" name="submit" value="Calculate" />
		</form>
		<div id="total"></div>
	<?php if ($_SESSION[eid]==''){ ?>
	<h4 class="title_red">Login to post your results.</h4>
		<form action="login.php">

	EID: <input type="text" name="logineid" id="logineid" />
	Password: <input type="password" name="password" id="password" />
	<input type="submit" name="login" value="Login" onclick="javascript:login();" /><br />
	<?php } ?>
	</div>
 
    </div>
    <!-- end content -->
    <!-- start sidebars -->
    <div id="sidebar2" class="sidebar">
      <ul>
	  <?php include ('includes/right-bar.php'); ?>
 	 </ul>
    </div>
    <!-- end sidebars -->
    <div style="clear: both;">&nbsp;</div>
<div id="footer">
  <p class="copyright">&copy;&nbsp;&nbsp;2009 - <?php echo date('Y')?> Time Warner Cable Inc. All rights reserved.</p>
  <br />
</div>
  </div>
  <!-- end page -->
</div>
</body>
</html>
