<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");

@extract($_POST);
include_once ("includes/functions.php");
include_once ("../phpincludes/db.php");
include_once ("includes/includedb.php");
conn2('wellness');
	
include('../phpincludes/LDAP.class.php');
$ADhost='';
$LDAP = new LDAP('CORP\\'.$_SESSION['eid'],$_SESSION['p'],$ADhost);

	include ('includes/head.php');
?>

<body>
  <div id="page">
	<div id="wrapper">
	<?php include ('includes/header2.php'); ?>

  <!-- start page -->
    <div id="sidebarA" class="sidebar">
	 <ul>
        <li>
          <h2>Admin Menu</h2>
			<?php include ('admin_doc_menu.php') ?>
        </li>
      </ul>
    </div>
    <!-- start content -->
    <div id="content">
    	<div class="post">
<?
if($_GET[type]=='quiz'){
	?>
				
	<a href="winners.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Email</th>
	<th valign="top">Total</th>
	<th valign="top">Bonus</th>
	<th valign="top">Location</th></tr>
	
	<?php
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
				<tr><td valign="top">EID<? echo $win_eid ?><br /><g>Name: </g><? echo($firstname)?> <? echo($lastname)?></td>
				<td valign="top"><a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
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

				
	<?php } 
	else if($_GET[type]=='recipe'){
	?>
				
	<a href="recipes.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Email</th>
	<th valign="top">Recipe</th>
	<th valign="top">Location</th>
	<th valign="top">Date</th></tr>
	
	<?php
	$fp = fopen('recipes.xls', 'w');
	fwrite($fp, "EID\tName\tEmail\tRecipe\tLocation\tDate\n");
	$sql="select * from recipe order by date desc";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$email=$LDAP->getEmail($win_eid);
			$firstname=$LDAP->getFirstName($win_eid);
			$lastname=$LDAP->getLastName($win_eid);
			$location=$LDAP->getLocation($win_eid);
	
				?>
				<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ?><br /><g>Name: </g><? echo($firstname)?> <? echo($lastname)?></td>
				<td valign="top"><a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
				<td valign="top"><? echo(substr($row[recipe],0,500))?>...</td>
				<td valign="top"><? echo(substr($location,0,28))?></td>
				<td valign="top"><? echo($row['date'])?></td></tr>
			
				<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$email."\t".$row[recipe]."\t".$location."\t".$row['date']."\n");
			}
		}
				
	fclose($fp);	
	?>
				</table>
	<?php } 
		else if($_GET['type']=='tips'){
	?>
				
	<a href="tips.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Email: </th>
	<th valign="top">Tip</th>
	<th valign="top">Location</th>
	<th valign="top">Date</th></tr>
	
	<?php
	$fp = fopen('tips.xls', 'w');
	fwrite($fp, "EID\tName\tEmail\tType\tTip\tLocation\tDate\n");
	$sql="select * from tips order by date desc";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$email=$LDAP->getEmail($win_eid);
			$firstname=$LDAP->getFirstName($win_eid);
			$lastname=$LDAP->getLastName($win_eid);
			$location=$LDAP->getLocation($win_eid);
	
				?>
				<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ?><br /><g>Name: </g><? echo($firstname)?> <? echo($lastname)?></td>
				<td valign="top"><a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
				<td valign="top"><? echo($row[tip])?></td>
				<td valign="top"><? echo($row[type])?></td>
				<td valign="top"><? (substr($location,0,28))?></td>
				<td valign="top"><? echo($row['date'])?></td></tr>
			
				<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$email."\t".$row[type]."\t".$row[tip]."\t".$location."\t".$row['date']."\n");
			}
		}
				
	fclose($fp);
	?>
				</table>
	<?php } 
	else if($_GET[type]=='challenges'){
	?>
				
	<a href="challenges.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name</th>
	<th valign="top">Email</th>
	<th valign="top">Type</th>
	<th valign="top">Challenge</th>
	<th valign="top">Entry</th>
	<th valign="top">Location</th>
	<th valign="top">Date</th></tr>
	
	<?php
	$fp = fopen('challenges.xls', 'w');
	fwrite($fp, "EID\tName\tEmail\tType\tChallenge\tEntry\tLocation\tDate\n");
	$sql="select * from entries order by eid asc, type asc, challenge asc, timestamp desc";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			$win_eid=$row[eid];
			$email=$LDAP->getEmail($win_eid);
			$firstname=$LDAP->getFirstName($win_eid);
			$lastname=$LDAP->getLastName($win_eid);
			$location=$LDAP->getLocation($win_eid);
	
				?>
				<tr><td valign="top" nowrap="nowrap">EID: <? echo $win_eid ?><br /><g>Name: </g><? echo($firstname)?> <? echo($lastname)?></td>
				<td valign="top"><a href='mailto:<? echo($email)?>'><? echo($email)?></a></td>
				<td valign="top"><? echo($row[type])?></td>
				<td valign="top"><? echo($row[challenge])?></td>
				<td valign="top"><? echo($row[entry])?></td>
				<td valign="top"><? echo(substr($location,0,28))?></td>
				<td valign="top"><? echo($row['date'])?></td></tr>
			
				<?
	
				fwrite($fp, $win_eid."\t".$firstname." ".$lastname."\t".$email."\t".$row[type]."\t".$row[challenge]."\t".$row[entry]."\t".$location."\t".$row['date']."\n");
			}
		}
				
	fclose($fp);	
	?>
				</table>
	<?php }  
	else if($_GET[type]=='signups'){
	?>
				
	<a href="signup.xls">Download Excel Spreadsheet</a>
	<br /><br />
	<table width='100%'>
	<tr><th valign="top">Name & Email</th>
	<th valign="top" nowrap=nowrap>Partner 2</th>
	<th valign="top" nowrap=nowrap>Partner 3</th>
	<th valign="top" nowrap=nowrap>Partner 4</th>
	<th valign="top" nowrap=nowrap>Partner 5</th>
	<th valign="top" nowrap=nowrap>Partner 6</th>
	<th valign="top" nowrap=nowrap>Partner 7</th>
	<th valign="top" nowrap=nowrap>Partner 8</th>
	<th valign="top" nowrap=nowrap>Partner 9</th>
	<th valign="top" nowrap=nowrap>Partner 10</th>
	</tr>
	
	<?php
	$fp = fopen('challenges.xls', 'w');
	fwrite($fp, "EID\tName\tEmail\tPartner 1\tPartner 2\tPartner 3\tPartner 4\tPartner 5\tPartner 6\tPartner 7\tPartner 8\tPartner 9\n");
	$sql="select * from ahawalk";
	$result=@mysql_query($sql);
	if(@mysql_num_rows($result)>0){
		while($row=mysql_fetch_array($result)){
			?>
				<tr><td valign="top" nowrap="nowrap"><? echo($row[name])?> <br>
				<a href='mailto:<? echo($row[email])?>'><? echo($row[email])?></a></td>
				<td valign="top"><? echo($row[part2])?>&nbsp;</td>
				<td valign="top"><? echo($row[part3])?>&nbsp;</td>
				<td valign="top"><? echo($row[part4])?>&nbsp;</td>
				<td valign="top"><? echo($row[part5])?>&nbsp;</td>
				<td valign="top"><? echo($row[part6])?>&nbsp;</td>
				<td valign="top"><? echo($row[part7])?>&nbsp;</td>
				<td valign="top"><? echo($row[part8])?>&nbsp;</td>
				<td valign="top"><? echo($row[part9])?>&nbsp;</td></tr>
				<td valign="top"><? echo($row[part10])?>&nbsp;</td>
			
				<?
	
				fwrite($fp, $row[name]."\t".$row[email]."\t".$row[part1]."\t".$row[part2]."\t".$row[part3]."\t".$row[part4]."\t".
				$row[part5]."\t".$row[part6]."\t".$row[part7]."\t".$row[part8]."\t".$row[part9]."\n");
			}
		}
				
	fclose($fp);	
	?>
				</table>
	<?php }  ?>
	
	</div> 
    </div>
    <!-- end content -->
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
