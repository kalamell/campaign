<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Front {

	public function index()
	{
		$this->r = $this->md->getProfile();
		$this->render('member/index', $this);
	}

	public function update()
	{
		$ar = array(
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'name' => $this->input->post('name'),
		);
		if ($this->input->post('password') != NULL) {
			$ar['password'] = do_hash($this->input->post('password'));
		}

		$this->md->update($ar);
		$this->save();

		redirect('member');
	}

	public function campaign()
	{
		$this->rs = $this->md->getCampaign();
		$this->render('member/campaign/index', $this);
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

        	/*

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
			*/


			$handle = fopen("./upload/".$data['file_name'], "r");
			$k = 0;
			while (($data = fgets($handle)) !== FALSE) {
			    if ($k > 0) {
			    	list($order, $label, $name, $total) = explode(",", $data);
					$this->db->insert('prize', array(
						'order' => $order,
						'label' => $label,
						'name' => $name,
						'total' => $total,
						'campaign_id' => $this->input->post('campaign_id'),
					));
			    }
			    $k++;
			}
			fclose($handle);


        } 

        redirect('member/imp_prize/'.$this->input->post('campaign_id'));
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

        	/*
        				$src = base_url('upload/'.$data['file_name']);
			$lines 	= file($src);
			foreach($lines as $k => $line) {
				
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
			*/
			
			$handle = fopen("./upload/".$data['file_name'], "r");
			$k = 0;
			while (($data = fgets($handle)) !== FALSE) {
			    print_r($data).'<br>';
			    if ($k > 0) {
			    	list($code, $name, $position, $dep_name, $mobile, $email) = explode(",", $data);
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
			    $k++;
			}
			fclose($handle);

        } 
        redirect('member/imp_member/'.$this->input->post('campaign_id'));
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
		redirect('member/imp_prize/'.$campaign_id);

	}

	public function reset_prize($campaign_id)
	{
		$this->db->where('prize_id', $prize_id)->set('prize_id', null)->update('staff');
		redirect('member/imp_prize/'.$campaign_id);
	}

	

	public function reset_member($campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id)->delete('staff');
		redirect('member/imp_member/'.$campaign_id);

	}
	
}
