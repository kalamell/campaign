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
		$rs = $this->db->select('*,prize.name, prize.id as prize_id, prize.campaign_id')->where('prize.campaign_id', $campaign_id)->join('staff', 'prize.staff_id = staff.staff_id', 'LEFT')->order_by('prize.order', 'ASC')->order_by('prize.id')->group_by('prize.id')->get('prize')->result();

		

		return $rs;


	}

	public function getStaff($campaign_id, $limit = '', $per_page = 0)
	{
		if ($limit !='') {
			$this->db->limit($limit, $per_page);
		}
		return $this->db->select('*,staff.name, staff.id as id, staff.staff_id as staff_id, prize.name as prize_name, staff.campaign_id')->where('staff.campaign_id', $campaign_id)
			->join('department', 'staff.dep_id = department.dep_id', 'LEFT')
			->join('prize', 'staff.prize_id = prize.id', 'LEFT')->order_by('staff.id', 'asc')->get('staff')->result();


	}


	public function getBoot($campaign_id)
	{
		return $this->db->where('campaign_id', $campaign_id)->get('boots')->result();
	}

	public function getVote($campaign_id, $active = 1)
	{
		if ($active == 1) {
			$this->db->where('active', 1);
		}

		return $this->db->select('*,(SELECT COUNT(vote_id) FROM vote_member WHERE vote_member.vote_id = vote.vote_id) as c')->where('campaign_id', $campaign_id)->order_by('c', 'DESC')->get('vote')->result();
	}
}