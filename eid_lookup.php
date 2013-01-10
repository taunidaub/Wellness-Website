<?php
		include_once ("../phpincludes/db.php");
		include ("includes/includedb.php");
		conn2('wellness');	
			
		include('../phpincludes/LDAP.class.php');
		$ADhost='';
		$ds = LDAPConnect('LdapUser',$Password);
		$Perms = 3;
		$dn = 'OU=Company Divisions,DC=corp,DC=domain,DC=com';					// Set the base DN
		$justthese = array("cn", "displayname","department","division");	

		$lookfor='(mail='.$_REQUEST[email].'*)';
		$filter='(&(objectCategory=*)(objectClass=*) '.$lookfor.' (cn=E*))';			// Create the filter (more Detal = faster)
		$sr=ldap_search($ds, $dn, $filter,$justthese);
		$info = @ldap_get_entries($ds, $sr);
			for($x=0;$x < count($info)-1;$x++){
				$arr[$x]['eid']=$info[$x]['cn'][0];
				$arr[$x]['name']=$info[$x]['displayname'][0];
				$arr[$x]['department']=$info[$x]['department'][0];
				$arr[$x]['division']=$info[$x]['division'][0];
			}
			echo json_encode($arr);
		
?>
