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
<script type="text/javascript" src="../jsincludes/mootools-core-1.3.2.js"></script>
<script type="text/javascript" src="../jsincludes/mootools-more-1.3.2.1.js"></script>
<script type="text/javascript" src="includes/wellness.js"></script>
<script language="javascript">
function calorie_calc(){
	var selIndex = document.getElementById("select_food").selectedIndex;
	var id=document.getElementById("select_food").options[document.getElementById("select_food").selectedIndex].value;
	var amount=document.getElementById("amount").value;
	if(id=="")
		alert("Please select a food from the drop down");
	if(amount=="")
		alert("Please enter how many you ate.");
	else{
		calculate_food_calories(id,amount);
	}
}
</script>
</head>
<body>
  <div id="page">

	<div id="wrapper">
	  <!-- start header --> 
	<?php include ('includes/header2.php'); ?>
	<!-- end header -->
	</div> 

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
        <li>
          <h2>Categories</h2>
          <ul>
		  <? 
		  $cat_sql = "select * from categories order by category asc";
		  $cat_result=mysql_query($cat_sql);
		  for($x=0;$x<@mysql_num_rows($cat_result); $x++){
			$category=mysql_result($cat_result,$x,0);
			$count_sql = "select count(id) from wellness where category='$category'";
			//echo($count_sql);
			$count=mysql_result(mysql_query($count_sql),0);
			echo("<li><a href='submit_search.php?category=$category'>$category ($count)</a></li>");
			}
			?>
          </ul>
        </li>
      </ul>
    </div>
    <!-- start content -->
    <div id="content">
      <div class="post">
        <h1 class="title">Food Calorie Calculator</h1>
				<div class="entry">Use the calorie calculator to search over 900 different foods and discover how many calories are in your favorites. Simply enter an food into the search field (ex. Bicycling) or select one from the drop down menu below. Then enter your weight and the amount of time you spend exercising to estimate the calories you have burned. </div>

		<? 
		$list_sql = "select id, name, serving_size from diet order by name asc";
		$list_result=mysql_query($list_sql);
		while ($list=mysql_fetch_array($list_result)){
			$options.='<option value="'.$list['id'].'">'.$list['name'].'-'.$list['serving_size'].' serving</option>';
			}
		?>
     	<form method="post" name="food" action="javascript:calorie_calc()">
		Type in a food here:
			<br /><input type="text" name="lookup_food" id="lookup_food" onkeyup="javascript:food_lookup()" />
			<br />
			or select one from the drop down below:<br />
			<select name="select_food" id="select_food">
				<option value="" selected="selected">Please select one.</option>
				<?php echo $options ?>
			</select>
			<br />		
			Number of items: <input type="text" name="amount" id="amount" maxlength="3" size="4" />
			<br />
			<input type="submit" name="submit" value="Calculate" />
		</form>
		<div id="total"></div>
	  </div>
    </div>
    <!-- end content -->
    <!-- start sidebars -->
    <div id="sidebar2" class="sidebar">
      <ul>
        <li>
          <h2>Recent Posts</h2>
          <ul>
		  <? 
		  $recent_sql = "select * from wellness order by date_sent desc limit 15";
		  $recent_result=mysql_query($recent_sql);
		  for($x=0;$x<@mysql_num_rows($recent_result); $x++){
			$title=mysql_result($recent_result,$x,1);
			$date=mysql_result($recent_result,$x,5);
			$temp=explode("-",$date);
			$date1=$temp[1]."/".$temp[2]."/".$temp[0];
		  	$link= mysql_result($recent_result,$x,6);
			echo("<li><a href='files/$link' target='_blank'>$title</a> - $date1</li>");
			}
			?>
          </ul>
        </li>
 	 </ul>
    </div>
    <!-- end sidebars -->
    <div style="clear: both;">&nbsp;</div>
<div id="footer">
  <p class="copyright">&copy;&nbsp;&nbsp;2009 Time Warner Cable Inc. All rights reserved.</p>
</div>
  </div>
  <!-- end page -->
</div>
</body>
</html>
