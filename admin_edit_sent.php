<?
session_start();
include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
conn2('wellness');
	
@extract($_POST);
$sql = "SELECT * FROM $info_table where id='$id'";
//echo($sql);
$query = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array ($query);

print("<font color=white>Updating database...please wait...<br><br>");

if ($attach){
$input_sql = "UPDATE $info_table set document='$attach_name' where id='$id'";
$input_query = mysql_query($input_sql);
}

$description = str_replace("\n", "<BR>", $description);
$description = str_replace("<BR><BR>", "<BR>", $description);
$description = str_replace("<BR><BR>", "<BR>", $description);
$description = str_replace("<BR><BR>", "<BR>", $description);


if ($s_month != "no" && $s_day != "no" && $s_year != "no"){
$human_start = date("$s_year")."-".date("$s_month")."-".date("$s_day");
} else {
$human_start = $row[date_sent];
}
 if ($newcategory!=''){
	 $category=$newcategory;
	 mysql_query("insert into categories values('$newcategory')");
}
if($weblink!=1)
	$weblink=0;
	
$sql = "UPDATE $info_table  set title='$title',description='$description',category='$category', weblink='$weblink',date_sent='$human_start', user='$username' where id='$id'";
$query = mysql_query($sql);
//echo($sql);

if ($attach) {
	//echo($attach);
	//echo("<br>copy($attach, \"/usr/local/www/employees/campaigns/files/\".$attach_name) ");
	
	copy($attach, "/usr/local/www/employees/wellness/files/".$attach_name) 
		or die("<body bgcolor=\"black\">Couldn't upload the <u>$attach_name</u> file!</body>");  
	echo "<br>$attach_name attachment uploaded";
} else {
	
	echo "<br>No attachment specified...";
}

?>

<html>
<head>
<body bgcolor="#000000">
<META HTTP-EQUIV="refresh" CONTENT="2;URL='admin_menu.php'"> 
</body>
</head>
</html>
</font>