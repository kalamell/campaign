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
		$this->rs = $this->cp->getPrize($campaign_id);
		$this->f = $this->cp->getData($campaign_id);
		$this->render('campaign/prize', $this);
	}

	public function do_prize()
	{
		$config['upload_path']          = './upload/';
        $config['allowed_types']        = 'csv';
        $config['file_name']            = 'prize-'.$this->input->post("campaign_id");
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {
        	$data = $this->upload->data();

        	$src = base_url('upload/'.$data['file_name']);
			$lines 	= file($src);
			foreach($lines as $k => $line) {
				// code, name, surname, position , mobile, branch , district, area,  group
				if ($k > 0) {
					list($order, $label, $name, $total) = explode(",", $line);
					$this->db->insert('prize', array(
						'order' => $order,
						'label' => $label,
						'name' => $name,
						'total' => $total,
						'campaign_id' => $this->input->post('campaign_id'),
					));
				}
			}


        } 

        redirect('backend/campaign/imp_prize/'.$this->input->post('campaign_id'));
	}

	public function do_staff()
	{
		$config['upload_path']          = './upload/';
        $config['allowed_types']        = 'csv';
        $config['file_name']            = 'staff-'.$this->input->post("campaign_id");
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {
        	$data = $this->upload->data();

        	$src = base_url('upload/'.$data['file_name']);
			$lines 	= file($src);
			foreach($lines as $k => $line) {
				// code, name, surname, position , mobile, branch , district, area,  group
				if ($k > 0) {
					list($code, $name, $position, $dep_name, $mobile, $email) = explode(",", $line);
					$this->db->insert('staff', array(
						'staff_id' => $code,
						'name' => $name,
						'position' => $position,
						'dep_id' => $this->md->dep($dep_name, $this->input->post('campaign_id')),
						'mobile' => $mobile,
						'email' => $email,
						'campaign_id' => $this->input->post('campaign_id'),
					));
				}
			}


        } 

        redirect('backend/campaign/imp_member/'.$this->input->post('campaign_id'));
	}

	public function imp_member($campaign_id)
	{
		$this->rs = $this->cp->getStaff($campaign_id);
		$this->f = $this->cp->getData($campaign_id);
		$this->render('campaign/staff', $this);
		
	}

	public function delete_prize($campaign_id, $prize_id)
	{

		$this->db->where('id', $prize_id)->delete('prize');
		$this->db->where('prize_id', $prize_id)->set('prize_id', null)->update('staff');
		redirect('backend/campaign/imp_prize/'.$campaign_id);

	}

	public function reset_prize($campaign_id)
	{
		$this->db->where('prize_id', $prize_id)->set('prize_id', null)->update('staff');
		redirect('backend/campaign/imp_prize/'.$campaign_id);
	}

	

	public function reset_member($campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id)->delete('staff');
		redirect('backend/campaign/imp_member/'.$campaign_id);

	}
	
}
