<?
session_start();
$_SESSION['page'] = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

if (!isset($_SESSION['eid']))
	header("location:login_form.php");
	

	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');
	$table=$_GET['table'];
	$eid=$_SESSION['eid'];

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
	<?
	if($table=='trivia_answers'){
		include('../phpincludes/LDAP.class.php');
		$date=date('Y-m-d H:i:s');
		
		for($x=1;$x<=$total;$x++){
			$sql="insert into $table values ('".$_SESSION[eid]."','$x','".$answer[$x]."','$date')";
			$result=@mysql_query($sql) ;
		}
								
		?>
		<div align="center">
				<h3 class="post-bgtop"> Your answers have been submitted.<br />Good luck and thank you for playing!</h3>	
		</div>
	<?php }
	else if($table=='recipe'){
		$date=date('Y-m-d H:i:s');			
		$recipe = str_replace("\n", "<BR>", $recipe);
		$recipe = str_replace("<BR><BR>", "<BR>", $recipe);
		$recipe = str_replace("<BR><BR>", "<BR>", $recipe);
		$recipe = str_replace("<BR><BR>", "<BR>", $recipe);

		$sql='insert into '.$table.' (`eid`,`recipe`,`date`) values ("'.$eid.'","'.$recipe.'","'.$date.'")';
		$result=@mysql_query($sql) ;
		//echo $sql;
	?>
		<div align="center">
		<h3 class="post-bgtop"> Your recipe has been submitted.<br />Thank you for taking the time to submit your Diverse Dessert recipe.</h3>	
		</div>
<?php }
	else if($table=='tips'){
		$date=date('Y-m-d H:i:s');
		$tip = str_replace("\n", "<BR>", $tip);
		$tip = str_replace("<BR><BR>", "<BR>", $tip);
		$tip = str_replace("<BR><BR>", "<BR>", $tip);
		$tip = str_replace("<BR><BR>", "<BR>", $tip);
		
		$sql='insert into '.$table.' (`eid`,`tip`,`type`,`date`) values ("'.$eid.'","'.$tip.'","'.$type.'","'.$date.'")';
		//echo $sql;			
		$result=@mysql_query($sql) ;
	?>
		<div align="center">
		<h3 class="post-bgtop"> Your tip has been submitted.<br />Thank you for taking the time to to participate.</h3>	
	</div>
<?php } ?>


	</div>
	</div>

    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>