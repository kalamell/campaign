<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function checkMember($username, $password)
	{
		$rs = $this->db->where(array(
			'username' => $username,
			'password' => do_hash($password)
		))->get('member');

		if ($rs->num_rows() > 0) {
			if ($rs->row()->isstaff == 'Y') {
				$this->session->set_userdata('id', $rs->row()->id);
				return true;
			} else {


				if ($this->expire($rs->row()->id)) {
					$this->session->set_flashdata('expire', 1);
					return false;
				} else {
					if ($rs->row()->active == 0) {
						$this->session->set_flashdata('expire', 1);
						return false;
					} else {
						$this->session->set_userdata('id', $rs->row()->id);
						return true;
					}
				}
			}
		}

		$this->session->set_flashdata('error', 1);

		return false;
		
	}

	public function expire($user_id)
	{
		return false;

	}
}