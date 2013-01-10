<?
session_start();
$_SESSION[eid]='';
$_SESSION[admin]='';
$_SESSION[challenge]='';
session_destroy();
header("location:index.php");
?>