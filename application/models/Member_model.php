<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	private $id;

	public function __construct()
	{
		parent::__construct();
		$this->id = $this->session->userdata('id');
	}

	public function fetchAll()
	{
		return $this->db->get('member')->result();
	}
	public function getProfile($id = '')
	{
		if ($id !='') {
			$this->db->where('id', $id);
		} else {
			$this->db->where('id', $this->id);
		}
		$rs = $this->db->get('member');
		return $rs->row();
	}

	public function update($data, $id = '')
	{
		if ($id !='') {
			$this->db->where('id', $id);
		} else {
			$this->db->where('id', $this->id);
		}
		return $this->db->update('member', $data);
	}

	public function getCampaign($member_id = '')
	{
		if ($member_id != '') {
			$this->db->where('member_id', $member_id);
		} else {
			$this->db->where('member_id', $this->id);
		}
		$this->db->select('*,(SELECT COUNT(staff_id) FROM staff where staff.campaign_id = campaign.campaign_id AND checkin IS NULL) as notcome,(SELECT COUNT(staff_id) FROM staff where staff.campaign_id = campaign.campaign_id AND checkin IS NOT NULL) as comein');
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

	public function save($data)
	{
		$this->db->insert('member', $data);
	}


	public function dep($dep_name, $campaign_id)
	{
		$rs = $this->db->where('dep_name', $dep_name)->where('campaign_id', $campaign_id)->get('department');
		if ($rs->num_rows() > 0) {
			return $rs->row()->dep_id;
		} else {
			$this->db->insert('department', array(
				'dep_name' => $dep_name,
				'campaign_id' => $campaign_id
			));

			return $this->db->insert_id();
		}
	}

}