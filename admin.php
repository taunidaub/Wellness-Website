<?
session_start();
if (isset($_SESSION[admin]))
	header("Location: admin_menu.php");

else { 

	$submit=$_REQUEST['Submit'];
	$eid=$_REQUEST['eid'];
	$eidpassword=$_REQUEST['eidpassword'];

	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	conn2('wellness');
	
	if ($submit=='Login'){
		include_once ("includes/functions.php");
		include("../phpincludes/LDAP.class.php");
		$login=LDAP_AUTH($eid, $eidpassword);
		if($login){
			$_SESSION['eid']=strtoupper($eid);
			$_SESSION['p']=$eidpassword;
			$_SESSION['email']=$LDAP->getEmail($eid);
			$_SESSION['firstname']=$LDAP->getFirstName($eid);
			$_SESSION['lastname']=$LDAP->getLastName($eid);
			$_SESSION['location']=$LDAP->getLocation($eid);

			$admin=@mysql_result(@mysql_query("select eid from admin where eid = '$eid'"),0);
			if($admin){
				$_SESSION["admin"]= $eid;
				header("Location: admin_menu.php");
			}		
			else{
				$_SESSION['error']= "<center><font color=\"#FF0000\" face=\"arial\" size=\"2\">";
				$_SESSION['error'].= "<font color='red'><b>Unauthorized access</b></font><br>
				Please contact HR for Access";
				$_SESSION['error'].="</font>";
				$_SESSION['error'].= "<br>";
				$_SESSION['error'].="</center>";		
			}
		}
		else{
			//this message is if no username/password pair is entered
			$_SESSION['error']=  "<center><font color=\"#FF0000\" face=\"arial\" size=\"2\">";
			$_SESSION['error'].=  "<font color='red'><b>Unauthorized access</b><br>Please enter a valid EID and Password combination - Please try again</font>";
			$_SESSION['error'].=  "</font>";
			$_SESSION['error'].=  "<br>";
			$_SESSION['error'].= "</center>";		
		}		
	}



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
        <h1 class="title">Health and Wellness Website Administration</h1>
		<?php echo $_SESSION['error']; ?>
	<form name='login' method='POST' action='admin.php'>
	<table align='center' width='75%'>
				<tr>
				<td>Employee ID (EID)</td>
				<td width="1">:</td>
				<td><input name="eid" type="text" id="eid"></td>
				</tr>
				<tr>
				<td>Password</td>
				<td>:</td>
				<td><input name="eidpassword" type="password" id="eidpassword"></td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><input type="submit" name="Submit" value="Login"></td>
				</tr>
				
	</table>
	</form>
    </div>
 <? } ?>
    </div>

    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
