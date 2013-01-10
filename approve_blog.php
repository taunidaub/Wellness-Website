<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");
	
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	include('../phpincludes/LDAP.class.php');
	$ADhost='';
	$LDAP = new LDAP('CORP\\LdapUser',$Password,$ADhost);
	conn2('wellness');

	$table[0]='wellness';
	$table[1]='recipe';
	$table[2]='tips';
	$columns[0]='title';
	$columns[1]='recipe';
	$columns[2]='tip';
	
	
	include ('includes/head.php');
	if($_GET[appall]==true)
		@mysql_query("update blog_responses set allowed='1'");
	if($_GET[response_id]!=''){
		$sql="update blog_responses set allowed='1' where id=".$_GET[response_id];
		@mysql_query($sql);
	}
		

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
    </div>
    <!-- start content -->
    <div id="content">
    	<div class="post">
        <h1 class="title">Health and Wellness Website Administration</h1>
		<div class="entry">

<?
			$sql = 'SELECT * FROM blog_responses where allowed="0" order by blog_id asc, date asc';
			
			$query = mysql_query($sql);
			//echo("<br>$query");
			while ($row = mysql_fetch_array ($query)){
				$select_blog="select introduction from blog_posts where id='".$row[blog_id]."'";
				$intro=mysql_result(mysql_query($select_blog),0) or die(mysql_error()); 
				if($intro!=$old_intro){ ?>			
				<h3 class="title_green">Original Post: <?php echo ($intro) ?></h3>
				<?php } ?>
				<form enctype="multipart/form-data" method="POST" ACTION="approve_blog.php?response_id=<?php echo $row[id] ?>">
				
				Reply:<?php echo ($row[response]) ?><br>
				<?php
				$tempa=explode(" ",$row['date']);
				$temp=explode("-",$tempa[0]);
				$tempb=explode(":",$tempa[1]);
				if($tempb[0]>12){
					$hour=$tempb[0]-12;
					$suffix="p.m.";
					}
				elseif($tempb[0]<12){
					$hour=$tempb[0];
					if($hour[0]==0)
						$hour=$hour[1];
					$suffix="a.m.";
				}
					else
						$suffix="a.m.";
			
			
				$date=$temp[1]."/".$temp[2]."/".$temp[0]." at " .$hour.":".$tempb[1]." ".$suffix;
				echo ("Submitted By: ". $LDAP->getFirstName($row['eid'])." 
				". $lastname=$LDAP->getLastName($row['eid'])." on: ".$date);
?>
				<input type="Submit" value="Approve">
				<hr>
				
				</FORM>
		<?php 
				$old_intro=$intro; 
		}?>
				<form method="POST" ACTION="approve_blog.php?appall=true">
				<input type="Submit" value="Approve all responses">

		
	</div> 		
	</div> 
    </div>
    <!-- end content -->
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
