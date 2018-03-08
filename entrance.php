<?php
include('mysql.php');

$boot_id 		= mysql_real_escape_string($_POST['boot_id']);
$code			= mysql_real_escape_string($_POST['code']);

$ex = explode('#', $code); // staff id, campaigin id 

$ar = array(
	'result' => false,
	'msg' => 'data not found boot id :'.$boot_id.' or campaign_id :'.$ex[1],
);
$sql = "SELECT * FROM boots WHERE boot_id = '".$boot_id."' AND campaign_id = '".$ex[1]."'";


$rs = mysql_query($sql) or die(mysql_error());

if (mysql_num_rows($rs) > 0) {
	$boots = '';
	while($f = mysql_fetch_assoc($rs)) {
		$boots = $f;
	}

	$sql = "SELECT staff_id, staff_code, name, position, mobile FROM staff WHERE staff_id like '%".$ex[0]."%' AND campaign_id = '".$ex[1]."'";
	$rs_staff = mysql_query($sql);
	$staff = '';
	while($f_staff = mysql_fetch_assoc($rs_staff)) {
		$staff = $f_staff;
	}

	if ($boots['type_boot'] == 'register') {
		$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
		mysql_query($sql);


		$sql = "UPDATE staff SET checkin = NOW() WHERE staff_id = '".$ex[0]."' AND campaign_id = '".$ex[1]."'";
		mysql_query($sql);


		$ar = array(
			'result' => true,
			'type' => 'register',
			'member' => $staff,
			'boot_id' => $boots['boot_id'],
			'boot_name' => $boots['boot_name'],
			'campaign_id' => $ex[1],
			'boot' => get_my_boot($ex[0], $ex[1]),
		);


	} else {
		if ($boots['access'] == 0) {
			$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
			mysql_query($sql);

			$ar = array(
				'result' => true,
				'type' => 'event',
				'member' => $staff,
				'boot_id' => $boots['boot_id'],
				'boot_name' => $boots['boot_name'],
				'campaign_id' => $ex[1],
				'boot' => get_my_boot($ex[0], $ex[1]),
			);

		} else {
			$sql = "SELECT (COUNT(ba_id)) as c FROM boots_access WHERE staff_id = '".$ex[0]."' AND campaign_id = '".$ex[1]."'";
			$rs2 = mysql_query($sql);
			if (mysql_num_rows($rs2) > 0) {
				while ($f = mysql_fetch_assoc($rs2)) {
					if ($f['c'] < $boots['access']) {
						$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
						mysql_query($sql);

						$ar = array(
							'result' => true,
							'type' => 'event',
							'member' => $staff,
							'boot_id' => $boots['boot_id'],
							'boot_name' => $boots['boot_name'],
							'campaign_id' => $ex[1],
							'boot' => get_my_boot($ex[0], $ex[1]),
						);
					} else {

						$ar = array(
							'result' => false,
							'boot_id' => $boots['boot_id'],
							'boot_name' => $boots['boot_name'],
							'campaign_id' => $ex[1],
							'type' => 'event',
							'msg' => 'คุณใช้สิทธิ์แล้ว'
						);


					}
				}
			} else {
				$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
						mysql_query($sql);

				$ar = array(
					'result' => true,
					'type' => 'event',
					'member' => $staff,
					'boot_id' => $boots['boot_id'],
					'boot_name' => $boots['boot_name'],
					'campaign_id' => $ex[1],
					'boot' => get_my_boot($ex[0], $ex[1]),
				);
			}
		}
	} 
}

echo json_encode($ar);


function get_my_boot($staff_id, $campaign_id) {
	$sql = "SELECT * FROM boots WHERE campaign_id = '".$campaign_id."'";
	$rs = mysql_query($sql);
	if (mysql_num_rows($rs) == 0) { 
		return array();
	} else {
		$ar = array();
		while($f = mysql_fetch_assoc($rs)) {
			$access = $f['access'];

 			$sql = "SELECT COUNT(ba_id) as c FROM boots_access JOIN boots ON boots_access.boot_id = boots.boot_id WHERE boots.campaign_id = '".$campaign_id."' AND boots_access.boot_id = '".$f['boot_id']."'";

			$total_access = 0;
			$all_access = 0;
			$rs2 = mysql_query($sql);
			if (mysql_num_rows($rs2) > 0) {
				while($f_as = mysql_fetch_assoc($rs2)) {
					$total_access = $f_as['c'];
				}

				if ($f['access'] == 0) {
					$all_access = 99;
				} else {
					
					if ($total_access < $access) {
						$all_access = $access - $total_access;
					} else {
						$all_access = 0;
					}
				}

			}

			$ar[] = array(
				'boot_id' => $f['boot_id'],
				'boot_name' => $f['boot_name'],
				'can_access' => $all_access
			);
		}


		return $ar;
	}
}
