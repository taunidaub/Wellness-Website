<?php
session_start();
	include_once ("includes/functions.php");
	include ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');

	include ('includes/head.php');
?>
<script language="JavaScript" type="text/javascript">
function surfto(form) {
  var whereto=form.jump.selectedIndex
  location=form.jump.options[whereto].value;
}
</script>

<body>
  <div id="page">
	<div id="wrapper">
	<?php include ('includes/header2.php'); ?>
	<?php include ('includes/left-bar.php') ?>
    <!-- start content -->
    <div id="content">
      <div class="post">
		<p><div style="float:right"><img src="images/aha_logo.png" alt="American Heart Association"></div>
		<h1 class="title">2012 American Heart Association Heart Walk</h1>
		<?php 
		if ($_POST['submit']=="Send Registration"){
			$userTable = "ahawalk";

		@extract($_POST);
		// Check if entry was already made
		$sqlcheck = @mysql_query("SELECT COUNT(*) as count FROM $userTable where email='$email'");
		$querycheck = mysql_fetch_array($sqlcheck);

		

		if (!$yourname || !$email) {
		die ("Incomplete form. Please return to the <A HREF='javascript:history.back()'>Entry Page</A> and fill out all the fields.");
		}

		$Pattern = ".+@.+\..+";

		if (!eregi($Pattern, $email)){
			die ("You've entered an invalid e-mail address. <A HREF='javascript:history.back()' CLASS='intext'>Please go back to complete the form</A><BR>\n");
		}

		$date = date("Y-m-d");
		if ($querycheck['count'] > 0 ){
				 echo ("You have already submitted your information. Thank you.");
		}
		else{
		/* contest database dump */
		$sql = "INSERT into $userTable (`name`,`email`,`part2`,`part3`,`part4`,`part5`,`part6`,`part7`,`part8`,`part9`,`part10`,`total`,`date`)
		values ('$yourname','$email','$participant_number_2','$participant_number_3','$participant_number_4','$participant_number_5',
		'$participant_number_6','$participant_number_7','$participant_number_8','$participant_number_9','$participant_number_10','$people','$date')";
		$query = mysql_query($sql) or die(mysql_error()."$sql<br>");
			?>

			<TABLE WIDTH=600 cellpadding="10" cellspacing="0" border="0">
			<tr><td>
			
			<div class="h15">THANK YOU! YOUR SIGN UP CONFIRMATION IS BELOW</div>
			<P CLASS="norm"> Enjoy the Event.</P>
			<P CLASS="norm">You entered:<br><br>
			Name: <? echo $yourname; ?><br>
			Email: <? echo $email; ?><br>
			Number of participants: <? echo $people; ?><br>
			<? if ($participant_number_2)
			echo "Participant #2:  $participant_number_2 <br>";
			if ($participant_number_3)
			echo "Participant #3: $participant_number_3<br>";
			if ($participant_number_4)
			echo "Participant #4: $participant_number_4<br>";
			if ($participant_number_5)
			echo "Participant #5:  $participant_number_5<br>";
			if ($participant_number_6)
			echo "Participant #6: $participant_number_6<br>";
			if ($participant_number_7)
			echo "Participant #7: $participant_number_7<br>";
			if ($participant_number_8)
			echo "Participant #8: $participant_number_8<br>";
			if ($participant_number_9)
			echo "Participant #9: $participant_number_9<br>";
			if ($participant_number_10)
			echo "Participant #10:  $participant_number_10<br>";
			}
		?>
		</P>
		</td></tr>
		</TABLE>
		<?
		}
		else{ ?>

			<span class="title_green">Date: </span>Saturday, October 20, 2012<br>
			<span class="title_green">Time: </span>9:30am - 12:30pm<br>
			<span class="title_green">Where: </span>Saratoga Race Track 267 Union Avenue, Saratoga Springs, NY 12866<br>
			<span class="title_green">Cost: </span>No cost to you.  If you are interested in donating, you can do so at the event.<br>
			<span class="title_green">Who can participate:</span>  All Company Employees and their family/friends
			<br>
			Wear your favorite Company t-shirt.  If you do not have a t-shirt, please contact Katie Garippa.<br>
			When you register using this website, please indicate how many people you will bring with you.<br>
			<br>
			<span class="title_blue">Event Details</span><br>

			<span class="title_green">Meeting Location: </span>	Meet in front of the grand stands to the right hand side.  <br>
			<span class="title_green">Distance:	</span>3 miles with a 1 mile option route.  All routes are handicap and stroller accessible. There are hydration stations located all along the way, stocked with beverages, snacks and bathrooms are available there as well.<br>
			<span class="title_green">Parking: </span>	Parking is available free of charge at the main entrance gate. Enter gate at 267 Union Avenue, Saratoga Springs, NY. Come through the main gate for event festivities.<br>
			<span class="title_green">Bikes/Rollerblading:</span>	AHA requests that everyone walk for safety purposes.<br>
			<span class="title_green">Pets:	</span>		Pets are not allowed.<br>

			<TABLE cellpadding="4" cellspacing="0" border="0">
			<form name="walk" method="post" action="ahawalk.php">
				<tr>
					<td align="right" class="search">Number of participants (including yourself):&nbsp;</td>
					<td><select size="1" name=jump onchange=surfto(this.form)>
							<?php
							if($people > 10) {$people = 10;}
							$pplcount = 1;
							while ($pplcount < 11) {
								if ($people==$pplcount) {$selected = "selected";}
								else {$selected="";}
								echo "<option value=ahawalk.php?people=$pplcount $selected>$pplcount</option>";
								$pplcount = $pplcount + 1;
							}
							?>
						</select>
					</td>
				<tr>
					<td align="right" CLASS="search">Your name:</td>
					<td><input type="text" id="yourname" name="yourname" size="25"></td>
				</tr>
				<tr>
					<td align="right" CLASS="search">Email address:</td>
					<td><input type="text" id="email" name="email" size="25"></td>
				</tr>
						<?php
					if(!$people) {
						$participant_count=1;
					}
					else {$participant_count=$people;}
					echo "<input type=hidden name=people value=$participant_count>";
					$people_count = $people;
					$participant_number = 1;
					while($people_count > 1) {
						$participant_number = $participant_number + 1;
						echo "<td align=right CLASS=search>Name of participant #$participant_number:</td><td><input type=text name=participant_number_$participant_number size=25></td></tr>";
						$people_count = $people_count - 1;
						
					}
					?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;<input name="submit" type="Submit" value="Send Registration">&nbsp;<input type="Reset" value="Reset"></td>
				</tr>
				</form>
				</table>
			<? } ?>
				<br>
			  Contact  Katie Garippa in HR with any questions you may have.<br>
  <a href="mailto:Katie.Garippa@domain.com">Katie.Garippa@domain.com</a><br>
			  518-640-8671</span></p>

      </div>
    </div>
    <!-- end content -->

<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
