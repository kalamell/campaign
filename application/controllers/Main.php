<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Front {

	public function index()
	{
		$campaign_id = 'major01';

		$rs = $this->db->where('campaign_id', $campaign_id)->get('campaign');
		if ($rs->num_rows() == 0) redirect('');

		$this->r = $rs->row();

		if ($rs->row()->register == 0) {
			$this->staff = $this->db->where('campaign_id', $campaign_id)->get('staff')->result();
		
			$this->load->view('campaign/register/index', $this);
		} else {
			$this->campaign_id = $campaign_id;
			$this->load->view('register/main', $this);
		}

	}

	public function register($campaign_id = '')
	{
		$campaign_id = 'major01';

		$rs = $this->db->where('campaign_id', $campaign_id)->get('campaign');
		if ($rs->num_rows() == 0) redirect('');

		$this->r = $rs->row();

		if ($rs->row()->register == 0) {
			$this->staff = $this->db->where('campaign_id', $campaign_id)->get('staff')->result();
		
			$this->load->view('campaign/register/index', $this);
		} else {
			$this->load->view('register/main', $this);
		}
	}
}
