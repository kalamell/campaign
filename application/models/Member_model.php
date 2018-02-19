<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	private $id;

	public function __construct()
	{
		parent::__construct();
		$this->id = $this->session->userdata('id');
	}

	public function getProfile()
	{
		$rs = $this->db->where('id', $this->id)->get('member');
		return $rs->row();
	}

	public function update($data)
	{
		return $this->db->where('id', $this->id)->update('member', $data);
	}

	public function getCampaign($member_id = '')
	{
		if ($member_id != '') {
			$this->db->where('member_id', $member_id);
		} else {
			$this->db->where('member_id', $this->id);
		}

		return $this->db->get('campaign')->result();
	}

	public function createCampaign($member_id = '')
	{
		if ($member_id != '') {
			$this->db->set('member_id', $member_id);
		} else {
			$this->db->set('member_id', $this->id);
		}

	}
}