<?
session_start();
if (!(isset($admineid)) || ($admineid == ''))
	header("Location: admin.php");

@extract($_POST);
include_once ("../../phpincludes/db.php");
include ("../includes/includedb.php");
conn2('diversity');	
	
include('../../phpincludes/LDAP.class.php');
$ADhost='';
$LDAP = new LDAP('CORP\\LdapUser',$Password,$ADhost);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Time Warner Cable Albany - Diversity and Inclusion Council </title>
<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
		<img src="../images/dilogo.png" />

			<h1>Diversity and Inclusion</h1>
			<p>	</p>
		</div>
	</div>
	<!-- end #header -->
	<?php include('../includes/admin_header.php') ?>
	<!-- end #menu -->
	<div id="page">
	<div id="content">
	<div class="post">
					<!--welcome part start here -->
<table width='100%'>
<tr><th valign="top">Name<br />Email: </th>
<th valign="top">Total</th>
<th valign="top">Bonus</th>
<th valign="top">Location</th></tr>

<?
$fp = fopen('winners.xls', 'w');
fwrite($fp, "EID\tName\tEmail\tCorrect\tBonus\tLocation\n");
$sql="select distinct eid from trivia_answers";
$result=@mysql_query($sql);
$total=0;
$bonus=0;
if(@mysql_num_rows($result)>0){
	for($x=0;$x<@mysql_num_rows($result);$x++){
		$win_eid=@mysql_result($result,$x,0);
		$email=$LDAP->getEmail($win_eid);
		$firstname=$LDAP->getFirstName($win_eid);
		$lastname=$LDAP->getLastName($win_eid);
		$location=$LDAP->getLocation($win_eid);
		$count=0;
		$max=mysql_result(mysql_query("select count(id) from trivia_questions"),0);
		$answers="select * from trivia_answers, trivia_questions where trivia_answers.question=trivia_questions.id and trivia_answers.answer=trivia_questions.correct_answer and eid='$win_eid' order by trivia_questions.id asc";
		//echo($answers."<br>".$max."<br>");
		$result2=@mysql_query($answers);
		$total=0;
		$bonus=0;
		if(@mysql_num_rows($result2)>0){
			
			for($y=0;$y<@mysql_num_rows($result2);$y++){
				if (mysql_result($result2,$y,1) !='6')
					$total++;
							
				if (mysql_result($result2,$y,1) == '6')
					$bonus++;

			}
			?>
			<tr><td valign="top">EID<? echo $win_eid ?><br /><g>Name: </g><? echo($firstname)?> <? echo($lastname)?><br />Email: <a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
			<td valign="top"><? echo($total)?></td>
			<td valign="top"><? echo($bonus)?></td>
			<td valign="top"><? echo($location)?></td></tr>
		
			<?

			fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$email."\t".$total."\t".$bonus."\t".$location."\n");
		}
	}
			
fclose($fp);

}		

?>
 			</table>
			<br /><br />
			<a href="winners.xls">Download Excel Spreadsheet</a>
			<br class="spacer" /> 
	</div>
	</div>
	</div>


	</div>
 	<!-- end #content -->
	<div id="sidebar">	<div align="center"><img src="images/twc_logo.png" /></div>
<div style="clear: both;">&nbsp;</div>
		<ul>
			<li>				
				<div style="clear: both;">&nbsp;</div>
				
			</li>
			<li>
			  <form id="searchform" method="post" action="../submit_search.php">
				<div>
				  <h2>Site Search</h2>
				 <div align="center">
				  <input type="text" name="s" id="s" size="15" value="" />
				  
				  <input type="submit" name="submit" value="Submit" />
				  </div>
				</div>
			  </form>

			<br />
			<br />
			<?php include ('../includes/sidebar.php') ?>
		</ul>
	</div>
	<!-- end #sidebar -->
</div>
</div>
</div>
	<!-- end #page -->
</div>
		<div style="clear: both;">&nbsp;</div>

<div id="footer">
  <p class="copyright">&copy;&nbsp;&nbsp;<? echo date('Y'); ?> Daub Designs All rights reserved.</p>
</div>	<!-- end #footer -->
</body>
</html>
