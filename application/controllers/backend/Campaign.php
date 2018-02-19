<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends Backend {

	public function index()
	{
		$this->rs = $this->cp->fetchAll();
		$this->render('campaign/index', $this);
	}

	public function add()
	{
		$this->member = $this->md->fetchAll();
		$this->render('campaign/add', $this);
	}

	public function edit($id)
	{
		$this->member = $this->md->fetchAll();
		$this->r = $this->cp->getData($id);
		$this->render('campaign/edit', $this);
	}

	public function delete($id)
	{
		$this->db->where('campaign_id', $id)->delete('campaign');
		redirect('backend/campaign');
	}

	public function update()
	{
		$ar = array(
			'campaign_name' => $this->input->post('campaign_name'),
			'total_user' => $this->input->post('total_user'),
			'member_id' => $this->input->post('member_id'),
			'on_date' => $this->input->post('on_date'),
			'end_date' => $this->input->post('end_date'),
			'lucky_draw' => $this->input->post('lucky_draw'),
		);
		$this->cp->update($ar, $this->input->post('campaign_id'));

		redirect('backend/campaign/edit/'.$this->input->post('campaign_id'));
	}

	public function save()
	{
		$ar = array(
			'campaign_name' => $this->input->post('campaign_name'),
			'total_user' => $this->input->post('total_user'),
			'member_id' => $this->input->post('member_id'),
			'on_date' => $this->input->post('on_date'),
			'end_date' => $this->input->post('end_date'),
			'lucky_draw' => $this->input->post('lucky_draw'),
		);
		$this->cp->save($ar);
		redirect('backend/campaign');
	}


	public function imp_prize($campaign_id)
	{

	}

	public function imp_member($campaign_id)
	{
		
	}
	
}
