<div id="sidebar1" class="sidebar">
	<div align="center"><a href="index.php"><img src="images/wellness_logo.jpg" /></a></div>
	<br /><br />
	
	  <ul>
		<li>
		  <form id="searchform" method="post" action="submit_search.php">
			<div>
			  <h2>Site Search</h2>
			 <div align="center">
			  <input type="text" name="s" id="s" size="15" value="" />
			  
			  <input type="submit" name="submit" value="Submit" />
			  </div>
			</div>
		  </form>
		</li>
		<li>
		  <h2>Recent Newsletters</h2>
		  <ul>
		  <? 
		  $recent_sql = "select * from wellness order by date_sent desc limit 15";
		  $recent_result=mysql_query($recent_sql);
		  for($x=0;$x<@mysql_num_rows($recent_result); $x++){
			$title=mysql_result($recent_result,$x,1);
			$desc=mysql_result($recent_result,$x,2);
			$date=mysql_result($recent_result,$x,5);
			$weblink=mysql_result($recent_result,$x,7);
			$temp=explode("-",$date);
			$date1=$temp[1]."/".$temp[2]."/".$temp[0];
			$link= mysql_result($recent_result,$x,6);
			if($weblink==1)
				echo("<li><a href='$desc' target='_blank'>$title - $date1</a></li>");
			else
				echo("<li><a href='files/$link' target='_blank'>$title - $date1</a></li>");
			}
			?>
		  </ul>
		</li>
	</ul>
</div>
