<?php
include('mysql.php');

$boot_id 		= mysql_real_escape_string($_POST['boot_id']);
$code			= mysql_real_escape_string($_POST['code']);

$ex = explode('#', $code); // staff id, campaigin id 

$ar = array(
	'result' => false,
	'msg' => 'data not found boot id :'.$boot_id.' or campaign_id :'.trim($ex[1]),
);

$ar = get_access($ex[0], trim($ex[1]));

$sql = "SELECT staff_id, staff_code, name, position, mobile, seat FROM staff WHERE staff_id like '%".$ex[0]."%' AND campaign_id = '".$ex[1]."'";

$rs_staff = mysql_query($sql) or die(mysql_error());
$staff = '';
while($f_staff = mysql_fetch_assoc($rs_staff)) {
	$staff = $f_staff;
}

$ar['staff'] = $staff;
echo json_encode($ar);

function get_access($staff_id, $campaign_id) {
	$sql = "SELECT * FROM boots WHERE campaign_id = '".$campaign_id."'";

	

	$rs = mysql_query($sql);
	if (mysql_num_rows($rs) == 0) { 
		return array();
	} else {
		$ar = array();
		while($f = mysql_fetch_assoc($rs)) {
			$access = $f['access'];

 			$sql = "SELECT COUNT(ba_id) as c FROM boots_access JOIN boots ON boots_access.boot_id = boots.boot_id WHERE boots.campaign_id = '".$campaign_id."' AND boots_access.boot_id = '".$f['boot_id']."' AND staff_id = '".$staff_id."'";

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
				'can_access' => $all_access,
				'accessed' => $all_access == 0 ? false : true,
			);
		}

		return $ar;
	}
}
