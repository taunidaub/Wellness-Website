<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");

	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	conn2('wellness');


if (($DELETE == 'YES') && ($userid!='')){
	$input_sql = "DELETE FROM participants where eid='$userid'";
	$input_query = mysql_query($input_sql);
}

$count_wellness_sql = "SELECT * FROM participants";
$count_wellness_query = mysql_query($count_wellness_sql);
$count_wellness = mysql_num_rows($count_wellness_query);

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
        <h1 class="title">Health and Wellness Website Administration</h1>
			<div class="entry">

			<table width="100%" cellpadding=0 cellspacing=0 border=0 style="border:1px solid; border-color: black">
			<tr>
				<td nowrap="nowrap"><b>Name <br> Email</b></td>
				<td><b>Department</b></td>
				<td><b>Team</b></td>
				<td><b>Challenge</b></td>
				<td align="center"><strong>Delete</strong></td>
			</tr>
										
			<?
			
			$sql = "SELECT * FROM participants order by last asc, first asc";
			$result = mysql_query($sql);
					
			include('../phpincludes/LDAP.class.php');
		
			for( $i = 0; $i < $row = mysql_fetch_array($result); $i++) {
			
			$date=$row[date_sent];
			$temp=explode("-",$date);
			$date_formated =$temp[1]."/".$temp[2]."/".$temp[0];

				if ($row[eid]){
					$email=$row[email];
					$firstname=$row[first];
					$lastname=$row[last];
					$dept=$row[department];
					//mysql_query('update participants set first="'.$firstname.'", last="'.$lastname.'", department="'.$dept.'" , email="'.$email.'" where eid="'.$row[eid].'"');
					//echo ('update participants set first="'.$firstname.'", last="'.$lastname.'", department="'.$dept.'" , email="'.$email.'" where eid="'.$row[eid].'"<br>');

					print("<tr>");
					print("<td valign='top'>$firstname $lastname<br>$email</td><td>$dept</td>");
					print("<td valign='top'>$row[team]</td>");
					print("<td valign='top'>$row[challenge]</td>");
						print("<td valign='top' align=\"right\">");
					print("	<form method=\"POST\" ACTION=\"participant_list.php\">
 							<input type=\"hidden\" name=\"userid\" value=\"$row[eid]\">");
					print("Verify? <input type=\"checkbox\" name='DELETE' id='DELETE' value='YES'>");
					print("<input type=\"Submit\" name='Remove' id='Remove' value='DELETE'>");
					print("</form></td>");
					print("</tr>");
				}
			}
			?>
			</table>
			<br />
			Add New User:
			<form action="submit_participant.php" method="post">
			<label for="behalf_check">Type their email address here:</label>
			<input type="text" name="email" id="email" value="Email Address" size="40"  onkeyup="javascript:eid_lookup()" /><br />
			<label for="behalf_check">Select correct user here:</label><select name="form_eid" id="form_eid" default="1">
			<option value="">Please type in an email address above</option>
			</select>	<br />
			<label for="behalf_check">Select challenge:</label><select name="eid_challenge" id="eid_challenge">
			<option value="get_fit">Get Fit</option>
			<option value="stay_fit">Stay Fit</option>
			</select>	<br />
			Team: <input type="text" name="team" id="team" value="" size='40'/><br />
			<input type="submit" name="submit" value="Submit" />
			</form>		
			</div>
		</div>
	</div>
    <!-- end content -->

<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>


</div>
</body>
</html>
