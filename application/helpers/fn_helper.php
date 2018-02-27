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