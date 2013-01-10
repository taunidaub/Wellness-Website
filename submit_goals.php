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

if($_REQUEST[current_weight]<=$_REQUEST[goal])
	$met=1;
else
	$met=0;
		
$sql="insert into weight_tracking (`eid`,`weight`,`goal`,`met`,`date`) values  ('$eid','".$_REQUEST[current_weight]."','".$_REQUEST[goal]."',".$met.",'".$date."')";
	
$result=@mysql_query($sql);
header('location:'.$_SESSION['page']);
$_SESSION['page']='';
?>