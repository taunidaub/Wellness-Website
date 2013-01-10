<?

	include_once ("includes/functions.php");
	include ("includes/constants.php");
	include ("includes/includedb.php");
	$db = mysql_connect($dbHost, $dbUser, $dbPass); 
	mysql_select_db($dbName, $db);

print("<font color=white>Deleting job from database...please wait...</font>");

$input_sql = "DELETE FROM $userTable where(promo_id=$PROMO)";
$input_query = mysql_query($input_sql);
?>

<html>
<head>
<body bgcolor="#000000">
<META HTTP-EQUIV="refresh" CONTENT="2;URL='index.php'">
</body>
</head>
</html>