<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Campaign {

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
}
