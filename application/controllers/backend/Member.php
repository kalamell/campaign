<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Backend {

	public function index()
	{
		$this->rs = $this->md->fetchAll();
		$this->render('member/index', $this);
	}

	public function add()
	{
		$this->render('member/add');
	}

	public function edit($id)
	{
		$this->r = $this->md->getProfile($id);
		$this->render('member/edit', $this);
	}

	public function update()
	{
		$ar = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'name' => $this->input->post('name'),
			'isstaff' => $this->input->post('isstaff'),
			'active' => $this->input->post('active'),
			'startdate' => $this->input->post('startdate'),
			'enddate' => $this->input->post('enddate'),
		);
		if ($this->input->post('password') != NULL) {
			$ar['password'] = do_hash($this->input->post('password'));
		}

		$this->md->update($ar, $this->input->post('id'));
		redirect('backend/member');
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('member');
		redirect('backend/member');
	}

	public function save()
	{
		$ar = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'name' => $this->input->post('name'),
			'password' => do_hash($this->input->post('password')),
			'isstaff' => $this->input->post('isstaff'),
			'active' => $this->input->post('active'),
			'startdate' => $this->input->post('startdate'),
			'enddate' => $this->input->post('enddate'),
		);
		$this->md->save($ar);
		redirect('backend/member');
	}
}
