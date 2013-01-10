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
		<?php if ($_SESSION[eid]==''){ 
			if($_SESSION['error']!='')
				echo "<h3 class='title_red'>".$_SESSION['error'] ."</h3>";
			
			$_SESSION['error']='';
			?>
		<h4 class="title_red">Site Login</h4>
		<form name="login" method="post" action="login.php">
		EID: <input type="text" name="logineid" id="logineid" />
		Password: <input type="password" name="password" id="password" />
		<input type="submit" name="login" value="Login" /><br />
		<div id="result"></div>
		</form>
		<font size=-1><a href="https://passwordhelp.domain.com" target="_blank">Forgot password?</a></font>
		<?php } 
		else {
			if($page!=''){
				$goto=$page;
				$page='';
			}
			else { $goto='summary.php'; }
			?>
		<script language="javascript" type="text/javascript">
			window.location="<?php echo $goto ?>";
		</script>
		<?php } ?>
		  </div>
    </div>
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
