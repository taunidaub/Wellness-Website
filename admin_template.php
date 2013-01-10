<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");
	
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	conn2('wellness');

if (($DELETE == 'YES') && ($wellnessid!='')){
	$input_sql = "DELETE FROM $info_table where(id=$wellnessid)";
	$input_query = mysql_query($input_sql);
}

$count_wellness_sql = "SELECT * FROM $info_table order by date_sent asc";
$count_wellness_query = mysql_query($count_wellness_sql);
$count_wellness = mysql_num_rows($count_wellness_query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Health and Wellness Website</title>
<meta name="keywords" content="" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
  <div id="page">
	<div id="wrapper">
	  <!-- start header --> 
	<?php include ('includes/header2.php'); ?>
	<!-- end header -->
  </div>
  <!-- end header -->
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
        <h1 class="title">Wellness Website Administration</h1>
			<div class="entry">
			<center>Total Newsletters : <b><?=$count_wellness?></b><br>

			<table width="100%" cellpadding=0 cellspacing=0 border=0 style="border:1px solid; border-color: black">
										
			<?
			
			$sql = "SELECT * FROM $info_table order by date_sent desc";
			$result = mysql_query($sql);
			
			for( $i = 0; $i < $row = mysql_fetch_array($result); $i++) {
			
			$date=$row[date_sent];
			$temp=explode("-",$date);
			$date_formated =$temp[1]."/".$temp[2]."/".$temp[0];

				if ($row[id]){
					print("<tr><td valign='top'><b>Title:</b></td><td valign='top'>$row[title]</td><td valign='top' width='10%'><b>Date:</b></td><td valign='top'>$date_formated</td></tr>");
					print("<tr><td valign='top'><b>Category:</b></td><td valign='top'>$row[category]</td><td valign='top'><b>Division:</b></td><td valign='top'>$row[division]</td></tr>");
					print("");
					print("");
					print("<tr><td valign='top' colspan='4'><b>Weblink:</b><br><a href=\"files/".$row[document]."\" target ='_blank'><font size='-2'>	 http://wellness.alb.domain.com/files/".$row[document]."</font></a></td></tr>");
					print("<tr><td valign='top' colspan='2'><b>Description:</b> ".substr($row[description],0,120)."</td>");
					
					print("<td valign='top' align=\"right\" colspan='2'>
					<form method=\"POST\" ACTION=\"admin_edit.php?id=$row[id]\">");
					print("<input type=\"Submit\" name='Edit' value=\"Edit\">
					</form>");
					print("	<form method=\"POST\" ACTION=\"admin_menu.php\">
 							<input type=\"hidden\" name=\"wellnessid\" value=\"$row[id]\">");
					print("Delete? <input type=\"checkbox\" name=\"DELETE\" value=\"YES\">");
					print("<input type=\"Submit\" name='Remove' value=\"Delete\">");
					print("</form></td>");
					print("</tr><tr><td colspan='4'><hr></td></tr>");
				}
			}
			?>
			</table>
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebars -->
	<div id="sidebarB" class="sidebar">
	</div>
	<!-- end sidebars -->
	<div style="clear: both;">&nbsp;</div>
	</div>
<!-- end page -->
</div>

<div id="footer">
  <p class="copyright">&copy;&nbsp;&nbsp;2009 Daub Designs. All rights reserved.</p>
</div>
</body>
</html>
