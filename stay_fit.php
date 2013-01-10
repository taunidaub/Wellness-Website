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

        <h1 class="title">Stay Fit Challenge Information</h1>
        <p>Don&rsquo;t necessarily need to lose weight but would like to participate in  a wellness competition to develop or maintain healthy habits?&nbsp; If so, the Stay Fit Challenge is for you!</p>
        <ul>
          <li>Register as an individual.</li>
          <li>$20 per participant.</li>
          <li>We are partnering with Bally Total Fitness for  weigh-ins, wellness workshops and more!</li>
          <li>Winners will be determined based on most points  earned.</li>
          <li>You can earn points by participating in the  different wellness challenges, submitting to the weekly &ldquo;activity log and  nutrition journal&rdquo; as well as earning bonus points throughout.&nbsp; </li>
          <li>Top two winners will win cash!</li>
          <li>Submissions accepted each week by using this  website!</li>
          <li>The point distribution is at the bottom of this  page.</li>
          <li>There will be multiple raffles throughout the competition  for those who participate in the challenges to win other wellness type prizes!</li>
        </ul>

		<p><strong><a href="files/Sign-up_Form_Stay Fit.pdf" target="_blank">Sign up for the Stay Fit Wellness Challenge</a></strong></p>
		    <p><strong>Weekly Movement Tracker</strong><br>
		      During this 8 week challenge, you will earn points if you exercise for  2.5 or more hours each week.&nbsp; Experts say  to exercise at least 30 minutes a day 5 days a week or 2.5 hours each  week.&nbsp; To earn points, you need to track  and submit what you have done each week.&nbsp;  Also, you can earn bonus points by outlining your goal before each week  of what you want to accomplish during the following week.&nbsp; Then each week, submit your exercise activity  here and indicate if you reached your goal or not.<br>
		      Ways to increase your activity each week: </p>
		    <ul>
		      <li>Make it fun!&nbsp;  Do something you like (play golf, bike ride, bowling, playing catch,  etc).</li>
		      <li>Find an exercise or walking/jogging/running  partner (it&rsquo;s better to exercise with someone else!)<strong></strong></li>
		      <li>Take 10 minutes during your lunch to walk around  the building</li>
		      <li>During commercial breaks do a couple of push-ups</li>
		      <li>Play outside with your kids</li>
		      <li>Dance while you are doing the dishes</li>
		      <li>Sit on a yoga ball while you watch TV</li>
		      <li>Go to the gym twice a week</li>
	        </ul>
		    <p><strong>Weekly Nutrition Journal</strong><br>
		      During this 8 week challenge, you will earn points by submitting your  weekly food consumption. Keeping an account for how much how much food you are  eating will help you determine what you can increase or decrease in your diet  (example &ndash; if you see you are not drinking enough water each day, add more  protein to your diet, etc).&nbsp; </p>
		    <p><strong>Ready, Set, Walk Challenge</strong><br>
		      Experts say a person should try to walk 10,000 steps per day.&nbsp; Grab a pedometer and hook it to your belt to  see how far you walk each day.&nbsp; Earn  points for every 10,000 steps you walk during the week.&nbsp; This challenge helps build awareness of how  much you walk each day in hope that you will get up a few more times than  normal throughout the day!&nbsp; Way to do this:</p>
		    <ul>
		      <li>Walk during your lunch time</li>
		      <li>Instead of calling a co-worker, walk to their  desk</li>
		      <li>Park further away from the building than usual</li>
		      <li>Take the stairs instead of the elevator</li>
	        </ul>
		    <p>This challenge will run from April 16 &ndash; April 29</p>
		  </li>
		</ul>
		    <p><strong>Fitness Test</strong><br>
		      There will be two fitness tests during this competition.&nbsp; The first will be within the first week of  the challenge and the last one will be during the last couple of weeks of the  challenge.&nbsp; These fitness tests are for  you assess where you currently are now and how well you do at the end of the  competition.&nbsp; We encourage that you do  this with a partner to help count and support your efforts!</p>
		    <p>Initial Fitness Test: To be completed between April 16 &ndash; April 22<br>
		      Final Fitness Test: To be completed between June 4 &ndash; June 8</p>
		    <p><strong>Quizzes</strong><br>
		      Wellness Quizzes will be posted every two weeks.&nbsp; Test your knowledge and earn points!</p>
		    <p><strong>Point Breakdown &ndash; Stay Fit Challenge</strong></p>
		    <ol>
		      <li>Participate  in initial fitness test = 50 points</li>
		      <li>Submit  your overall challenge goal for yourself = 50 points</li>
		      <li>Submission  of exercise log weekly = 50 points (must accomplish 2.5 hours of exercise)</li>
		      <ol>
		        <li>Bonus points for accomplishing exercise goal &ndash;  10 points per week if accomplish outlined exercise plan</li>
	          </ol>
		      <li>Submission  of nutrition log weekly = 10 points per submission</li>
		      <li>Ready,  Set, Walk Challenge = 5 points/10,000 steps (accomplish 10,000 steps per day &ndash;  max 100 points)</li>
		      <li>Participate  in Workforce Team Challenge = 50 points</li>
		      <li>Weekly  Quizzes = 5 points each (every two weeks &ndash; 4 quizzes total)</li>
		      <li>Participate  in Final Fitness Test = 50 points</li>
		      <li>Bonus  points for improvement in fitness test = 10 points</li>
		      <li>Bonus  points for maintaining, losing weight or gaining muscle weight (based on  individual goal) = 10 points</li>
		      <li>Accomplishing  your overall goal = 150 points</li>
        </ol>
		    <p><strong>Schedule</strong>: (April 9 &ndash; June 15) <br>
		<ul>
			<li>Initial Weigh-in: April 9 &ndash; April 15</li>
			<li>Initial Fitness Test Week: April 16 &ndash; April 22</li>
			<li>Ready, Set, Walk Challenge: April 16 &ndash; April 29</li>
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
