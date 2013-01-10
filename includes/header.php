<?php
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
//echo $parts[count($parts) - 1];
switch ($parts[count($parts) - 1]){
	case 'index.php':
		$i_cpi=" class='current_page_item' ";
		break;
	case 'exercise.php':
		$e_cpi=" class='current_page_item' ";
		break;
	case 'diet.php':
		$d_cpi=" class='current_page_item' ";
		break;
	case 'search.php':
		$s_cpi=" class='current_page_item' ";
		break;
	case 'submit_search.php':
		$s_cpi=" class='current_page_item' ";
		break;
	case 'admin.php':
		$a_cpi=" class='current_page_item' ";
		break;
	}

?>

<div id="header"><p>Health &amp; Wellness Website</p>
</div>
<div id="menu">
	<ul id="main">
	  <li><a href="exercise.php">Activity Calculator</a></li>
	  <li><a href="diet.php">Food Calorie Calculator</a></li>
	  <li><a href="search.php">Advanced Search</a></li>
	  <li><a href="admin.php">Administration</a></li>
	</ul>
</div>

