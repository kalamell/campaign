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
}