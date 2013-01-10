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
    <div id="content">
      <div class="post">
	  	 <?php if($_SESSION['challenge']==''){ ?>
        <h1 class="title">Welcome to the Health and Wellness Website</h1>
        
        <div>The Health and Wellness Challenge materials will be available starting April 9. <br>These materials will only be available to those participating in the different challenges.</div>
        <?php } 
		elseif($_SESSION['challenge']=='get_fit'){ 
			echo("<h2 class='title'>Wellness Challenge Summary</h3>");
			$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and meal !="" and challenge>=11 and challenge<=19 order by date desc, meal asc';
			$results=@mysql_query($summary);
			if(@mysql_num_rows($results)>0){
				?>
				<h4 class="title_blue_a" onClick="javascript:show_div('meals');">> Meal Summary</h4>
				<div id="meals" style="display:none">
				<?php
				$div=0;
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness[date]);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					if($display_date!=$old_date){
						if($div!=0)
							echo "</div>";
						echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."f');\">".$display_date."</h4>";
						echo "<div id='".$display_date."f' style='display:none'>";
					}
					
						
					if($wellness[meal]!=$old_meal)
						echo "<strong>".strtoupper($wellness[meal]).":</strong><br>";
						
						$food_item="select name from diet where id='".$wellness[food]."'";
						$food_name=mysql_result(mysql_query($food_item),0,0);
						if($wellness[servings]>1)
							$plu='s';
						else 
							$plu="";
						echo $wellness[servings]." serving".$plu." of ".$food_name."<br>";
					
						
					$old_date=$display_date;
					$old_meal=$wellness[meal];
					$div++;
			} ?>
		</div>			
		</div>
		<?php }	
			$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge>=11 and challenge<=19 order by date desc';
			$results=@mysql_query($summary);
			if(@mysql_num_rows($results)>0){
				?>
				<h4 class="title_blue_a" onClick="javascript:show_div('exercise');">> Exercise Summary</h4>
				<div id="exercise" style="display:none">
				<?php

				$div=0;
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness[date]);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					if($display_date!=$old_date){
						if($div!=0)
							echo "</div>";
						echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."e');\">".$display_date."</h4>";
						echo "<div id='".$display_date."e' style='display:none'>";
					}
			
					$exer_item="select name from exercise where id='".$wellness[exercise]."'";
					$exer_name=mysql_result(mysql_query($exer_item),0,0);
					echo $exer_name." for ".$wellness[duration]." minutes<br>";
					
						
					$old_date=$display_date;
					$div++;
			} ?>
		</div>			
		</div>
		<?php }	
			$summary='select * from goals where eid="'.$_SESSION[eid].'" order by set_date desc';
			$results=@mysql_query($summary);
			if(@mysql_num_rows($results)>0){
			?>
			<h4 class="title_blue_a" onClick="javascript:show_div('goals');">> Goal Summary</h4>
			<div id="goals" style="display:none">
			<?php
				$div=0;
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness[set_date]);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					if($display_date!=$old_date){
						if($div!=0)
							echo "</div>";
						echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."g');\">".$display_date."</h4>";
						echo "<div id='".$display_date."g' style='display:none'>";
					}
			
					$goal_item="select challenge from challenge_timelines where id='".$wellness[challenge_id]."'";
					$goal_name=@mysql_result(@mysql_query($goal_item),0,0);
					if($wellness[accomplished]=='1')
						echo "<strong>Accomplished: </strong>";
					
					echo $goal_name.": ".$wellness[goal]."<br>";
					
						
					$old_date=$display_date;
			} ?>
			</div></div></div>		
		<?php }	
		$summary='select * from rswc where eid="'.$_SESSION[eid].'" order by day desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
		?>
		<h4 class="title_blue_a" onClick="javascript:show_div('rswc');">> Ready, Set, Walk Challenge Summary</h4>
		<div id="rswc" style="display:none">
		<?php
			$div=0;
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[day]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					echo "<span class='title_green_a'>".$display_date.":</span> ". $wellness[steps]." steps<br>";
			
			} ?>	
		</div>
		<?php }
		$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge>=22 and challenge<=30 order by date desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
		?>
		<h4 class="title_blue_a" onClick="javascript:show_div('exer');">> Exercise Log Summary</h4>
		<div id="exer" style="display:none">
		<?php
			$div=0;
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness[date]);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					if($display_date!=$old_date){
						if($div!=0)
							echo "</div>";
						echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."ex');\">".$display_date."</h4>";
						echo "<div id='".$display_date."ex' style='display:none'>";
					}
			
					$exer_item="select name from exercise where id='".$wellness[exercise]."'";
					$exer_name=mysql_result(mysql_query($exer_item),0,0);
					echo $exer_name." for ".$wellness[duration]." minutes<br>";
					
						
					$old_date=$display_date;
					$div++;
			} ?>
		</div>			
		</div>
	<?php }	
			$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and meal !="" and challenge>=31 and challenge<=38 order by date desc, meal asc';
			$results=@mysql_query($summary);
			if(@mysql_num_rows($results)>0){
				?>
				<h4 class="title_blue_a" onClick="javascript:show_div('food');">> Food Log Summary</h4>
				<div id="food" style="display:none">
				<?php
				$div=0;
				while ($wellness=mysql_fetch_array($results)){
					$temp=explode("-",$wellness[date]);		
					$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
					if($display_date!=$old_date){
						if($div!=0)
							echo "</div>";
						echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."fl');\">".$display_date."</h4>";
						echo "<div id='".$display_date."fl' style='display:none'>";
					}
					
						
					if($wellness[meal]!=$old_meal)
						echo "<strong>".strtoupper($wellness[meal]).":</strong><br>";
						
						$food_item="select name from diet where id='".$wellness[food]."'";
						$food_name=mysql_result(mysql_query($food_item),0,0);
						if($wellness[servings]>1)
							$plu='s';
						else 
							$plu="";
						echo $wellness[servings]." serving".$plu." of ".$food_name."<br>";
					
						
					$old_date=$display_date;
					$old_meal=$wellness[meal];
					$div++;
			} ?>
		</div>			
		</div>
		<?php }	
			
		$summary='select * from calorie_tracker where eid="'.$_SESSION[eid].'" order by date desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			?>
			<h4 class="title_blue_a" onClick="javascript:show_div('cal');">> Calorie Summary</h4>
			<div id="cal" style="display:none">
			<?php
			$div=0;
			$old_date='';
			while ($cal=mysql_fetch_array($results)){
				$temp=explode("-",$cal[date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
											
					if($total_food_cals!=0)
						echo "<strong>Food Calories Consumed: </strong> ".$total_food_cals."<br>";	
					if($total_exer_cals!=0)
						echo "<strong>Exercise Calories Burned: </strong> ".$total_exer_cals."<br>";
					if($div!='')
						echo "</div>";
				
					$total_food_cals=0;
					$total_exer_cals=0;
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."c');\">".$display_date."</h4>";
					echo "<div id='".$display_date."c' style='display:none'>";
				}
				
				$current_cals=$cal['calories'];
				if($current_cals>0)
						$total_food_cals=$total_food_cals+$current_cals;
				if($current_cals<0)
						$total_exer_cals=$total_exer_cals+$current_cals;
										
				$old_date=$display_date;
				$div++;
				
			}
			
			if($div!=0){
				if($total_food_cals!=0)
					echo "<strong>Food Calories Consumed: </strong> ".$total_food_cals."<br>";	
				if($total_exer_cals!=0)
					echo "<strong>Exercise Calories Burned: </strong> ".$total_exer_cals."<br>";
					echo "</div>";
					
			}
			?>			
		</div>
		<?php }	
		
	}
	elseif($_SESSION['challenge']=='stay_fit'){ 
		echo("<h2 class='title'>Wellness Challenge Summary</h3>");
		$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and meal !="" and challenge>=11 and challenge<=19 order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			?>
			<h4 class="title_blue_a" onClick="javascript:show_div('meals');">> Meal Summary</h4>
			<div id="meals" style="display:none">
			<?php
			$div=0;
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
					if($div!=0)
						echo "</div>";
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."f');\">".$display_date."</h4>";
					echo "<div id='".$display_date."f' style='display:none'>";
				}
				
					
				if($wellness[meal]!=$old_meal)
					echo "<strong>".strtoupper($wellness[meal]).":</strong><br>";
					
					$food_item="select name from diet where id='".$wellness[food]."'";
					$food_name=mysql_result(mysql_query($food_item),0,0);
					if($wellness[servings]>1)
						$plu='s';
					else 
						$plu="";
					echo $wellness[servings]." serving".$plu." of ".$food_name."<br>";
				
					
				$old_date=$display_date;
				$old_meal=$wellness[meal];
				$div++;
		} ?>
	</div>			
	</div>
	<?php }	
		$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge>=11 and challenge<=19 order by date desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			?>
			<h4 class="title_blue_a" onClick="javascript:show_div('exercise');">> Exercise Summary</h4>
			<div id="exercise" style="display:none">
			<?php

			$div=0;
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
					if($div!=0)
						echo "</div>";
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."e');\">".$display_date."</h4>";
					echo "<div id='".$display_date."e' style='display:none'>";
				}
		
				$exer_item="select name from exercise where id='".$wellness[exercise]."'";
				$exer_name=mysql_result(mysql_query($exer_item),0,0);
				echo $exer_name." for ".$wellness[duration]." minutes<br>";
				
					
				$old_date=$display_date;
				$div++;
		} ?>
	</div>			
	</div>
	<?php }	
		$summary='select * from goals where eid="'.$_SESSION[eid].'" order by set_date desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
		?>
		<h4 class="title_blue_a" onClick="javascript:show_div('goals');">> Goal Summary</h4>
		<div id="goals" style="display:none">
		<?php
			$div=0;
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[set_date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
					if($div!=0)
						echo "</div>";
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."g');\">".$display_date."</h4>";
					echo "<div id='".$display_date."g' style='display:none'>";
				}
		
				$goal_item="select challenge from challenge_timelines where id='".$wellness[challenge_id]."'";
				$goal_name=mysql_result(mysql_query($goal_item),0,0);
				if($wellness[accomplished]=='1')
					echo "<strong>Accomplished: </strong>";
				
				echo $goal_name.": ".$wellness[goal]."<br>";			
				$old_date=$display_date;
		} ?>
	</div>			
	</div>
	<?php }	
	$summary='select * from rswc where eid="'.$_SESSION[eid].'" order by day desc';
	$results=@mysql_query($summary);
	if(@mysql_num_rows($results)>0){
	?>
	<h4 class="title_blue_a" onClick="javascript:show_div('rswc');">> Ready, Set, Walk Challenge Summary</h4>
	<div id="rswc" style="display:none">
	<?php
		$div=0;
		while ($wellness=mysql_fetch_array($results)){
			$temp=explode("-",$wellness[day]);		
			$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				echo "<span class='title_green_a'>".$display_date.":</span> ". $wellness[steps]." steps<br>";
		
		} ?>	
	</div>
	<?php }	
	$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and exercise !="" and challenge>=22 and challenge<=30 order by date desc';
	$results=@mysql_query($summary);
	if(@mysql_num_rows($results)>0){
	?>
	<h4 class="title_blue_a" onClick="javascript:show_div('exer');">> Exercise Log Summary</h4>
	<div id="exer" style="display:none">
	<?php
		$div=0;
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
					if($div!=0)
						echo "</div>";
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."ex');\">".$display_date."</h4>";
					echo "<div id='".$display_date."ex' style='display:none'>";
				}
		
				$exer_item="select name from exercise where id='".$wellness[exercise]."'";
				$exer_name=mysql_result(mysql_query($exer_item),0,0);
				echo $exer_name." for ".$wellness[duration]." minutes<br>";
				
					
				$old_date=$display_date;
				$div++;
		} ?>
	</div>			
	</div>
<?php }	
		$summary='select * from wellness_log where eid="'.$_SESSION[eid].'" and meal !="" and challenge>=31 and challenge<=38 order by date desc, meal asc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			?>
			<h4 class="title_blue_a" onClick="javascript:show_div('food');">> Food Log Summary</h4>
			<div id="food" style="display:none">
			<?php
			$div=0;
			while ($wellness=mysql_fetch_array($results)){
				$temp=explode("-",$wellness[date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
					if($div!=0)
						echo "</div>";
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."fl');\">".$display_date."</h4>";
					echo "<div id='".$display_date."fl' style='display:none'>";
				}
				
					
				if($wellness[meal]!=$old_meal)
					echo "<strong>".strtoupper($wellness[meal]).":</strong><br>";
					
					$food_item="select name from diet where id='".$wellness[food]."'";
					$food_name=mysql_result(mysql_query($food_item),0,0);
					if($wellness[servings]>1)
						$plu='s';
					else 
						$plu="";
					echo $wellness[servings]." serving".$plu." of ".$food_name."<br>";
				
					
				$old_date=$display_date;
				$old_meal=$wellness[meal];
				$div++;
		} ?>
	</div>			
	</div>
	<?php }	
		
		$summary='select * from calorie_tracker where eid="'.$_SESSION[eid].'" order by date desc';
		$results=@mysql_query($summary);
		if(@mysql_num_rows($results)>0){
			?>
			<h4 class="title_blue_a" onClick="javascript:show_div('cal');">> Calorie Summary</h4>
			<div id="cal" style="display:none">
			<?php
			$div=0;
			$old_date='';
			while ($cal=mysql_fetch_array($results)){
				$temp=explode("-",$cal[date]);		
				$display_date=$temp[1]."/".	$temp[2]."/".$temp[0];	
				if($display_date!=$old_date){
					if($div!=0){
						//echo "</div>";
						}
						
					if($total_food_cals!=0)
						echo "<strong>Food Calories Consumed: </strong> ".$total_food_cals."<br>";	
					if($total_exer_cals!=0)
						echo "<strong>Exercise Calories Burned: </strong> ".$total_exer_cals."<br>";
					if($div!='')
						echo "</div>";
				
					$total_food_cals=0;
					$total_exer_cals=0;
					echo "<h4 class='title_green_a' onClick=\"javascript:show_div('".$display_date."c');\">".$display_date."</h4>";
					echo "<div id='".$display_date."c' style='display:none'>";
				}
				
				$current_cals=$cal['calories'];
				if($current_cals>0)
						$total_food_cals=$total_food_cals+$current_cals;
				if($current_cals<0)
						$total_exer_cals=$total_exer_cals+$current_cals;
										
				$old_date=$display_date;
				$div++;
				
			}
			
			if($div!=0){
				if($total_food_cals!=0)
					echo "<strong>Food Calories Consumed: </strong> ".$total_food_cals."<br>";	
				if($total_exer_cals!=0)
					echo "<strong>Exercise Calories Burned: </strong> ".$total_exer_cals."<br>";
					echo "</div>";
					
			}
			?>		
	</div>
	<?php }	
		
	}
		?>
		<br><br>
		<li><a href="get_fit.php">Get Fit Initiative</a></li>
		<li><a href="stay_fit.php">Stay Fit Initiative</a></li>
		<li><a href="rswc.php">Ready Set Walk Challenge </a></li>
		<li><a href="cwtc.php">Workforce Team Challenge </a></li>
	
		<?php $date=date('Y-m-d');
			if (($date <= '2012-04-22')&&($date >= '2012-04-09')){
			?>
		<li><a href="fitness_test.php">Initial Fitness Test</a></li>
		<?php } ?>
		<li><a href="wellness_log.php">Weekly Wellness Log</a></li>
		<li><a href="summary.php">Weekly Summary</a></li>
		<?php $date=date('Y-m-d');
			if (($date <= '2012-06-15')&&($date >= '2012-06-04')){
			?>
			<li><a href="fitness_test.php">Final Fitness Test</a></li>
			<?php } ?>
      </div>
    </div>

<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
