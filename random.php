<?php
include('mysql.php');

$query 	= "SELECT * FROM  `prize` WHERE staff_id IS NULL AND total = 1 ORDER BY `order` ASC LIMIT 1";

$result = mysql_query($query);

$staff_id = '';
$data = array();
$prize_id = 0;
$fix_staff = '';
$filter_sql = '';
while($row = mysql_fetch_assoc($result)){
	$filter_sql = $row['gg']=='' ? '' : " AND `staff`.`dep_id` IN (". $row['gg'] .")"; 
	
	$prize_id = $row['id'];
}


$query = "SELECT `staff`.*, `department`.`dep_name` as `staff_dep`  FROM `staff`,`department` WHERE `staff`.`dep_id` = `department`.`dep_id` AND `checkin` IS NOT NULL AND no_prize = 1 AND `staff`.`prize_id` IS NULL ".$filter_sql."  ORDER BY RAND() LIMIT 1";




$result = mysql_query($query);
$data = array();
if (mysql_num_rows($result) == 0) {
	$data[] = array(
		'id' => '0',
		'staff_id' => 'P0000',
		'name' => 'xxxx xxxxxx'
	);
} else {


	while($row = mysql_fetch_assoc($result)) {
		$data[] = array(
			'id' => $prize_id,
			'staff_id' => 'P'.$row['staff_id'],
			'name' => 'คุณ'.$row['name'],
		);
		
		$staff_id = $row['staff_id'];
	}
}

mysql_query ("UPDATE `staff` SET `prize_id` = '".$prize_id."' WHERE `staff_id` = '".$staff_id."' LIMIT 1");

echo json_encode($data);
?>