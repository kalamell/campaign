<?php
include('mysql.php');

/*

$force_group = isset($_GET['force_group']) ? mysql_real_escape_string($_GET['force_group']) : '';


$query 	= "SELECT * FROM  `prize` WHERE staff_id IS NULL and campaign_id = 'kerry' ORDER BY `order` ASC LIMIT 1";


$result = mysql_query($query);

$staff_id = '';
$data = array();
$prize_id = 0;
$fix_staff = '';
$filter_sql = '';
$total = 1;
$prize_name = '';
$checkin_active = 0;

while($row = mysql_fetch_assoc($result)){
	$filter_sql = $row['gg']=='' ? '' : " AND `staff`.`dep_id` IN (". $row['gg'] .")"; 
	
	$prize_id = $row['id'];
	$label = $row['label'];
	$order_id = $row['order'];

	$total = $row['total'];
	$prize_name = $row['name'];

	$checkin_active = $row['checkin_active'];

	if ($checkin_active == 1) {
		$filter_sql.= ' AND staff.checkin IS NOT NULL ';
	}
}


$query = "SELECT `staff`.*, `department`.`dep_name` as `staff_dep`  FROM `staff`,`department` WHERE `staff`.`dep_id` = `department`.`dep_id` AND staff.campaign_id = 'kerry' AND no_prize = 1 AND `staff`.`prize_id` IS NULL ".$filter_sql."  ORDER BY RAND() LIMIT ".$total;




$result = mysql_query($query);
$data = array();
if (mysql_num_rows($result) == 0) {
	$data[] = array(
		'id' => '0',
		'prize_name' => '- - - - -',
		'users' => array(
			array(
				'staff_id' => '000000',
				'name' => 'รอสักครู่ กำลังรอรางวัล'
			)
		)
	);
} else {

	if ($total == 1) {
		while($row = mysql_fetch_assoc($result)) {
			$data[] = array(
				'id' => $prize_id,
				'prize_name' => $prize_name,
				'users' => array(
					array(
						'staff_id' =>  $row['staff_id'],
						'name' => 'คุณ'.$row['name'],
					)
				)
			);
			
			$staff_id = $row['staff_id'];
		}
		mysql_query ("UPDATE `staff` SET `prize_id` = '".$prize_id."' WHERE `staff_id` = '".$staff_id."' LIMIT 1");

	} else {
		$member = array();

		if (mysql_num_rows($result) > 0) {
			$no = 1;

			while($row = mysql_fetch_assoc($result)) {

				$message = 'คุณ '.$row['name'].' ได้รางวัลลำดับที่ '.$order_id.' '.$label;
				$mobile = $row['mobile'];
				$mobile = '0954027399';
				//sendsms($mobile, $message);


				$member[] = array(
					'staff_id' =>  $row['staff_id'],
					'name' => 'คุณ'.$row['name'],
				);
				mysql_query ("UPDATE `staff` SET `prize_id` = '".$prize_id."', `prize_date` = NOW() WHERE `staff_id` = '".$row['staff_id']."' LIMIT 1");

				if ($no == 1) {
					mysql_query ("UPDATE `prize` SET `staff_id` = '".$row['staff_id']."', `staff_name` = '". $row['name'] ."', `staff_dep` = '". $row['staff_dep'] ."' WHERE `id` = '".$prize_id."' LIMIT 1");
			
				}
				$no++;
			}
			$data[] = array(
				'id' => $prize_id,
				'prize_name' => $prize_name,
				'users' => $member
			);
		}
	}
}
*/

$data = array();


$rand = rand(0, 1);






if ($rand == 0) {
	$users = array();
	for($i=1; $i<=20; $i++) {
		$users[] = array(
			'staff_id' => sprintf('%05d', $i),
			'name' => 'นาย ทดสอบ นามสกุลที่'.$i,
		);
	}


	$data[] = array(
		'id' => '1',
		'prize_name' => 'บัตร Starbug 20 รางวัล',
		'users' => $users
	);
	$message = 'คุณ ทดสอบ ได้รางวัลลำดับที่ 1 สตาร์บัค 200 บาท';

	//sendsms('0954027399', $message);

} else {

	$data[] = array(
		'id' => '2',
		'prize_name' => 'เที่ยวญี่ปุ่น 1 วัน 1 คืน',
		'users' => array(
			array(
				'staff_id' => '00001',
				'name' => 'นายเดียว มาทดสอบ'
			)
		)
	);

	$message = 'คุณ ทดสอบ ได้รางวัลลำดับที่ 2 เที่ยวญี่ปุ่น 1 วัน 1 คืน';
	
}



echo json_encode($data);
?>