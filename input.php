<?php
	session_start();
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

        <h2><a href="files/<?=$link?>">Latest Health and Wellness Newsletter</a></h2>
        <div class="entry">
		 <? echo("$title") ?>
		 <p class="byline">Posted on <?=$date?></p>

         <iframe src="files/<?=$link?>" width="100%" frameborder="0" height="600px">   </iframe>       
        </div>
      </div>
 
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
