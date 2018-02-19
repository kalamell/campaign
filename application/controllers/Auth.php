<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model', '_auth');

		//echo do_hash('member1');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('auth/login');
		$this->load->view('footer');
	}

	public function do_login()
	{
		$config = array(
			array(
				'field' => 'username',
				'label' => 'username',
				'rules' => 'required'
			),
			array(
				'field' => 'password',
				'label' => 'password',
				'rules' => 'required'
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			$rs = $this->_auth->checkMember($this->input->post('username'), $this->input->post('password'));

			if (!$rs) {
				redirect('auth');
			} else {
				redirect('');
			}
		} else {
			redierct('auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
