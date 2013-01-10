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
	<?php include ('includes/header.php'); ?>
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
        <h1 class="title">Search</h1>
		<div class="entry">
		<br /><br />
		<table border="0" align="center">
		<form name="new" action="submit_search.php" method="post">
		<?
				// search.php 
		$today= date("Y")."-".date("Y")."-".date("m")." ".date("d").":".date("i").":".date("s");
		$sql1 = "select * from wellness limit 1";
		$columns=q($sql1);
		$cols=@mysql_num_fields($columns);
		$rows=@mysql_num_rows($columns);
		for ($r=0;$c<$rows;$r++){
			for ($c=0;$c<$cols;$c++){
				$meta=mysql_fetch_field($columns, $c);
				$name=strtoupper(str_replace("_"," ",$meta->name));
				$field=$meta->name;
				$type=$meta->type;
				$max_length=$meta->max_length;
				$value=mysql_result($columns,$r,$c);
				if($field!='id'){
				
					if($field=='category'){
						echo("<tr><td>$name:</td><td><select name='$field'><option value=''>Please select one</option>");
						$result=q("select $field from categories order by $field asc");
						for($d=0;$d<@mysql_num_rows($result);$d++)
							echo("<option value='".mysql_result($result,$d,0)."'>".mysql_result($result,$d,0)."</option>");
							echo("</td></tr>");
					}
									
					else if($field=='title'){
						echo("<tr><td>$name:</td><td><input type='text' name='$field'></td></tr>");
					}

					else if($field=='description'){
						echo("<tr><td>$name:</td><td><input type='text' name='$field'></td></tr>");
					}
					else if($field=='last_update'){
					}

					
					else{
						if ($field!='user'){
						echo("<tr><td>$name:</td><td><select name='$field'><option value=''>Please select one</option>");
						$result=q("select distinct $field from wellness order by $field asc");
						for($d=0;$d<@mysql_num_rows($result);$d++)
							echo("<option value='".mysql_result($result,$d,0)."'>".mysql_result($result,$d,0)."</option>");
						echo("</td></tr>");
						}	
					}
				}
			}
		}
		echo("<input type='hidden' name='table' value='items'></td><tr>");
		
		echo("<tr><td colspan='2' align='center'><br><br><input type='submit' name='submit' value='Submit'></td><tr>");
		?>
		
		</form>
		</table>
		
        </div>
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
		  $recent_sql = "select * from wellness order by date_sent desc";
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
  </div>
  <!-- end page -->
</div>
<div id="footer">
  <p class="copyright">&copy;&nbsp;&nbsp;2009 Time Warner Cable Inc. All rights reserved.</p>
</div>
</body>
</html>
