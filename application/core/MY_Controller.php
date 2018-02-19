<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id')) redirect('auth');
		$this->load->model('member_model', 'md');
	}

	protected function render($view, $data = array()) 
	{
		$this->load->view('header', $data);
		$this->load->view('campaign/'.$view, $data);
		$this->load->view('footer', $data);
	}

	protected function save()
	{
		$this->session->set_flashdata('save', 1);
	}
}



class Backend extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	protected function render($view, $data = array()) 
	{
		$this->load->view('backend/'.$view, $data);
	}

	protected function save()
	{
		$this->session->set_flashdata('save', 1);
	}
}
