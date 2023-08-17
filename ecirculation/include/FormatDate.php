<?php

				//the function
				//Param 1 has to be an Array
				//Param 2 has to be a String
				//kamal: exlode a string based on multiple delimiter types used in function date_time below
				function multiexplode ($delimiters,$string) {
					$ary = explode($delimiters[0],$string);
					array_shift($delimiters);
					if($delimiters != NULL) {
						foreach($ary as $key => $val) {
							 $ary[$key] = multiexplode($delimiters, $val);
						}
					}
					return  $ary;
				}

	/* function DisplayDate($dtmDate){
		$year = substr($dtmDate, 0, 4);
		$month = substr($dtmDate, 5, 2);
		$day = substr($dtmDate, 8, 2);
		if($day == '00' || $day == ''){
			$dtmDate = '';
		}else{
			$dtmDate = $day."/".$month."/".$year;
		}
		return $dtmDate;
	} */


	function DBDate($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$year = substr($dtmDate, 6, 4);
			$month = substr($dtmDate, 3, 2);
			$day = substr($dtmDate, 0, 2);
			$dtmDate = $year."-".$month."-".$day;
		}
		return $dtmDate;
	}


	function TDate($dtmDate){
		if($dtmDate == ''){
			$dtmDate = '';
		}else{
			$year = substr($dtmDate, 6, 4); // returns YYYY
			$month = substr($dtmDate, 3, 2); // returns MM
			$day = substr($dtmDate, 0, 2); // returns DD
			$dtmDate = $year;
		}
		return $dtmDate;
	}

	function DisplayMasa($dtmDate){
		$set = substr($dtmDate, 11, 8); // returns YYYY
		if($set == '00:00:00' || $set == ''){
			$dtmDate = '';
		}else{
			$dtmDate = $set;
		}
		return $dtmDate;
	}


function format_date($original='', $format="%d-%m-%Y") {
    $format = ($format=='date' ? "%m-%d-%Y" : $format);
    $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format);
    $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format);
    $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format);
    return (!empty($original) ? strftime($format, strtotime($original)) : "" );
}
/*
function format_datetime($original='%Y-%m-%d %H:%M:%S', $format="%d/%m/%Y %H:%M:%S") {
    $format = ($format=='date' ? "%m-%d-%Y" : $format);
    $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format);
    $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format);
    $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format);
    return (!empty($original) ? strftime($format, strtotime($original)) : "" );
} */

function format_datetime($original='') {
//////My Custom code to prevent 01/01/1970 7:30:00////////////////////
//////original must be in '%Y-%m-%d %H:%M:%S' format /////////////////


	$delimiters = Array(" ","-");  //,":",",","|" <-possible delimiter
	$part = multiexplode($delimiters,$original);

	$Day=$part[0][2];
/* 	if ($Day<'10'){
	$Day = '0'.$Day;
	} */

	$Month=$part[0][1];
	$Year=$part[0][0];

	$Time=$part[1][0];

/* 	$Day=substr($original,8,2);
	$Month=substr($original,5,2);
	$Year=substr($original,0,4);

	$Time=substr($original,11,8); */

    return ($Day.'/'.$Month.'/'.$Year.' '.$Time);
}




/*
Here's a simple version for date formating i use between displaying in HTML and converting back to MYSQL format:

<?php
function format_date($original='', $format="%m/%d/%Y") {
    $format = ($format=='date' ? "%m-%d-%Y" : $format);
    $format = ($format=='datetime' ? "%m-%d-%Y %H:%M:%S" : $format);
    $format = ($format=='mysql-date' ? "%Y-%m-%d" : $format);
    $format = ($format=='mysql-datetime' ? "%Y-%m-%d %H:%M:%S" : $format);
    return (!empty($original) ? strftime($format, strtotime($original)) : "" );
}
?>

example (in HTML or webapp):
[grab from database]...
$dbase_stored_date = "2007-03-15";
$display_html_date = format_date($dbase_stored_date);
... displays as "03/15/2007"

example (saving form via on POST/GET):
$update_date = format_date($_POST['display_html_date'], 'mysql-date');
// converts back to '2007-03-15'
.... [your mysql update here]

Don't forget to sanitize your POST/GET's   =)*/

?>