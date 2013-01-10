<?
session_start();

include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
conn2('wellness');

print("<font color='black'>Updating database...please wait...<br>");

$introduction = str_replace("\n", "<BR>", $introduction);
$introduction = str_replace("<BR><BR>", "<BR>", $introduction);
$introduction = str_replace("<BR><BR>", "<BR>", $introduction);
$introduction= str_replace("<BR><BR>", "<BR>", $introduction);
$date_sent = date("$s_year")."-".date("$s_month")."-".date("$s_day");


$input_sql = "insert into blog_posts values ('','$table','$selected','$introduction','')";
$input_query = mysql_query($input_sql);
//echo("$input_sql<br>$input_query");


?>
</font>

<html>
<head>
<body bgcolor="#FFFFFF">
<META HTTP-EQUIV="refresh" CONTENT="2;URL='admin_menu.php'">
</body>
</head>
</html>