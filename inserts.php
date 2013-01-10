<?
include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
conn2('wellness');

$breakfast=array("1007","280","914","1511","315","547");
$beverage=array("281","905","229","514","564");
$lunch=array("1498","200","1465","1473","881","854","888","895");
$salad=array("454","459","829");
$dressing=array("90", "2", "911");
$dinner=array("200","70","665","590","895","384","1467");
$veggies=array("109","459","906","1504","265","620");
$starch=array("1601","700","694","1517","1557","687","1481");
$water="1585";

$exercise= array("171","11","225","169","153","237");

for($x=mktime(0,0,0,6,11,2012);$x<mktime(0,0,0,06,15,2012);$x+=86400){
	$rand1=rand(0,count($breakfast)-1);
	$rand2=rand(0,count($beverage)-1);
	$rand3=rand(0,count($lunch)-1);
	$rand4=rand(0,count($salad)-1);
	$rand5=rand(0,count($dinner)-1);
	$rand6=rand(0,count($veggies)-1);
	$rand7=rand(0,count($starch)-1);
	$rand8=rand(0,count($exercise)-1);
	$rand9=rand(0,count($dressing)-1);
	$date=date("Y-m-d", $x);
	echo $date."<br>";
	$challenge=mysql_result(mysql_query("select id from challenge_timelines where start <= '".$date."' and end >= '".$date."' and challenge= 'Wellness Log'"),0);
echo	"select id from challenge_timelines where start <= '".$date."' and end >= '".$date."' and challenge= 'Wellness Log'<br>";
	$sql1="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$breakfast[$rand1]."','1','Breakfast','".$challenge."')"; 
	$sql2="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$beverage[$rand2]."','2','Beverages','".$challenge."')"; 
	$sql3="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','1585','4','Beverages','".$challenge."')"; 
	$sql4="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$lunch[$rand3]."','1','Lunch','".$challenge."')"; 
	$sql5="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$salad[$rand4]."','2','Lunch','".$challenge."')";
	$sql6="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$dressing[$rand9]."','2','Lunch','".$challenge."')";
	$sql7="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$dinner[$rand5]."','1','Dinner','".$challenge."')";
	$sql8="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$veggies[$rand6]."','2','Dinner','".$challenge."')";
	$sql9="insert into wellness_log (eid, date, food, servings, meal, challenge) values ('E101063','".$date."','".$starch[$rand7]."','1','Dinner','".$challenge."')";
	$sql10="insert into wellness_log (eid, date, exercise, duration, challenge) values ('E101063','".$date."','".$exercise[$rand8]."','20','".$challenge."')";
	$rand8=rand(0,count($exercise)-1);
	$sql11="insert into wellness_log (eid, date, exercise, duration, challenge) values ('E101063','".$date."','".$exercise[$rand8]."','40','".$challenge."')";
	for($v=1;$v<12;$v++){
		$var=${"sql".$v};
		echo ($var."<br>");
		mysql_query($var);
	}
	
}

?>

