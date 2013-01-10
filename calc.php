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
        <h1 class="title">Calorie Calculators</h1>
		<h3 class="title_red">Food Calculator</h3>
		<div class="entry">
		A search of any food will bring up the full nutrition facts for that food such as calories, protein, carbs, fat, saturated fat and cholesterol.<br />
		Why exactly would you want to see your food's nutrition facts? The single most important factor in getting your weight to do exactly what you want it to do is calorie intake. Whether your goal is weight loss, weight gain or just maintaining your current weight, the one factor playing the biggest role in making this happen is the number of calories you are eating.	<br />
		<a href="diet.php">Click here to begin</a>		
		</div>

		<h3 class="title_red">Exercise Calculator</h3>
		<div class="entry">
		Have you ever wondered how many calories you burned while participating in some type of exercise or activity? <br />
		If your goal is weight loss, it's helpful to know how many calories you burn with exercise and daily activities. The more calories you burn, the easier it is to lose weight and every activity counts, although some count more than others. This calculator can give you an estimate of how many calories you burn during different exercises. These are only estimates and there are many factors that contribute to weight loss that some calculators can't account for such as fitness level, body fat percentage, age and gender. <br />	
		<a href="exercise.php">Click here to begin</a>	
		</div>
		</div>
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
  <p class="copyright">&copy;&nbsp;&nbsp;2009 - <?php echo date('Y')?> Daub Designs. All rights reserved.</p>
  <br />
</div>
  </div>
  <!-- end page -->
</div>
</body>
</html>
