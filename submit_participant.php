<?

	include_once ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');	
	include('../phpincludes/LDAP.class.php');
		$LDAP = new LDAP('CORP\\LdapUser',$Password,$ADhost);
		
	$email=$LDAP->getEmail($form_eid);
	$firstname=$LDAP->getFirstName($form_eid);
	$lastname=$LDAP->getLastName($form_eid);
	$dept=$LDAP->getDepartment($form_eid);

	$input_sql1 = "insert into participants values ('$form_eid','$firstname','$lastname','$email','$dept','$eid_challenge','$team')";
	//echo $input_sql1;
	$input_query = mysql_query($input_sql1);

	header("location:participant_list.php");	
?>