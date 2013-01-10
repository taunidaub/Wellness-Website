<?
include_once ("includes/functions.php");
include ("../phpincludes/db.php");
include ("includes/includedb.php");
conn2('wellness');
$fp = fopen('wellness.xml', 'w');
fwrite($fp, '<?xml version="1.0" encoding="iso-8859-1"?>
<rss version="2.0">
<channel>
<title>Health and Wellness Announcements</title>
<description>Here is the recent listing of Announcements</description>     
<link>http://wellness.com/wellness</link>
');

  $search_sql = "select * from wellness order by date_sent desc";
  $search_result=mysql_query($search_sql);
  while($row = mysql_fetch_array($search_result)){
	fwrite($fp, "<item>");
	fwrite($fp, "<title>".$row['title']."</title>");
	//fwrite($fp, "<description>".$row['description']."</description>");
	fwrite($fp, "<category>".$row['category']."</category>");
	fwrite($fp, "<division>".$row['division']."</division>");
	fwrite($fp, "<pubDate>".$row['date_sent']."</pubDate>");
	$date=$row['last_update'];
	$temp=explode("-",$date);
	$date1=$temp[1]."/".$temp[2]."/".$temp[0];
	fwrite($fp, "<lastUpdate>".$date1."</lastUpdate>");
	$link= $row['document'];
	fwrite($fp, "<link>http://wellness.alb.domain.com/files/$link</link>");
	fwrite($fp, "</item>");
	//echo $row['title']." <br> ".$row['category'];
	}
		
fwrite($fp, "</channel>
</rss>");

fclose($fp);

?>