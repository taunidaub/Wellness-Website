<?
session_start();
if (!isset($_SESSION[admin]))
	header("Location: index.php");
	
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	include_once ("includes/includedb.php");
	conn2('wellness');

$table[0]='wellness';
$table[1]='recipe';
$table[2]='tips';
$columns[0]='title';
$columns[1]='recipe';
$columns[2]='tip';


	include ('includes/head.php');
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
		for($x=0;$x<count($table);$x++){
			$sql = 'SELECT * FROM '.$table[$x].' order by id desc';
			//echo($sql);
			$query = mysql_query($sql);
			//echo("<br>$query");
			$options='';
			//echo($columns[$x]);
			while ($row = mysql_fetch_array ($query))
				$options.='<option value="'.$row['id'].'">'.substr($row[$columns[$x]],0,160)."</option>";

?>			
			<h3 class="title_green"><?php echo ucwords($table[$x])?></h3>
			<form enctype="multipart/form-data" method="POST" ACTION="add_to_blog.php?table=<?php echo $table[$x] ?>">
			Article or Submission to add:<br>
			<select name="selected">
			<?php echo $options ?>
			</select>
			<br>
			<div style="vertical-align:top">Introduction or title of the blog post: </div>
			<textarea name="introduction" cols="50"></textarea><br>
			
			<input type="Submit" value="Send">
			
			</FORM>
		<?php  
		}?>
		
	</div> 		
	</div> 
    </div>
    <!-- end content -->
<?php include ('includes/footer.php'); ?>
</div>
</body>
</html>
