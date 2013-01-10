<?

	include_once ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');	
		
	include('../phpincludes/LDAP.class.php');
	$LDAP = new LDAP('CORP\\LdapUser',$Password,$ADhost);

	$email=$LDAP->getEmail($_REQUEST[form_eid]);
	$firstname=$LDAP->getFirstName($_REQUEST[form_eid]);
	$lastname=$LDAP->getLastName($_REQUEST[form_eid]);
	$dept=$LDAP->getDepartment($_REQUEST[form_eid]);
	if($_REQUEST[admin]=='Admin'){
		$input_sql1 = "insert into $admin_table values ('','$form_eid','$email','$firstname','$lastname','$dept','Admin')";
		$input_query = mysql_query($input_sql1);

	}
	

//	$input_sql = "insert into $admin_table values ('','$form_eid','$email','$firstname','$lastname','$dept','Member')";
//	$input_query = mysql_query($input_sql);

	header("location:member_list.php");	
?>