<?php
	include_once ("includes/functions.php");
	include_once ("../phpincludes/db.php");
	conn2('wellness');
	if($_REQUEST['type']=='food')
	{
		$list_sql = 'select id, name, serving_size from diet where name like "%'.$_REQUEST['search'] .'%" order by name asc';
		$list_result=mysql_query($list_sql);
		$x=0;
		while ($list=mysql_fetch_array($list_result)){
			$arr[$x]['id']=$list[id];
			$arr[$x]['name']=$list[name]." ".$list[serving_size]." serving";
			$x++;
		}
	
	
	
	}
	else{
		$list_sql = 'select id, name from exercise where name like "%'.$_REQUEST['search'] .'%" order by name asc';
		$list_result=mysql_query($list_sql);
		$x=0;
		while ($list=mysql_fetch_array($list_result)){
			$arr[$x]['id']=$list[id];
			$arr[$x]['name']=$list[name];
			$x++;
		}
	}
	echo json_encode($arr);

?>