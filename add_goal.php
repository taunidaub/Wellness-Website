<?
session_start();

if (!isset($_SESSION['eid'])){
	$_SESSION['page'] = $_SERVER["REQUEST_URI"];
	header("location:login_form.php");
}
	
include_once ("includes/functions.php");
include ("../phpincludes/db.php");
include ("includes/includedb.php");
conn2('wellness');
$eid=$_SESSION['eid'];
$date=date('Y-m-d');

if($_REQUEST[goal]!='')
	$sql="insert into goals (`eid`,`challenge_id`,`goal`,`set_date`) values  ('$eid','".$_REQUEST[challenge_id]."','".$_REQUEST[goal]."','".$date."')";
	
else if($_REQUEST[accomplished]!='')
	$sql="update goals set accomplished=".$_REQUEST[accomplished] ." where `eid`='$eid' and `challenge_id`='".$_REQUEST[challenge_id]."'";

if($_REQUEST[accomplished2]!=''){
	$sql2="insert into goals (`eid`,`challenge_id`,`goal`,`set_date`,`accomplished`) values  ('$eid','".$_REQUEST[challenge_id]."','2.5 hours of exercise this week','".$date."','".$_REQUEST[accomplished2]."')";
	@mysql_query($sql2);
}


$result=@mysql_query($sql);
header('location:'.$_SESSION['page']);
$_SESSION['page']='';
?>