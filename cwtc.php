<?php
session_start();
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
	   if ($_GET['type']!=''){ ?>
			<p><div style="float:right"><img width="160" height="160" src="cwtc_clip_image002.jpg" alt="http://www.cdphpwtc.com/logos/bw_logo.jpg"></div>
			<h1 class="title">Workforce Team Challenge</h1>
                <span class="title_green">Date:</span> Thursday, May 17, 2012<br>
                <span class="title_green">Start Time:</span> 6:25pm<br>
                <span class="title_green">Where:</span> Empire State Plaza in front of the  New York State Museum<br>
                <span class="title_green">Employee Cost:</span> $5 (Time Warner Cable will be  paying the difference)<br>
               <span class="title_green">Payment:</span>&nbsp;  Submit to Katie Garippa <u>no later than Friday April 27, 2012</u>.&nbsp; Make check payable to Time Warner Cable. &nbsp;&nbsp;Cash is accepted. <br>
               <span class="title_green">Participant&rsquo;s Release Form:</span> Must be signed and submitted to  Katie Garippa <b>no later than Friday, April 27, 2012</b>.&nbsp;&nbsp; <br>
               <span class="title_green">Event Information:</span> <br>
			  The CDPHP  Workforce Team Challenge is the Capital Region&rsquo;s workforce team run and walk &mdash;  and the largest annual road race between Utica and New York City. &nbsp;There were 9,200 runners and 470 participating  companies/organizations in the 2011 race - a record turnout.&nbsp; This event benefits racers, joggers, and  walkers.&nbsp; This year's selected charities  are <span class="title_red">Senior Services of Albany and  Schoharie Recovery, Inc.</span></p>
			<p align="center"><span class="title_green">Check out the &ldquo;Couch to Workforce Challenge&rdquo; training  program!&nbsp; It will help you easily prepare  for the race!<br>
                <a href="http://www.cdphpwtc.com/" target="_blank">http://www.cdphpwtc.com/</a> <br>
				<a href="http://wellness.alb.domain.com/files/WTCRegForm.pdf">Click here for the Registration Form</a>

				<br>
			  Contact  Katie Garippa in HR with any questions you may have.<br>
  <a href="mailto:Katie.Garippa@domain.com">Katie.Garippa@domain.com</a><br>
			  518-640-8671</span></p>
<?php }  
		 else if ($_SESSION['challenge']!=''){ ?>
        <h2 class="title"> Couch to Workforce Team Challenge<?php echo  " - ".ucwords(str_replace("_"," ",$_SESSION['challenge'])) ?></h2><div style="float:right"><img src="images/50points.png"></div>
		<a href="http://wellness.alb.domain.com/files/WTCRegForm.pdf">Click here for the Registration Form</a>
				<br>
		<table border="0" cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <td nowrap colspan="8" valign="middle" align="center"><h4 class="title_green">Couch to Workforce Team Challenge! Training Plan</h4></td>
          </tr>
          <tr>
            <td nowrap valign="middle"><p align="center">&nbsp;</p></td>
            <td  nowrap valign="middle"><p align="center">Mon</p></td>
            <td nowrap valign="middle"><p align="center">Tues</p></td>
            <td nowrap valign="middle"><p align="center">Wed</p></td>
            <td nowrap valign="middle"><p align="center">Thurs</p></td>
            <td nowrap valign="middle"><p align="center">Fri</p></td>
            <td nowrap valign="middle"><p align="center">Sat</p></td>
            <td nowrap valign="middle"><p align="center">Sun</p></td>
          </tr>
          <tr>
            <td nowrap valign="middle"><p align="center"><strong>Week</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    1</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    2</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    3</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    4</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    5</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    6</strong></p></td>
            <td nowrap valign="middle"><p align="center"><strong>Day    7</strong></p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>1</strong></p></td>
            <td nowrap valign="middle"><p>5 min walk <br>
              2 min jog <br>
              5 min walk</p></td>
            <td nowrap valign="middle"><p align="center">Relax!</p></td>
            <td valign="middle"><p>5 min walk <br>
              3 min jog <br>
              5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>5 min walk <br>
              4 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td><p align="center">Relax!</p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>2</strong></p></td>
            <td valign="middle"><p>5 min walk <br>
              5 min jog <br>
              5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>5 min walk <br>
              7 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>5 min walk<br>8 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td><p align="center">Relax!</p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>3</strong></p></td>
            <td valign="middle"><p>5 min walk<br>9 min jog <br>
              5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>5 min walk <br>10 min jog <br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>7 min jog<br>5 min walk<br>7 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>5 min walk<br>14 min jog<br>5 min walk</p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>4</strong></p></td>
            <td valign="middle"><p>5 min walk<br>15 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>17 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>9 min jog<br>5 min walk<br>9 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>18 min jog<br>5 min walk</p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>5</strong></p></td>
            <td valign="middle"><p>18 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>20 min jog<br>5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p align="center">Relax!</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>20 min jog<br>5 min walk</p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>6</strong></p></td>
            <td valign="middle"><p>12 min jog<br>5 min walk<br>12 min jog</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p>24 min jog</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p align="center">Relax!</p></td>
            <td><p align="center">25 min jog</p></td>
            <td valign="middle"><p>20 min jog<br>
              5 min walk</p></td>
          </tr>
          <tr>
            <td  nowrap><p align="center"><strong>7</strong></p></td>
            <td valign="middle"><p>25 min jog<br>
              5 min walk</p></td>
            <td valign="middle"><p>27 min jog<br>
              5 min walk</p></td>
            <td><p align="center">Relax!</p></td>
            <td valign="middle"><p align="center"><h2 class="title_green">Race Day!</h2></p></td>
            <td nowrap valign="middle"><p align="center">Relax!</p></td>
            <td valign="middle"><p>&nbsp;</p></td>
            <td nowrap valign="middle"><p>&nbsp;</p></td>
          </tr>
        </table>
		<?php }
		else { ?>
			<p><div style="float:right"><img width="160" height="160" src="cwtc_clip_image002.jpg" alt="http://www.cdphpwtc.com/logos/bw_logo.jpg"></div>
			<h1 class="title">Workforce Team Challenge</h1>
                <span class="title_green">Date:</span> Thursday, May 17, 2012<br>
                <span class="title_green">Start Time:</span> 6:25pm<br>
                <span class="title_green">Where:</span> Empire State Plaza in front of the  New York State Museum<br>
                <span class="title_green">Employee Cost:</span> $5 (Time Warner Cable will be  paying the difference)<br>
               <span class="title_green">Payment:</span>&nbsp;  Submit to Katie Garippa <u>no later than Friday April 27, 2012</u>.&nbsp; Make check payable to Time Warner Cable. &nbsp;&nbsp;Cash is accepted. <br>
               <span class="title_green">Participant&rsquo;s Release Form:</span> Must be signed and submitted to  Katie Garippa <b>no later than Friday, April 27, 2012</b>.&nbsp;&nbsp; <br>
               <span class="title_green">Event Information:</span> <br>
			  The CDPHP  Workforce Team Challenge is the Capital Region&rsquo;s workforce team run and walk &mdash;  and the largest annual road race between Utica and New York City. &nbsp;There were 9,200 runners and 470 participating  companies/organizations in the 2011 race - a record turnout.&nbsp; This event benefits racers, joggers, and  walkers.&nbsp; This year's selected charities  are <span class="title_red">Senior Services of Albany and  Schoharie Recovery, Inc.</span></p>
			<p align="center"><span class="title_green">Check out the &ldquo;Couch to Workforce Challenge&rdquo; training  program!&nbsp; It will help you easily prepare  for the race!<br>
                <a href="http://www.cdphpwtc.com/" target="_blank">http://www.cdphpwtc.com/</a> <br>
			  Contact  Katie Garippa in HR with any questions you may have.<br>
  <a href="mailto:Katie.Garippa@domain.com">Katie.Garippa@domain.com</a><br>
			  518-640-8671</span></p>
<?php }  ?>
      </div>
    </div>
    <!-- end content -->

<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
