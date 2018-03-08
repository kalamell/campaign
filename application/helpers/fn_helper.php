<?php 

function isMember()
{
	$ci =& get_instance();

	if ($ci->session->userdata('id')) {
		$rs = $ci->db->where('id', $ci->session->userdata('id'))->get('member');
		return $rs->row();
	}

	return false;
}

function isStaff()
{
	$ci =& get_instance();

	if ($ci->session->userdata('id')) {
		$rs = $ci->db->where('id', $ci->session->userdata('id'))->get('member');
		if ($rs->row()->isstaff=='Y') 
			return true;
	}

	return false;
}


function save()
{
	$ci =& get_instance();

	if ($ci->session->flashdata('save')) {
		return '<div class="alert alert-success"><strong>บันทึกข้อมูลเรียบร้อย</strong></div>';
	}
}

function getMemberPrize($campaign_id, $prize_id)
{
	$ci =& get_instance();
	$rs = $ci->db->where(array(
		'campaign_id' => $campaign_id,
		'prize_id' => $prize_id
	))->order_by('staff_id')->get('staff')->result();
	return $rs;

}

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    
    
    $ci =& get_instance();
    $rs = $ci->db->where('campaign_id', $randomString)->get('campaign');
    if ($rs->num_rows() > 0) {
    	generateRandomString(5);
    } else {
    	return $randomString;
    }

}


function get_access($staff_id, $campaign_id) {
	$ci =& get_instance();
	$sql = "SELECT * FROM boots WHERE campaign_id = ?";
	$rs = $ci->db->query($sql, array($campaign_id));
	if ($rs->num_rows() == 0) {
		return array();
	} else {
		$ar = array();
		foreach($rs->result_array() as $f) {
			$access = $f['access'];
			$total_access = 0;
			$all_access = 0;

			$sql = "SELECT COUNT(ba_id) as c FROM boots_access JOIN boots ON boots_access.boot_id = boots.boot_id WHERE boots.campaign_id = ? AND boots_access.boot_id = ? AND staff_id = ?";
			$rs2 = $ci->db->query($sql, array(
				$campaign_id, $f['boot_id'], $staff_id
			));

			if ($rs2->num_rows() > 0) {
				$total_access = $rs2->row()->c;
			}

			if ($access == 0) {
				$all_access = 99;
			} else {
				if ($total_access < $access) {
					$all_access = $access - $total_access;
				} else {
					$all_access = 0;
				}
			}
			$ar[] = array(
				'boot_id' => $f['boot_id'],
				'boot_name' => $f['boot_name'],
				'can_access' => $all_access,
				'accessed' => $all_access == 0 ? false : true,
			);
		}
	}
	return $ar;
}