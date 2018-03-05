<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function index()
	{
		redirect('');
	}

	public function id($campaign_id)
	{
		echo 'id';
	}


	public function register($campaign_id)
	{
		$rs = $this->db->where('campaign_id', $campaign_id)->get('campaign');
		if ($rs->num_rows() == 0) redirect('');

		$this->r = $rs->row();

		if ($rs->row()->register == 0) {
			$this->staff = $this->db->where('campaign_id', $campaign_id)->get('staff')->result();
		
			$this->load->view('campaign/register/index', $this);
		} else {
			$this->load->view('register/main', $this);
		}
	}

	public function confirm_data($campaign_id, $staff_id)
	{
		$this->r = $this->db->where('campaign_id', $campaign_id)->where('staff_id', $staff_id)->get('staff')->row();
		$this->load->view('register/confirm', $this);
	}


	public function confirm($campaign_id = '')
	{

		$campaign_id = $campaign_id == '' ? $this->input->post('campaign_id') : $campaign_id;
		
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
			$this->db->like('staff_id', $this->input->post('code'))->where('campaign_id', $campaign_id)->set('checkin', 'NOW()', false)->update('staff', array(
				//'staff_code' => $id,

			));

			$rs = $this->db->like('staff_id', $this->input->post('code'))->where('campaign_id', $campaign_id)->get('staff');

			$ar = array(
				'staff_code' => $rs->row()->staff_id,
				'data' => $rs->row_array()
			);
		}

		echo json_encode($ar);
	}

	private function getid()
	{
		$this->load->helper('string');
		$str = random_string('alnum', 5);
		
		$rs = $this->db->where('staff_code', $str)->get('staff');
		if ($rs->num_rows()==0) {
			return $str;
		} else {
			$this->getid();
		}
	}

	public function code($campaign_id, $staff_code)
	{
		$rs = $this->db->like('staff_id', $staff_code)->get('staff');

		
		

        if ($rs->num_rows()>0) {
        	$this->r = $rs->row();
            $this->load->view('register/id', $this);
        } else {
            //redirect('event/'.$campaign_id.'/register');
        }

	}

	public function qr($campaign_id, $staff_code)
	{
		$this->db->set('checkin', 'NOW()', false)->where(array(
			'campaign_id' => $campaign_id,
			'staff_code' => $staff_code
		))->get('staff');
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
			$rs = $this->db->where('campaign_id', $this->input->post('campaign_id'))->like('staff_id', $this->input->post('code'))->get('staff');
			if ($rs->num_rows()==0) {
				$ar = array(
					'result' => false,
					'msg' => 'ไม่มีรหัสนี้ในระบบ',
				);
			} else {
				$this->db->where('campaign_id', $this->input->post('campaign_id'))->like('staff_id', $this->input->post('code'))->update('staff', array(
					'mobile' => $this->input->post('mobile'),
				));

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

	public function checkregister()
	{
		$ar = array(
			'result' => false,
			'error_code' => '404',
		);
		$rs = $this->db->where(array(
			'staff_id' => $this->input->post('staff_id'),
			'campaign_id' => $this->input->post('campaign_id')
		))->get('staff');
		if ($rs->num_rows() > 0) {
			if ($rs->row()->checkin != null) {
				$ar = array(
					'result' => false,
					'error_code' => '503',
					'data' => $rs->row_array(),
				);
			} else {
				

				$ar = array(
					'result' => true,
					'data' => $rs->row()
				);
			}
		}

		echo json_encode($ar);
	}

	public function savedata()
	{
		$note = '';
		if ($this->input->post('staff_id')) {
			$note = 'แทน รหัสร้าน '.$this->input->post('staff_id');
		}
		$code = $this->getid();
		$this->db->insert('staff', array(
			'staff_id' => date('dHis'),
			'staff_code' => $code,
			'name' => $this->input->post('name').' '.$this->input->post('lastname'),
			'checkin' => date('Y-m-d H:i:s'),
			'note' => $note.$this->input->post('note'),
			'email' => $this->input->post('email'),
			'mobile' => $this->input->post('mobile'),
			'campaign_id' => $this->input->post('campaign_id'),
		));
	}
	/*
	public function confirm()
	{
		$this->db->set('checkin', 'NOW()', false)
		->where(array(
			'staff_id' => $this->input->post('staff_id'),
			'campaign_id' => $this->input->post('campaign_id')
		))->update('staff');
		echo json_encode(array('result' => true));
	}*/

}
