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
        <h1 class="title">Get Fit Challenge Information</h1>
        <p>Want to lose weight and develop healthy habits?&nbsp; Participate in the Get Fit Challenge!</p>
        <ul>
          <li>Register a team of 5 or as an individual.</li>
          <li>$20 per participant.</li>
          <li>Weigh-ins will be from April 9 &ndash; April 15.</li>
          <li>We are partnering with Bally Total Fitness for  weigh-ins, wellness workshops and more!</li>
          <li>Winners will be determined based on average  weight loss percentage and the points earned by participating in the different  challenges.&nbsp; </li>
          <li>Top two winners in each category (team and  individual) will win cash!</li>
          <li>Submissions accepted each week by using this  website!</li>
          <li>The point distribution is at the bottom of this  page.</li>
          <li>There will be multiple raffles throughout the  competition for those who participate in the challenges to win other wellness  type prizes!</li>
        </ul>
		<p><strong><a href="files/Sign-up_Form_Get Fit.pdf" target="_blank">Sign up for the Get Fit Weight Loss Challenge</a></strong></p>
		    <p><strong>Wellness Tracking Log</strong><br>
		      Track the amount of exercise you accomplish each week and how much food  you consume to earn points.&nbsp; Keeping an  account for how much activity you are doing and how much food you are eating  will help you determine what you can improve on (examples &ndash; not walking enough  each day or drinking enough water during the day).&nbsp; </p>
		    <p><strong>Ready, Set, Walk Challenge </strong><br>
		      Experts say a person should try to walk 10,000 steps per day.&nbsp; Not quite there?&nbsp; Grab a pedometer and hook it to your belt to  see how far you walk each day.&nbsp; This  challenge helps build awareness of how much you walk each day in hope that you  will get up a few more times than normal throughout the day!&nbsp; Way to do this:</p>
		    <ul>
		      <li>Walk during your lunch time</li>
		      <li>Instead of calling a co-worker, walk to their  desk</li>
		      <li>Park further away from the building than usual</li>
		      <li>Take the stairs instead of the elevator</li>
	        </ul>
		    <p>This challenge will run from April 16 &ndash; April 29</p>
		    <p><strong>Exercise Challenge </strong><br>
		      Experts say to exercise for 30 minutes a day 5 days a week or 2.5 hours  per week.&nbsp; Sometimes life gets in the way  to take 30 minutes to exercise.&nbsp; To make  it easier for you, break it up into smaller and more attainable  increments.&nbsp; During this challenge, we  challenge you to exercise 3 hours each week for two weeks!&nbsp; Ways to do this:</p>
		    <ul>
		      <li>Make it fun!&nbsp;  Do something you like (play golf, bike ride, bowling, playing catch,  etc).</li>
		      <li>Take 10 minutes during your lunch to walk around  the building</li>
		      <li>During commercial breaks do a couple of push-ups</li>
		      <li>Play outside with your kids</li>
		      <li>Dance while you are doing the dishes</li>
		      <li>Sit on a yoga ball while you watch TV</li>
		      <li>Find someone to exercise with!&nbsp; It more fun that way!</li>
	        </ul>
		    <p>Any extra &ldquo;movement&rdquo; will help you accomplish your goals!</p>
		    <p>This challenge will run from April 29 &ndash; May 15</p>
		    <p><strong>Portion Control Challenge </strong><br>
		      This challenge is geared to build awareness of the amount of food we  consume each meal and each day.&nbsp;  Controlling the portion size of your meals, will help you lose weight  and control how much you eat.</p>
		    <p>Portion Size Template/Guide coming soon!</p>
		  <p><strong>Fitness Test</strong><br>
		    There will be two fitness tests during this competition.&nbsp; The first will be within the first week of  the challenge and the last one will be during the last couple of weeks of the  challenge.&nbsp; These fitness tests are for  you assess where you currently are now and how well you do at the end of the  competition.&nbsp; We encourage that you do  this with a partner to help count and support your efforts!</p>
		  <p>Initial Fitness Test: To be completed between April 16 &ndash; April 22<br>
		    Final Fitness Test: To be completed between June 4 &ndash; June 8</p>
		  <p><strong>Quizzes</strong><br>
		    Wellness Quizzes will be posted every two weeks.&nbsp; Test your knowledge and earn points!</p>
		  <p><strong>Point Breakdown &ndash; Get Fit  Challenge</strong></p>
		<ul>
		  <li>Weigh Loss &ndash; average weight loss percentage times one thousand = number of points earned (5.78% * 1,000 = 5,780 points)</li>
		  <li>Participate in initial fitness test = 50 points</li>
		  <li>Submission of weekly wellness log = 5 points  each</li>
		  <li>Ready, Set, Walk Challenge = 50 points </li>
		  <li>Exercise Challenge = 50 points</li>
		  <li>Portion Control Challenge = 50 Points</li>
		  <li>Participate in Workforce Challenge = 50 points</li>
		  <li>Weekly Quizzes = 5 points each (every two weeks)</li>
		  <li>Participate in Final Fitness Test = 50 points</li>
	    </ul>
		<p><strong>Schedule</strong>: (April 9 &ndash; June 15) <br>
		<ul>
			<li>Initial Weigh-in: April 9 &ndash; April 15</li>
			<li>Initial Fitness Test Week: April 16 &ndash; April 22</li>
			<li>Ready, Set, Walk Challenge: April 16 &ndash; April 29</li>
			<li>Exercise Challenge: April 29 &ndash; May 17</li>
			<li>Portion Control Challenge: May 14 &ndash; May 27</li>
			<li>Workforce Challenge: May 17</li>
			<li>Final Fitness Test: June 4 &ndash; June 8</li>
			<li>Final Weigh-ins: June 11 &ndash; June 15</li>
			<li>Winner Announcements: June 18 &ndash; June 22</li>
		</ul>
		<br>	
	</div>
 
    </div>
    <!-- end content -->
<?php include ('includes/right-bar.php'); ?>
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
