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

	  <?php 
		$date_today=mktime(date('H'),date('i'),00,date('n'),date('j'), date('Y'));		
	  
	  	if(($_SESSION['eid']=="")|| ($_SESSION['challenge']=='')){ ?>
	   <h2 class="title">Ready, Set, Walk Challenge</h2><div style="float:right"><img src="images/50points.png"></div>
	   <p><strong>Ready, Set, Walk Challenge </strong><br>
	     Experts say a person should try to walk 10,000 steps per day.    Not quite there?  Grab a pedometer and hook it to your belt to  see how   far you walk each day.  This  challenge helps build awareness of how   much you walk each day in hope that you  will get up a few more times   than normal throughout the day!  Way to do this:</p>
	   <ul>
         <li>Walk during your lunch time</li>
	     <li>Instead of calling a co-worker, walk to their  desk</li>
	     <li>Park further away from the building than usual</li>
	     <li>Take the stairs instead of the elevator</li>
        </ul>
	   <p>This challenge will run from April 16 – April 29</p>
	   <?php  }
	else {
	?>
        <h2 class="title">Ready, Set, Walk Challenge – <?php echo ucwords(str_replace("_"," ",$_SESSION['challenge'])) ?> Challenge</h2><div style="float:right"><img src="images/50points.png"></div>
        <p align="left">Try to walk 10,000 steps per day! <br>
		Available from April 16th to April 29nd.</p>
		<?php
		$date=date('Y-m-d',$date_today);

		$select_weeks='select * from challenge_timelines where web_start <= "'.$date.'" and web_end >= "'.$date.'" and challenge="Ready, Set, Walk Challenge" order by week asc';
		//echo $select_weeks;
		$select_result=@mysql_query($select_weeks);
		if(@mysql_num_rows($select_result))
			while($row=@mysql_fetch_array($select_result)){
				$temp=explode("-",$row['start']);
				$start=mktime(00,01,01,$temp[1],$temp[2],$temp[0]);
		?>	
<br>
		<table border="1" cellpadding="3" width="100%">
		<form name="rswcw<?php echo $row[week] ?>" action="submit_rswc.php?week=<?php echo $row[week] ?>" method="post">
		<tr><th align="center" valign="middle" colspan="2"><h3 class="title_green" align="left">Ready, Set, Walk – Week <?php echo $row[week] ?> </h3></th></tr>
		<tr><th align="center" valign="middle">Day</th><th align="center">Number of Steps</th></tr>
		<?php	
			for($w=0;$w<7;$w++){
				$this_date=date('Y-m-d', ($start+($w*86400)));
				$display_date=date('m/d/Y', ($start+($w*86400)));
				$check_sql='select * from rswc where eid="'.$_SESSION[eid].'" and day="'.$this_date.'"';
				$check=@mysql_query($check_sql);
				if(@mysql_num_rows($check)>0){ ?>
				<tr><th align="center" valign="middle"><?php echo $display_date ?> </th><td align="center"><?php echo mysql_result($check,0,3) ?></td></tr>
				<?php
				}
				else{
			?>
			<tr><th align="center" valign="middle"><input type="hidden" name="date<?php echo $w ?>" value="<?php echo $this_date ?>">
			<?php echo $display_date ?> </th><td align="center"> <input type="text" name="d<?php echo $row[week] ?>steps<?php echo $w ?>" id="d<?php echo $row[week] ?>steps<?php echo $w ?>" /></td></tr>
			<?php }
			}
			$check2_sql='select * from goals where eid="'.$_SESSION[eid].'" and challenge_id="'.$row[id].'"';
			$check2=@mysql_query($check2_sql);
			if(@mysql_num_rows($check2)>0){ ?>
			<tr><th align="center" valign="middle">Goal for Next Week: </th><td align="center"><?php echo mysql_result($check2,0,3) ?></td></tr>
				<?php
			}
			else{
			?> 
			<tr><th align="center" valign="middle">Goal for Next Week: </th><td align="center"> <textarea name="w<?php echo $row[week] ?>goal" id="w<?php echo $row[week] ?>goal"></textarea>
			<input type="hidden" name="challenge" value="<?php echo $row[id] ?>"></td></tr>
			
			<?php } 
			if ($_SESSION[eid]!=''){ ?><tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" onClick="javascript:add_entry('rswcw<?php echo $row[week] ?>','<?php echo $row[week] ?>','<?php echo $row[id] ?>');" /></td></tr>
			<?php } ?>		
		</form>
		</table>
		<br>
	
		<?php
		}
	 } ?>
      <div id="result"></div>
</div>
    </div>
    <!-- end content -->

<?php include ('includes/footer.php'); ?>
</div>
</div>
</body>
</html>
