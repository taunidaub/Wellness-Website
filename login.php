<?php
session_start();
include('../phpincludes/LDAP.class.php');
if($_REQUEST[logineid]!='' && $_REQUEST[password]!=''){
	$ADhost='';
	if(LDAP_AUTH($_REQUEST[logineid], $_REQUEST[password])){
		$_SESSION['eid']=strtoupper($_REQUEST[logineid]);
		$_SESSION['p']=$_REQUEST[password];
		$_SESSION['email']=$LDAP->getEmail($_REQUEST[logineid]);
		$_SESSION['firstname']=$LDAP->getFirstName($_REQUEST[logineid]);
		$_SESSION['lastname']=$LDAP->getLastName($_REQUEST[logineid]);
		$_SESSION['location']=$LDAP->getLocation($_REQUEST[logineid]);
		$admin=@mysql_result(@mysql_query('select COUNT(eid) from admin where eid = "'.$_SESSION['eid'].'"'),0);
		if($admin>0)
			$_SESSION["admin"] = $_REQUEST[logineid];
		$challenge=@mysql_result(@mysql_query('select challenge from participants where eid = "'.$_SESSION['eid'].'"'),0);
		$_SESSION["challenge"] = $challenge;
		
		if($_SESSION[page]!=''){
			$goto=$_SESSION[page];
			$_SESSION[page]='';
			}
		else { $goto='fall_fitness.php'; }/**/

		
		
	}	
	else{
		$_SESSION['error']='Incorrect user name and password combination, please try again.';
		//echo "0";
	}
	
}
else{
	$_SESSION['error']='Please provide both your EID and password, please try again.';
	//echo "0";
}
if($page!=''){
	$goto=$page;
	$page='';
	}
else { $goto='login_form.php'; }

?>
		<script language="javascript" type="text/javascript">
			window.history.go(-1);
		</script>
		<?php 
?>
