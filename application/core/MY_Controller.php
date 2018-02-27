<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id')) redirect('auth');
		$this->load->model('member_model', 'md');		
		$this->load->model('campaign_model', 'cp');
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


class Main_Event extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		echo $this->uri->segment(2);
		
		$this->load->model('member_model', 'md');		
		$this->load->model('campaign_model', 'cp');
	}

	
}


class Backend extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!isStaff()) redirect('');
		$this->load->model('member_model', 'md');
		$this->load->model('campaign_model', 'cp');
	}

	protected function render($view, $data = array()) 
	{
		$this->load->view('header', $data);
		$this->load->view('backend/'.$view, $data);
		$this->load->view('footer', $data);
	}

	protected function save()
	{
		$this->session->set_flashdata('save', 1);
	}
}
