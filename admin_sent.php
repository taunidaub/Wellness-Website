<?
session_start();

include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
conn2('wellness');

print("<font color=white>Updating database...please wait...<br>");

$description = str_replace("\n", "<BR>", $description);
$description = str_replace("<BR><BR>", "<BR>", $description);
$description = str_replace("<BR><BR>", "<BR>", $description);
$description = str_replace("<BR><BR>", "<BR>", $description);
$date_sent = date("$s_year")."-".date("$s_month")."-".date("$s_day");

if ($newcategory!=''){
	 $category=$newcategory;
	 mysql_query("insert into categories values('$newcategory')");
}
if($weblink!=1)
	$weblink=0;
	
$input_sql = "insert into $info_table values ('','$title','$description','$category','$division','$date_sent','$attach_name','$weblink','".$_SESSION['firstname']." ". $_SESSION['lastname']."','')";
$input_query = mysql_query($input_sql);
//echo("$input_sql<br>$input_query");

if ($attach) {
	
	copy($attach, "/var/www/wellness/files/".$attach_name) 
		or die("<body bgcolor=\"black\">Couldn't upload the <u>$attach_name</u> file!</body>");  
	echo "<br>$attach_name attachment uploaded";
} else {
	
	echo "<br>No attachment specified...";
}

?>
</font>

<html>
<head>
<body bgcolor="#000000">
<META HTTP-EQUIV="refresh" CONTENT="2;URL='admin_menu.php'">
</body>
</head>
</html>