<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('main');
	}

	public function confirm_data($id)
	{
		$data['r'] = $this->db->where('code', $id)->get('member')->row();
		$this->load->view('confirm', $data);
	}

	public function id($id)
	{
		$data['r'] = $this->db->where('code', $id)->join('color', 'member.color = color.code_id')->get('member')->row();
		$this->load->view('id', $data);
	}

	

	public function checkuser()
	{
		$ar = array(
			'result' => false,
			'msg' => '',
		);
		$config = array(
			array(
				'field' => 'code',
				'label' => 'Staff ID',
				'rules' => 'required'
			),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			$rs = $this->db->like('code', $this->input->post('code'))->get('member');
			if ($rs->num_rows()==0) {
				$ar = array(
					'result' => false,
					'msg' => 'ไม่มีรหัสนี้ในระบบ',
				);
			} else {
				$this->db->like('code', $this->input->post('code'))->set('entrance_date2', 'NOW()', false)->update('member');
				/*if ($rs->row()->id == '') {
					$rs2 = $this->db->like('code', $rs->row()->code)->get('member');
					$ar = array(
						'result' => true,
						'exists' => false,
						'data' => $rs2->row()
					);
				} else {
					$ar = array(
						'result' => true,
						'exists' => true,
						'data' => $rs->row()
					);
				}
				*/

				$ar = array(
					'result' => true,
					'exists' => true,
					'data' => $rs->row()
				);
			}
		} else {
			$ar = array(
				'result' => false,
				'msg' => 'กรอกข้อมูลไม่ถูกต้อง',
			);
		}
		echo json_encode($ar);
	}


	public function confirm()
	{
		$ar = array(

		);

		$config = array(
			array(
				'field' => 'code',
				'label' => 'Staff ID',
				'rules' => 'required'
			),
			
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run()) {
			$id = $this->getid();
			$this->db->where('code', $this->input->post('code'))->set('register_date', 'NOW()', false)->update('member', array(
				'id' => $this->input->post('code'),
			));

			$ar = array(
				'id' => $this->input->post('code')
			);
		}

		echo json_encode($ar);
	}

	private function getid()
	{
		$this->load->helper('string');
		$str = random_string('alnum', 5);
		
		$rs = $this->db->where('id', $str)->get('member');
		if ($rs->num_rows()==0) {
			return $str;
		} else {
			$this->getid();
		}
	}
	
	public function data_static()
	{
		$data['rs'] = $this->db->where_in('code_id', array('06', '03', '01', '04'))->get('color')->result();
		$this->load->view('static', $data);
	}
	
	
	public function import_member()
	{
		//85470	ณัฐฐิฐา	พงษ์สระพัง	PBM	First SA	0616153591
		$src 	= base_url().'data/data5.txt';
		$lines 	= file($src);
		foreach($lines as $line) {
			// code, name, surname, position, branch, area, mobile , allergy, color
			list($code, $name, $surname, $position, $branch, $mobile) = explode("\t", $line);
			$this->db->set('register_date', 'NOW()', false)->set('entrance_date', 'NOW()', false)->insert('member', array(
				'code' => trim($code),
				'name' => trim($name),
				'surname' => trim($surname),
				'position' => trim($position),
				'mobile' => trim($mobile),
				'branch' => trim($branch),
				'color' => '01',
				'entrance' => 1,
				'cancel' => 1
				
			));
			
		}

	}

	public function import_prize()
	{
	
		$src 	= base_url().'data/prize.txt';
		$lines 	= file($src);
		$no = 1;
		foreach($lines as $line) {
			// code, name, surname, position, branch, area, mobile , allergy, color
			list($name) = explode("\t", $line);
			$this->db->insert('prize', array(
				'id' => trim($no),
				'label' => 'L-'.$no,
				'name' => trim($name),
				'order' => $no
			));
			$no++;
			
		}

	}


	private function _color($group) 
	{
		$ar = array(
			'เทา' => '01',
			'น้ำตาล' => '02',
			'ขาว' => '04',
			'ทอง' => '05',
			'ดำ' => '06',
			'ม่วงเข้ม' => '03',
			'ม่วง' => '03',
		);

		return $ar[$group];

	}

	public function static_data()
	{
		$regis = $this->db->where('register_date !=', null)->count_all_results('member');
		$not_regis = $this->db->where('register_date', null)->count_all_results('member');


		$checkin = $this->db->where('entrance_date !=', null)->where('register_date !=', null)->count_all_results('member');
		$not_checkin = $this->db->where('entrance_date', null)->where('register_date !=', null)->count_all_results('member');

		$rs1 = $this->db->select('*, (SELECT COUNT(code) from member where member.color = color.code_id and entrance_date is not null and register_date is not null) as c ')->get('color')->result_array();
		$rs2 = $this->db->select('*, (SELECT COUNT(code) from member where member.color = color.code_id and entrance_date is null and register_date is not null) as c ')->get('color')->result_array();
		
		$rs3 = $this->db->select('*, (SELECT COUNT(code) from member where member.color = color.code_id and register_date is not null) as c ')->get('color')->result_array();
		

		$ar = array(
			'regis' => $regis,
			'not_regis' => $not_regis,
			'checkin' => $checkin,
			'not_checkin' => $not_checkin,
			'c1' => $rs1,
			'c2' => $rs2,
			'c3' => $rs3,
		);

		echo json_encode($ar);
	}

	public function member()
	{
		if ($this->input->get('status')==1) {
			$this->db->where('register_date is not null', '', false);
		}

		if ($this->input->get('status')==2) {
			$this->db->where('register_date is null', '', false);
		}

		if ($this->input->get('status')==3) {
			$this->db->where('register_date is not null and entrance_date is null', '', false);
		}

		if ($this->input->get('status')==4) {
			$this->db->where('register_date is not null and entrance_date is not null', '', false);
		}

		$data['status'] = $this->input->get('status');

		$data['rs'] = $this->db->join('color', 'member.color = color.code_id', 'LEFT')->get('member')->result_array();
        $this->load->view('backend/member', $data);
    }

	public function prize()
	{
		$data['status'] = $this->input->get('status');

		$data['rs'] = $this->db->order_by('order', 'asc')->get('prize')->result_array();
		$this->load->view('backend/prize2', $data);
	}




}
