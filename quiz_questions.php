<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");
	
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	conn2('wellness');

	if(($DELETE=="YES")&&($_POST[questionid]!='')){
		mysql_query("delete from trivia_questions where id=".$_POST[questionid]);
		}

	else if (($_POST[Edit]=="Edit")&&($_GET[id]!='')){
		$id=$_GET[id];
		$number=$_REQUEST["number".$id];
		$question=${"question".$id};
		$correct_answer=${"correct_answer".$id};
		$choice_array=${"choice".$id};
		$choices=$choice_array[0].";";
		$choices.=$choice_array[1].";";
		$choices.=$choice_array[2].";";
		$choices.=$choice_array[3];
		mysql_query("update trivia_questions set question='$question',correct_answer='$correct_answer',choices='$choices', id=$id where id=$id");
	}

	else if (($_POST[Add]=="Add")&&($_GET[id]!='')){
		$id=$_GET[id];
		$number=${"number".$id};
		$question=${"question".$id};
		$correct_answer=${"correct_answer".$id};
		$choice_array=${"choice".$id};
		$choices=$choice_array[0].";";
		$choices.=$choice_array[1].";";
		$choices.=$choice_array[2].";";
		$choices.=$choice_array[3];
		$input_sql = 'insert into trivia_questions (id,question,correct_answer,choices) 
		values ("'.$id.'","'.$question.'","'.$correct_answer.'","'.$choices.'")';
		$input_query = mysql_query($input_sql);
		echo ($input_sql);
	}
	
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
    </div>    <!-- start content -->
    <div id="content">
    	<div class="post">
<?php	
	$sql = "SELECT * FROM trivia_questions";
	$result = @mysql_query($sql);
	$count=@mysql_num_rows($result);
	?>

	<center>Total Questions: <b><?php echo $count ?></b></center><br>
	<table width="100%" cellpadding=0 cellspacing=0 border=0 style="border:1px solid; border-color: black">								
	<?php
	for( $i = 0; $i < $row = @mysql_fetch_array($result); $i++) {
		$temp=explode(";",$row[choices]);
		if ($row[id]){
			print("<form method=\"POST\" ACTION=\"quiz_questions.php?id=$row[id]\">");
			print("<tr><td valign='top' nowrap><b>Question Number:</b></td><td valign='top'><input type='text' name='number".$row[id]."' value='".$row[id]."'></td></tr>");
			print("<tr><td valign='top' nowrap><b>Question:</b></td><td valign='top'><textarea cols='60' name='question".$row[id]."'>".$row[question]."</textarea></td></tr>");
			print("<tr><td valign='top' nowrap><b>Correct Answer:</b></td><td valign='top'><input type='text' size='40' name='correct_answer".$row[id]."' value='".$row[correct_answer]."'></td></tr>");
			print("<tr><td valign='top' nowrap><b>Incorrect Choices:</b></td><td valign='top'>");
			for ($t=0;$t<count($temp);$t++)
				echo('<input type="text"  size="40" name="choice'.$row[id].'['.$t.']" value="'.$temp[$t].'">');
			
			print("</td></tr>");
			
			print("<td valign='top' align=\"left\">
			<input type=\"hidden\" name=\"questionid\" value=\"$row[id]\">");
			print("<input type=\"Submit\" name='Edit' value=\"Edit\">");
			print("</td><td>Delete? <input type=\"checkbox\" name=\"DELETE\" value=\"YES\">");
			print("<input type=\"Submit\" name='Remove' value=\"Delete\">");
			print("</form></td>");

			print("</tr><tr><td colspan='2'><hr></td></tr>");
		}
	}
	if($_REQUEST['choices'])
	$temp2=$_REQUEST['choices'];
	else 
	$temp2=array(1,2,3,4);
	$count++;
	print("<td valign='top' align=\"left\">
	<form method=\"POST\" ACTION=\"quiz_questions.php?id=".$count."\">");
	
	print("<tr><td valign='top' nowrap><b>Question Number:</b></td><td valign='top'><input type='text' name='id' value='".$count."'></td></tr>");
	print("<tr><td valign='top' nowrap><b>Question:</b></td><td valign='top'><textarea cols='60' name='question".$count."'>".$_REQUEST[question]."</textarea></td></tr>");
	print("<tr><td valign='top' nowrap><b>Correct Answer:</b></td><td valign='top'><input type='text' size='40' name='correct_answer".$count."' value='".$_REQUEST[correct_answer]."'></td></tr>");
	print("<tr><td valign='top' nowrap><b>Incorrect Choices:</b></td><td valign='top'>");
	for ($t=0;$t<count($temp2);$t++)
	echo('<input type="text"  size="40" name="choice'.$count.'['.$t.']" value="'.$temp2[$t].'">');
	
	print("</td></tr>");
	
	print("<td valign='top' align=\"left\"><input type=\"Submit\" name='Add' value=\"Add\">");
	

	?>
	</table>
	</div>
	</div>
	<!-- end content -->
	<!-- start sidebars -->
	<div id="sidebarB" class="sidebar">
	</div>
	<!-- end sidebars -->
	<div style="clear: both;">&nbsp;</div>


<div id="footer">
  <p class="copyright">&copy;&nbsp;&nbsp;Daub Designs. All rights reserved.</p>
  <br />
</div>
</body>
</html>
