<?
session_start();
$_SESSION['page'] = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

if (!isset($_SESSION['eid']))
	header("location:login_form.php");
	

	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');
	$eid=$_SESSION['eid'];
	$blog_id=$_REQUEST['blog_id'];
	include ('includes/head.php');
?>

<body>
  <div id="page">
	<div id="wrapper">
    <!-- start content -->
	<div id="content">
	<div class="post">
	<?
		include('../phpincludes/LDAP.class.php');
		$date=date('Y-m-d H:i:s');
		$response = str_replace("\n", "<BR>", $_REQUEST['response']);
		$response = str_replace("<BR><BR>", "<BR>",$response);
		$response = str_replace("<BR><BR>", "<BR>", $response);
		$response = str_replace("<BR><BR>", "<BR>", $response);

		$sql='insert into blog_responses (`eid`,`blog_id`,`response`,`date`,`allowed`) values ("'.$eid.'","'.$blog_id.'","'.$response.'","'.$date.'","0")';
		$result=@mysql_query($sql) ;
		//echo $sql;
	?>
		<div align="center">
		<h3 class="post-bgtop"> Your response has been submitted.<br />It will be posted upon approval.</h3>
		<a href="javascript:history.go(-1)">Return to the original blog post</a><br>
		<a href="javascript:window.close()">Close this window</a>	
		</div>

	</div>
	</div>

    <!-- end content -->

<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>