<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model {

	public function fetchAll($member_id = '')
	{
		if ($member_id !='') {
			$this->db->where('campaign.member_id', $member_id);
		}
		return $this->db->join('member', 'campaign.member_id = member.id')->get('campaign')->result();
	}

	public function save($ar)
	{
		$this->db->insert('campaign', $ar);
	}


	public function update($ar, $campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id);
		$this->db->update('campaign', $ar);
	}

	public function getData($campaign_id, $member_id = '')
	{
		if ($member_id !='') {
			$this->db->where('campaign.member_id', $member_id);
		}
		return $this->db->where('campaign_id', $campaign_id)->get('campaign')->row();
	}

	public function getPrize($campaign_id)
	{
		return $this->db->select('*,prize.name, prize.id as prize_id, prize.campaign_id')->where('prize.campaign_id', $campaign_id)->join('staff', 'prize.staff_id = staff.staff_id', 'LEFT')->get('prize')->result();
	}

	public function getStaff($campaign_id)
	{
		return $this->db->select('*,staff.name, staff.id as id, staff.staff_id as staff_id, prize.name as prize_name')->where('staff.campaign_id', $campaign_id)
			->join('department', 'staff.dep_id = department.dep_id', 'LEFT')
			->join('prize', 'staff.staff_id = prize.staff_id', 'LEFT')->order_by('staff.staff_id', 'asc')->get('staff')->result();
	}
}