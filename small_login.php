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
		<?php if ($_SESSION[eid]==''){ 
		if($_SESSION['error']!='')
			echo $_SESSION['error'];
		
		$_SESSION['error']='';
			?>
		<h4 class="title_red">Site Login</h4>
		<form name="login" method="post" action="login.php">
		EID: <input type="text" name="logineid" id="logineid" /><br>
		Password: <input type="password" name="password" id="password" /><br>
		<input type="submit" name="login" value="Login" onClick="javascript:login();" /></form><br />
		<font size=-1><a href="https://passwordhelp.domain.com" target="_blank">Forgot password?</a></font>
		<?php } 
		else {
			if($_SESSION['page'] !=''){
				$goto=$_SESSION['page'];
				$_SESSION['page']='';
			}
			else { $goto='fall_fitness.php'; }
			?>
		<script language="javascript" type="text/javascript">
			window.location="<?php echo $goto ?>";
		</script>
		<?php } ?>
		  </div>
    </div>
</body>
</html>
