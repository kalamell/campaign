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
	$rs = mysql_query($sql);

	if (mysql_num_rows($rs) > 0) {
		$boots = '';
		while($f = mysql_fetch_assoc($rs)) {
			$boots = $f;
		}

		if ($boots['type_boot'] == 'register') {
			$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
			mysql_query($sql);


			$sql = "UPDATE staff SET checkin = NOW() WHERE staff_id = '".$ex[0]."' AND campaign_id = '".$ex[1]."'";
			mysql_query($sql);


			$ar = array(
				'result' => true,
				'type' => 'register',
				'data' => array(
					'boot_id' => $boots['boot_id'],
					'boot_name' => $boots['boot_name'],
				)
			);


		} else {
			if ($boots['access'] == 0) {
				$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
				mysql_query($sql);

				$ar = array(
					'result' => true,
					'type' => 'event',
					'data' => array(
						'boot_id' => $boots['boot_id'],
						'boot_name' => $boots['boot_name'],
					)
				);

			} else {
				$sql = "SELECT (COUNT(ba_id)) as c FROM boots_access WHERE staff_id = '".$ex[0]."' AND campaign_id = '".$ex[1]."'";
				$rs2 = mysql_query($sql);
				while ($f = mysql_fetch_assoc($rs2)) {
					if ($f['c'] < $boots['access']) {
						$sql = "INSERT INTO boots_access(boot_id, staff_id, created_date) VALUES('".$boot_id."', '".$ex[0]."', NOW())";
						mysql_query($sql);

						$ar = array(
							'result' => true,
							'type' => 'event',
							'data' => array(
								'boot_id' => $boots['boot_id'],
								'boot_name' => $boots['boot_name'],
							)
						);
					} else {

						$ar = array(
							'result' => false,
							'type' => 'event',
							'msg' => 'คุณใช้สิทธิ์แล้ว'
						);

					}
				}
			}
		} 
	}

	echo json_encode($ar);
	