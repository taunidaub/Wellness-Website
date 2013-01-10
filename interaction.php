<?
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
	<div class="post"><h1 class="title">Healthy Expressions</h1>	
	<h3 class="title_green"><a name="recipe"></a>Recipe Submission</h3>
		<form action="insert.php?table=recipe" enctype="multipart/form-data" method="post" name="recipe_form" onSubmit="return validateForm('recipe');">
			<div class="align-left">
			<div class="post-bgtop">Do you have a favorite holiday recipe? Submit your recipe below to be entered into our Thanksgiving recipe raffle!
			<br> All healthy recipes will be published in our Healthy Thanksgiving Cookbook! 
 
			</div>
			<?php if ($_SESSION[eid]==''){ ?>
			<h4 class="title_red">Login to submit your recipe below.</h4>
				<form action="login.php">
			EID: <input type="text" name="logineid" id="logineid" />
			Password: <input type="password" name="password" id="password" />
			<input type="submit" name="login" value="Login" onClick="javascript:login();" /><br />
			<?php } ?>
			<textarea name="recipe" id="recipe" cols="60" rows="4"></textarea>
			<br />
			<br />
	


		<h3 class="title_green"><a name="blog"></a>Start your own discussion on our blog.</h3> 
		<div class="post-bgtop">Want to be a part of our blog? Enter ideas and recipes below and yours may even be featured in the next newsletter.</div>
		<form enctype="multipart/form-data" action="insert.php?table=tips" method="post" name="blog_form" onSubmit="return validateForm('tip');">
			<div class="post-bgtop"></div>
			Have something to say? Start the discussion here. <br />
			<input type="hidden" name="type" value='blog_post'>	
			<textarea name="tip" id="tip" cols="60" rows="4"></textarea>
			<br />
			
		<h3 class="title_green"><a name="tips"></a>Tips, Tricks or Encouragement?</h3> 
		<form enctype="multipart/form-data" action="insert.php?table=tips" method="post" name="tip_form" onSubmit="return validateForm('tip');">
			<div class="post-bgtop">Do you have a healthy tip? Either a way to fit in more exercise during the day or a way to cut calories that could help someone else on the path to Wellness? Do you just have some encouraging words or a motto that helps you get through those tough times? </div>
			<br />
			Please share your tips and tricks below to help others reach their goals. <br />
			<select name="type" id="type">
			<option value="" selected="selected">Please select one.</option>
			<option>Diet tip</option>
			<option>Encouragement tip</option>
			<option>Exercise tip</option>
			</select><br />
			<textarea name="tip" id="tip" cols="60" rows="4"></textarea>
			<br />
			<br />
	
		<?php if ($_SESSION[eid]==''){ ?>
		<h4 class="title_red">Login to submit any of these forms.</h4>
			<form action="login.php">
		EID: <input type="text" name="logineid" id="logineid" />
		Password: <input type="password" name="password" id="password" />
		<input type="submit" name="login" value="Login" onClick="javascript:login();" /><br />
			<br />
			<br />
		<?php } ?>
		<br />
		<br>
		</div>
		</div>
	</div>
 
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
