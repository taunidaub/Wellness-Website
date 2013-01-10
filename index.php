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
    <!-- start content -->
    <div id="content">
      <div class="post">
        <h1 class="title">Welcome to the Health and Wellness Website</h1>
        <h3 class="title_red">Health &amp; Wellness Employee Network</h3>
        <div>Our mission is:  </div>
        <ul>
          <li>
            <div>To promote a healthy lifestyle for Company employees </div>
          </li>
          <li>Provide education and resources on health and wellness topics </li>
          <li>Provide opportunities to get in shape and stay fit </li>
          <li>Provide opportunities to network with other employees with similar health and wellness interests and goals </li>
        </ul>
        <h3 class="title_red">Why a Health and Wellness Employee Network?</h3>
        <div>
          <div>
            <ul>
              <li>Healthy employee is a happy employee </li>
              <li>Networking opportunities with co-workers </li>
              <li>Stress Reduction </li>
              <li>Work/Life Balance </li>
              <li>Get fit / Stay fit </li>
            </ul>
          </div>
        </div>
        <h2 class="title_red">Latest Health and Wellness Newsletters</h2>
		<? 
		$recent_sql = "select * from wellness order by date_sent desc limit 5";
		$recent_result=mysql_query($recent_sql);
		while($row=mysql_fetch_array($recent_result)){
			$title=$row[title];
			$date=$row[date_sent];
			$temp=explode("-",$date);
			$date1=$temp[1]."/".$temp[2]."/".$temp[0];
			$link= $row[document];
			$desc=str_replace("<BR>"," ",substr($row[description],0,80))."...";
			?>
	
			
			<div class="entry">
			 <a href="files/<?php echo $link?>"><?php echo("$title") ?></a>
			 <div class="byline">Posted on <?php echo $date?></div>  
			 <?php echo $desc ?>
			</div>
			
			
		<?php } ?>
		</div>
		</div>

    </div>
	</
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
