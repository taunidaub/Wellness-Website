<div id="sidebar2" class="sidebar">
	<ul>
		<li><div align="center"><img align="center" src="images/twc_logo.png" /></div><br /></li>
		<li>
		  <h2>Recent Blog Posts</h2>
		  <ul>
		  <? 
		  $blog_sql = "select * from blog_posts order by id desc limit 15";
		  $blog_result=mysql_query($blog_sql);
		  for($x=0;$x<@mysql_num_rows($blog_result); $x++){
			$table=mysql_result($blog_result,$x,1);
			$table_id=mysql_result($blog_result,$x,2);
			$post_introduction=mysql_result($blog_result,$x,3);
			$post_sql='select * from '.$table.' where id='.$table_id;
			$post_result=mysql_query($post_sql);
			?>
			<li><a href='javascript:post_lookup("<?php echo $table ?>","<?php echo $table_id?>")'><?php echo $post_introduction?></a></li>
			<?php
			}
			?>
		  </ul>
		</li>
	</ul>
</div>