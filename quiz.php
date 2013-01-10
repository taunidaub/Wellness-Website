<?
	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');

	include ('includes/head.php');
?>

<body>
  <div id="page">
	<div id="wrapper">
	<?php include ('includes/header2.php'); ?>
	<?php include ('includes/left-bar.php') ?>
    <!-- start content -->
    <div id="content">
	<div class="post">
	<?php
		include('includes/includedb.php');
		include('../phpincludes/LDAP.class.php');
		$sql="select * from trivia_questions order by id asc";

		$result=mysql_query($sql) or die(mysql_error);
		if(@mysql_num_rows($result)>0){
	?>
    <h2 class="title" align="center">Answer the most questions correctly, and you’ll be entered to win a prize!</h2>
	
	<h3 class="title_red" align="center">Good Luck!!</h3>
	<div class="post-bgtop" style="text-align:center">Please answer the multiple choice questions listed below. <br />Once you select the answers please click submit.</div>
<br />
		<?php if ($_SESSION[eid]==''){ ?>		<h4 class="title_red">Login to post your quiz.</h4>
		<form action="login.php">
EID: <input type="text" name="logineid" id="logineid" />
		Password: <input type="password" name="password" id="password" />
		<input type="submit" name="login" value="Login" onClick="javascript:login();" /></form><br />
		<?php } else { ?>
<br />
<form action="insert.php?table=trivia_answers" enctype="multipart/form-data" method="post" name="quiz" id="quiz" onSubmit="return validateForm();">
		<table width='80%' align="center" class="quiz">
		<?
			for($x=0;$x<@mysql_num_rows($result);$x++){
				$id=mysql_result($result,$x,0);
				$question=mysql_result($result,$x,1);
				$correct=mysql_result($result,$x,2);
				$choices=mysql_result($result,$x,3);
				$temp=explode(";",$choices);
				$place=rand(0,(count($temp)-1));
				?>
				<tr><td valign="top" nowrap="nowrap">Question <? echo $id; ?>: </td><td align="center"><? echo $question ?></td></tr>
				<tr><td colspan="2" align="center">
		
				<select name='answer[<? echo $id ?>]' id='answer[<? echo $id?>]'>
				<? if ($_POST['answer'][$id] ==''){ ?>
				<option selected="selected" value="">Please choose one</option>
				<?  }
				else 
					echo("<option selected='selected' >".$_POST['answer'][$id]."</option>");
					
				
				for ($choice=0;$choice<count($temp);$choice++){
					if($choice==$place)
						echo("<option>".$correct."</option><option>".$temp[$choice]."</option>");
					else
						echo("<option>".$temp[$choice]."</option>");
				}
				?>
				</select>
				</td>
				</tr>
				<tr><td>&nbsp;<br /><br /></td></tr>
			<?
			}
			if ($_SESSION[eid]!=''){

			?>
			<input type="hidden" name="table" value="trivia_answers" />
			<input type="hidden" name="total" value="<?php echo $x ?>" />
			<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Submit" id="submit" /></td></tr>
			<? 		}		?>
		</table>
		</form>
	<?php }
		} 
	else { ?>
	<h4 class="title">Check back soon for the Health and Wellness Biweekly Quiz.<br>During the months of April and May enter to win valuable points towards your fitness challenge prize!</h4>
	<?php } ?>
	</div>
	</div>
	</div>

					
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>