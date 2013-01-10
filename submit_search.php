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
    <div id="content">      <div class="post">
        <h1 class="title">Search Results</h1>
		<div class="entry">
		<? 
		$search=$HTTP_POST_VARS['search'];
		$category=$HTTP_GET_VARS['category'];
		if ($search !='')
			$search_sql = "select * from wellness where title like '%$search%' or description like '%$search%' or category like '%$search%'";
		else if ($category !='')
			$search_sql = "select * from wellness where category like '%$category%'";
		else
			$search_sql = "select * from wellness where title like '%$title%' or description like '%$description%' or category like '%$category%' or document like '%$document%' or date_sent like '%$date_sent%' or user like '%$user%'";
		
		$search_result=mysql_query($search_sql);
		for($x=0;$x<@mysql_num_rows($search_result); $x++){
			$title=mysql_result($search_result,$x,1);
			$desc=mysql_result($search_result,$x,2);
			$cat=mysql_result($search_result,$x,3);
			$div=mysql_result($search_result,$x,4);
			$date=mysql_result($search_result,$x,5);
			$temp=explode("-",$date);
			$date1=$temp[1]."/".$temp[2]."/".$temp[0];
		  	$link= mysql_result($search_result,$x,6);
			echo("<a href='files/$link' target='_blank'>$title</a><br>$date1&nbsp; - &nbsp;$cat&nbsp; - &nbsp;$div<br>
				Description: &nbsp; $desc ");
			}
			?>        
		</div>
      </div>
 
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
