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