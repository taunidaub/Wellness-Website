<?
session_start();
$_SESSION['page'] = $_SERVER["REQUEST_URI"];

include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
include('../phpincludes/LDAP.class.php');
$ADhost='';
$LDAP = new LDAP('CORP\\LdapUser',$Password,$ADhost);

conn2('wellness');
switch ($table){
	case 'wellness':
		$columns[0]='title';
		$columns[1]='description';
		$columns[2]='document';
		$columns[3]='date_sent as date';
		break;

	case 'recipe':
		$columns[0]='"Recipe"';
		$columns[1]='recipe';
		$columns[2]='eid';
		$columns[3]='date';
		break;
	
	case 'tips':
		$columns[0]='type';
		$columns[1]='tip';
		$columns[2]='eid';
		$columns[3]='date';
		break;
	}

for($c=0;$c<count($columns);$c++)
	$cols.=$columns[$c].", ";

$cols=rtrim($cols,", ");
$select_sql = "select ".$cols." from ".$table." where id =".$id;
$select_result = mysql_query($select_sql);
?>
<html>
<head>
<title>Wellness Blog Post</title>
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" media="all" type="text/css" href="css/menu_style.css" />
<script type="text/javascript" src="http://albwww02.alb.domain.com/jsincludes/mootools-core-1.3.2.js"></script>
<script type="text/javascript" src="http://albwww02.alb.domain.com/jsincludes/mootools-more-1.3.2.1.js"></script>
<script type="text/javascript" src="includes/wellness.js"></script>
</head>
<body>
  <div id="page">
	<div id="wrapper">
		<div class="blog_post">

<?php
for($c=0;$c<=@mysql_num_fields($select_result);$c++){
	
	if($columns[$c]=='eid')
		echo "Submitted By: ". $LDAP->getFirstName(@mysql_result($select_result,0,$c))." ".$lastname=$LDAP->getLastName(@mysql_result($select_result,0,$c))."<br>";
		
	else if($columns[$c]=='document')
		echo "<a href='files/".@mysql_result($select_result,0,$c)."' target='_blank'>".@mysql_result($select_result,0,$c)."</a><br>";

	else if(strstr($columns[$c],'date')){
		$tempa=explode(" ",mysql_result($select_result,0,$c));
		$temp=explode("-",$tempa[0]);
		$tempb=explode(":",$tempa[1]);
		if($tempb[0]>12){
			$hour=$tempb[0]-12;
			$suffix="p.m.";
			}
		elseif($tempb[0]<12){
			$hour=$tempb[0];
			if($hour[0]==0)
				$hour=$hour[1];
			$suffix="a.m.";
		}
			else
				$suffix="a.m.";
			
			
		$date=$temp[1]."/".$temp[2]."/".$temp[0]." at " .$hour.":".$tempb[1]." ".$suffix;
		echo "Submitted on: ".$date."<br/><br/>";
		
		}
		
	else if(($columns[$c]=="title")||($columns[$c]=="type")||($columns[$c]=="Recipe")){
		$select_blog_info="select id, introduction from blog_posts where `table`='".$table."' and table_id =".$id;
		//echo $select_blog_info;
		$select_blog_result = @mysql_query($select_blog_info);
		//echo mysql_result($select_blog_result,0,0);
		$blog_id=@mysql_result($select_blog_result,0,0);
		$introduction=@mysql_result($select_blog_result,0,1);
		echo "<h3 class='title_red'>". ucwords(@mysql_result($select_result,0,$c))."</h3>";
		echo "<h4 class='title_green'>". $introduction."</h4>";
		}

	else 
		echo ucwords(@mysql_result($select_result,0,$c))."<br/>";
}
	
echo "</div>";

if ($_SESSION[eid]==''){ ?>		
	<h4 class="title_red">Login to reply to this post or begin your own <a href="http://wellness.alb.domain.com/interaction.php">discussion here</a>.</h4>
	<form action="login.php">
EID: <input type="text" name="logineid" id="logineid" />
	Password: <input type="password" name="password" id="password" />
	<input type="submit" name="login" value="Login" onClick="javascript:login();" /></form><br />
<?php 
} 
else if ($_SESSION[eid]!=''){ ?>
	<br />
	<form action="blog_post.php" method="post" name="blog" id="blog">
	<input type="hidden" name="blog_id" value="<?php echo $blog_id ?>">
	<table width='500px' align="center" class="quiz">
	<tr><td valign="top" nowrap="nowrap">Post a response to this blog: </td><td align="center" align="left"><textarea name="response" cols="60"></textarea></td></tr>
	
	<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit Response"></td></tr>	
	</table>
	</form>
	<h4 class="title_red">Have someting to say? <span class="title_blue">Start your own <a href="http://wellness.alb.domain.com/interaction.php">discussion here</a>.</span></h4>

	<?php
	}
	
$select_response_sql="select * from blog_responses where blog_id='".$blog_id."' and allowed = 1";
$select_response_result = @mysql_query($select_response_sql);
if(@mysql_num_rows($select_response_result)>0)
	while($responses=@mysql_fetch_array($select_response_result)){
		echo "<div class='post'><div class='entry'>";
		echo $responses['response']."<br>";
		echo "<div class='byline'>Submitted By: ". $LDAP->getFirstName($responses['eid'])." ".$lastname=$LDAP->getLastName($responses['eid'])."<br>";
		$tempa=explode(" ",$responses['date']);
		$temp=explode("-",$tempa[0]);
		$tempb=explode(":",$tempa[1]);
		if($tempb[0]>12){
			$hour=$tempb[0]-12;
			$suffix="p.m.";
			}
		elseif($tempb[0]<12){
			$hour=$tempb[0];
			if($hour[0]==0)
				$hour=$hour[1];
			$suffix="a.m.";
		}
			else
				$suffix="a.m.";
			
			
		$date=$temp[1]."/".$temp[2]."/".$temp[0]." at " .$hour.":".$tempb[1]." ".$suffix;
		echo "Submitted on: ".$date."</div></div></div>";

	}


?>

</div>
</div>
</body>
</html>