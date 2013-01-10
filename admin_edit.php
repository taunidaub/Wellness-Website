<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");
	
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	conn2('wellness');

$count_wellness_sql = "SELECT * FROM $info_table order by date_sent asc";
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
 <script type="text/javascript" language="javascript">
function boldThis(from) {
		strSelection = document.selection.createRange().text
		if (strSelection == "") {
			document.enter1.description.focus()
			strSelection = prompt("Enter the text you want bolded","")
				document.selection.createRange().text = "<b>" + strSelection + "</b>"
		}	
		else document.selection.createRange().text = "<b>" + strSelection + "</b>"
		return;
	}
	
function italicThis(from) {
		strSelection = document.selection.createRange().text
		if (strSelection == "") {
			document.enter1.description.focus()
			strSelection = prompt("Enter the text you want Italic","")
				document.selection.createRange().text = "<i>" + strSelection + "</i>"
		}
		else document.selection.createRange().text = "<i>" + strSelection + "</i>"
		return;
	}
	
function emailThis(from) {
		strSelection = document.selection.createRange().text
		if (strSelection == "") {
			document.enter1.description.focus()
			strSelection = prompt("Enter the email address you want linked","")
				document.selection.createRange().text = "<a href=\"mailto:" + strSelection + "\">" + strSelection + "</a>"
		}
		else document.selection.createRange().text = "<a href=\"mailto:" + strSelection + "\">" + strSelection + "</a>"
		return;
	}
	
function linkThis(from) {
		strSelection = document.selection.createRange().text
		if (strSelection == "") {
			document.enter1.description.focus()
			strSelection = prompt("Enter the web address you want to link to","")
			str2Selection = prompt("Enter the text you want linked","")
				document.selection.createRange().text = "<a href=\"" + strSelection + "\">" + str2Selection + "</a>"
		}
		else document.selection.createRange().text = "<a href=\"" + strSelection + "\">" + str2Selection + "</a>"
		return;
	}
	
function centerThis(from) {
		strSelection = document.selection.createRange().text
		if (strSelection == "") {
			document.enter1.description.focus()
			strSelection = prompt("Center the text you want","")
				document.selection.createRange().text = "<center>" + strSelection + "</center>"
		}
		else document.selection.createRange().text = "<center>" + strSelection + "</center>"
		return;
	}
	
function rightThis(from) {
		strSelection = document.selection.createRange().text
		if (strSelection == "") {
			document.enter1.description.focus()
			strSelection = prompt("Align right the text you want","")
				document.selection.createRange().text = "<div align='right'>" + strSelection + "</div>"
		}
		else document.selection.createRange().text = "<div align='right'>" + strSelection + "</div>"
		return;
	}
</script>

<?
$sql = "SELECT * FROM $info_table where id='$id'";
//echo($sql);
$query = mysql_query($sql);
//echo("<br>$query");
$row = mysql_fetch_array ($query);

?>
<form enctype="multipart/form-data" method="POST" ACTION="admin_edit_sent.php?id=<? print("$id"); ?>">
<TABLE BORDER=0 WIDTH="90%" CELLSPACING="2" CELLPADDING="5">
<TR><TD VALIGN=TOP>
<?
if ($row[hide] == '1'){
echo "<FONT FACE=\"arial,helvetica\" SIZE=2><strong></FONT>";
echo "</TD><TD VALIGN=TOP>";
echo "<input type=\"hidden\" name=\"hide\" value=\"1\" checked>";
} else {
echo "<FONT FACE=\"arial,helvetica\" SIZE=2></FONT>";
echo "</TD><TD VALIGN=TOP>";
echo "<input type=\"hidden\" name=\"hide\" value=\"1\">";
}
?>
</TD></TR>
<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Category</strong></FONT>
</TD><TD VALIGN=TOP>
<?
$newresult=mysql_query("select * from categories order by category asc") or die(mysql_error());
echo('Select one: <select name="category">');

for( $i = 0; $i < $new = mysql_fetch_array($newresult); $i++) {
	if ($new['category']==$row['category'])
		echo("<option selected>".$new[category]."</option>");
	else
		echo("<option>".$new[category]."</option>");
	}
?>
	</select>
<br />

Type a new one: <input type="text" name="newcategory" size=32 value="<? echo "$row[category]"; ?>">
</TD></TR>
<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Division</strong></FONT>
</TD><TD VALIGN=TOP>
Select one: <select name="division">
<option selected="selected"><?=$row['division']?>
<option>Albany</option>
<option>Central NY</option>
<option>Kansas City</option>
<option>New England</option>
<option>Western NY</option>
</select>
</TD></TR>

<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Title:</strong></FONT><br>
</TD><TD VALIGN=TOP>
<input type="text" name="title" size='55' maxlength='255' value='<?=$row[title]?>'><br />
<? echo "$row[title]"; ?></TD></TR>

<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Description or Weblink:</strong></FONT>
</TD><TD VALIGN=TOP>
<textarea NAME="description" ROWS=10 COLS=45 WRAP="VIRTUAL"><? echo "$row[description]"; ?></textarea>
<br><img src="images/bold.gif" border="0" onClick="boldThis(1)">&nbsp;|&nbsp;
<img src="images/italic.gif" border="0" onClick="italicThis(1)">&nbsp;|&nbsp;
<img src="images/center.gif" border="0" onClick="centerThis(1)">&nbsp;|&nbsp;
<img src="images/right.gif" border="0" onClick="rightThis(1)">&nbsp;|&nbsp;
<img src="images/email.gif" border="0" onClick="emailThis(1)">&nbsp;|&nbsp;
<img src="images/link.gif" border="0" onClick="linkThis(1)">&nbsp;|&nbsp;
<b>&lt;HR&gt;</b>
</TD></TR>

<?			
$date=$row[date_sent];
$temp=explode("-",$date);
$date_formated 		=$temp[1]."/".$temp[2]."/".$temp[0];
?>

<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Date of Notification</strong>:</FONT>
</TD><TD VALIGN="TOP">
Current Date Sent: <? echo "$date_formated"; ?><br>
<SELECT NAME="s_month">
		<OPTION SELECTED value="no">Month:
		<OPTION VALUE="1">Jan
		<OPTION VALUE="2">Feb
		<OPTION VALUE="3">March
		<OPTION VALUE="4">April
		<OPTION VALUE="5">May
		<OPTION VALUE="6">June
		<OPTION VALUE="7">July
		<OPTION VALUE="8">Aug
		<OPTION VALUE="9">Sept
		<OPTION VALUE="10">Oct
		<OPTION VALUE="11">Nov
		<OPTION VALUE="12">Dec
</select>
-
<SELECT NAME="s_day">
		<OPTION SELECTED value="no">Day:
		<OPTION VALUE="1">1
		<OPTION VALUE="2">2
		<OPTION VALUE="3">3
		<OPTION VALUE="4">4
		<OPTION VALUE="5">5
		<OPTION VALUE="6">6
		<OPTION VALUE="7">7
		<OPTION VALUE="8">8
		<OPTION VALUE="9">9
		<OPTION VALUE="10">10
		<OPTION VALUE="11">11
		<OPTION VALUE="12">12
		<OPTION VALUE="13">13
		<OPTION VALUE="14">14
		<OPTION VALUE="15">15
		<OPTION VALUE="16">16
		<OPTION VALUE="17">17
		<OPTION VALUE="18">18
		<OPTION VALUE="19">19
		<OPTION VALUE="20">20
		<OPTION VALUE="21">21
		<OPTION VALUE="22">22
		<OPTION VALUE="23">23
		<OPTION VALUE="24">24
		<OPTION VALUE="25">25
		<OPTION VALUE="26">26
		<OPTION VALUE="27">27
		<OPTION VALUE="28">28
		<OPTION VALUE="29">29
		<OPTION VALUE="30">30
		<OPTION VALUE="31">31
</select>
-
<SELECT NAME="s_year">
		<OPTION SELECTED value="no">Year:</OPTION>
<?php

  /* Dynamic Year Selection - Added on Halloween by Ariel Giron */

 $this_year = date('Y');
  for ($i = 0; $i < $this_year-2005; $i++) {
    $option_value = $this_year - $i;
    echo "		<OPTION VALUE=\"$option_value\">$option_value\n</OPTION>";
  } 
  

?>
</select>
</TD></TR>
<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Weblink Only:</strong></FONT>
</TD><TD VALIGN=TOP>
<?php if($row[weblink]==1)
	$checked= "checked";
	?>
<input type="checkbox" <? echo $checked ?> name="weblink" value="1">
 - check box if no document
</TD></TR>
<TR><TD VALIGN=TOP>
<FONT FACE="arial,helvetica" SIZE=2><strong>Document:</strong></FONT>
</TD><TD VALIGN=TOP>
<input type="hidden" name="MAX_FILE_SIZE" value="50000000">
&nbsp;<input type="file" class=box name="attach" size="30" value="<? echo "$row[document]"; ?>">&nbsp;<? echo "<a href='files/$row[document]'>$row[document]</a>"; ?><br>
<input type="checkbox" name="attach_clear" size="30"> - check box to clear attachment
</TD></TR>

<TR><TD VALIGN=TOP COLSPAN=2 ALIGN=CENTER>
<input type="hidden" name="wellnessid" value="<? echo "$row[id]" ?>">
<input type="Submit" value="Send">
</TD></TR>
</TABLE>
</FORM>
		
	</div> 		
	</div> 
    </div>
    <!-- end content -->
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
