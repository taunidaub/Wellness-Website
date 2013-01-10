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
</head>
<body>
  <div id="page">
	<div id="wrapper">
	  <!-- start header --> 
	<?php include ('includes/header.php'); ?>
	<!-- end header -->
	</div> 
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
        <h1 class="title">Welcome to the Health and Wellness Website</h1>
		<? 
		$recent_sql = "select * from wellness order by date_sent desc";
		$recent_result=mysql_query($recent_sql);
		$title=mysql_result($recent_result,0,1);
		$date=mysql_result($recent_result,0,5);
		$temp=explode("-",$date);
		$date1=$temp[1]."/".$temp[2]."/".$temp[0];
		$link= mysql_result($recent_result,0,6);
		$user=strtoupper(mysql_result($recent_result,0,7));
		?>

        <h2 class="title"><a href="files/<?=$link?>">Latest Health and Wellness Newsletter</a></h2>
        <div class="entry">
		 <? echo("$title") ?>
		 <p class="byline">Posted on <?=$date?></p>

         <iframe src="files/<?=$link?>" width="100%" frameborder="0" height="600px">   </iframe>       
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
