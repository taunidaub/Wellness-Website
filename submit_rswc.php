<?

	include_once ("../phpincludes/db.php");
	include ("includes/includedb.php");
	conn2('wellness');	
	$d1steps0=str_replace(",","",$_POST[d1steps0]);
	$d1steps1=str_replace(",","",$_POST[d1steps1]);
	$d1steps2=str_replace(",","",$_POST[d1steps2]);
	$d1steps3=str_replace(",","",$_POST[d1steps3]);
	$d1steps4=str_replace(",","",$_POST[d1steps4]);
	$d1steps5=str_replace(",","",$_POST[d1steps5]);
	$d1steps6=str_replace(",","",$_POST[d1steps6]);
	$d2steps0=str_replace(",","",$_POST[d2steps0]);
	$d2steps1=str_replace(",","",$_POST[d2steps1]);
	$d2steps2=str_replace(",","",$_POST[d2steps2]);
	$d2steps3=str_replace(",","",$_POST[d2steps3]);
	$d2steps4=str_replace(",","",$_POST[d2steps4]);
	$d2steps5=str_replace(",","",$_POST[d2steps5]);
	$d2steps6=str_replace(",","",$_POST[d2steps6]);
	
	if ($week == '1'){
		if(($d1steps0!=0)&&($d1steps0!='')){
			$input_sql1 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date0].'","'.$d1steps0.'")';
			$input_query = @mysql_query($input_sql1);
		}
		if(($d1steps1!=0)&&($d1steps1!='')){
			$input_sql2 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date1].'","'.$d1steps1.'")';
			$input_query = @mysql_query($input_sql2);	
		}
		if(($d1steps2!=0)&&($d1steps2!='')){
			$input_sql3 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date2].'","'.$d1steps2.'")';
			$input_query = @mysql_query($input_sql3);	
		}
		if(($d1steps3!=0)&&($d1steps3!='')){
			$input_sql4 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date3].'","'.$d1steps3.'")';
			$input_query = @mysql_query($input_sql4) ;	
		}
		if(($d1steps4!=0)&&($d1steps4!='')){
			$input_sql5 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date4].'","'.$d1steps4.'")';
			$input_query = @mysql_query($input_sql5) ;	
		}
		if(($d1steps5!=0)&&($d1steps5!='')){
			$input_sql6 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date5].'","'.$d1steps5.'")';
			$input_query = @mysql_query($input_sql6) ;	
		}
		if(($d1steps6!=0)&&($d1steps6!='')){
			$input_sql7 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date6].'","'.$d1steps6.'")';
			$input_query = @mysql_query($input_sql7);	
		}

			
	}
	else if ($week == '2'){
		
		if(($d2steps0!=0)&&($d2steps0!='')){
			$input_sql1 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date0].'","'.$d2steps0.'")';
			$input_query = @mysql_query($input_sql1);
		}
		if(($d2steps1!=0)&&($d2steps1!='')){
			$input_sql2 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date1].'","'.$d2steps1.'")';
			$input_query = @mysql_query($input_sql2) ;
		}
		if(($d2steps2!=0)&&($d2steps2!='')){	
			$input_sql3 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date2].'","'.$d2steps2.'")';
			$input_query = @mysql_query($input_sql3);
		}
		if(($d2steps3!=0)&&($d2steps3!='')){
			$input_sql4 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date3].'","'.$d2steps3.'")';
			$input_query = @mysql_query($input_sql4);
		}
		if(($d2steps4!=0)&&($d2steps4!='')){
			$input_sql5 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date4].'","'.$d2steps4.'")';
			$input_query = @mysql_query($input_sql5) ;
		}
		if(($d2steps5!=0)&&($d2steps5!='')){
			$input_sql6 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date5].'","'.$d2steps5.'")';
			$input_query = @mysql_query($input_sql6);
		}
		if(($d2steps6!=0)&&($d2steps6!='')){
			$input_sql7 = 'insert into rswc (eid, day, steps) values ("'.$_SESSION[eid].'","'.$_POST[date6].'","'.$d2steps6.'")';
			$input_query = @mysql_query($input_sql7) ;
		}

	}
	
	$eid=$_SESSION['eid'];
	$date=date('Y-m-d');
	
	if($_REQUEST[w1goal]!='')
		$sql="insert into goals (`eid`,`challenge_id`,`goal`,`set_date`) values  ('$eid','".$_REQUEST[challenge]."','".$_REQUEST[w1goal]."','".$date."')";
		
	else if($_REQUEST[w2goal]!='')
		$sql="insert into goals (`eid`,`challenge_id`,`goal`,`set_date`) values  ('$eid','".$_REQUEST[challenge]."','".$_REQUEST[w2goal]."','".$date."')";
	
	
	$result=@mysql_query($sql);

	header("location:fall_fitness.php");	
?>