<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {
	private $staff_id = null;
	private $campaign_id = null;
	public function __construct()
	{
		parent::__construct();
		$this->staff_id = $this->input->cookie('staff_id');
		$this->campaign_id = 'major01';
		$this->load->model('campaign_model', 'cp');

		if ($this->staff_id == null) redirect('');
	}
	public function index()
	{
		$this->rs = $this->cp->getVote($this->campaign_id);
		$this->load->view('campaign/vote/form', $this);
	}

	public function loaddata()
	{
		echo '<div class="modal-body">Loading...</div>';
	}

	public function data($campaign_id, $vote_id)
	{
		$r = $this->db->where('vote_id', $vote_id)->get('vote')->row();

		$chk = $this->db->where(array(
			'campaign_id' => $this->campaign_id,
			'type' => $r->type,
			'staff_id' => $this->staff_id
		))->join('vote', 'vote_member.vote_id = vote.vote_id')->get('vote_member')->num_rows();

		if ($chk == 0) {
			$this->disable = 'false';
		} else {
			$this->disable = 'true';
		}

		$this->r = $r;

		$this->load->view('campaign/vote/data', $this);

	}

	public function confirm()
	{
		$vote_id = $this->input->post('vote_id');

		$r = $this->db->where('vote_id', $vote_id)->get('vote')->row();
		$chk = $this->db->where(array(
			'campaign_id' => $this->campaign_id,
			'type' => $r->type,
			'staff_id' => $this->staff_id
		))->join('vote', 'vote_member.vote_id = vote.vote_id')->get('vote_member')->num_rows();

		//echo $this->db->last_query();

		if ($chk == 0) {
			$this->db->set('created_date', 'NOW()', false)->insert('vote_member', array(
				'vote_id' => $vote_id,
				'staff_id' => $this->staff_id
			));
		}

	}
}