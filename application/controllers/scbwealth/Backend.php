<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
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


		if ($this->input->get('status')==5) {
			$this->db->where('entrance_date is not null and entrance_date2 is not null', '', false)->order_by('entrance_date2', 'ASC');
		}

		if ($this->input->get('status')==6) {
			$this->db->where('entrance_date is not null and entrance_date2 is null', '', false)->order_by('entrance_date2', 'ASC');
		}

		$data['status'] = $this->input->get('status');

		$data['rs'] = $this->db->join('color', 'member.color = color.code_id', 'LEFT')->get('member')->result_array();
        $this->load->view('backend/index', $data);
    }
    
	public function reset()
	{
		if ($this->input->get('type') == 'register') {
			$this->db->update('member', array(
				'register_date' => null,
				'entrance_date' => null,
				'id' => null
			));
		}

		if ($this->input->get('type') == 'entrance') {
			$this->db->update('member', array(
				'entrance_date' => null,
			));
		}



		redirect('backend');
	}

	public function reset_prize()
	{
		$this->db->update('member', array(
			'prize_id' => null,
			'prize_date' => null
		));

		$this->db->update('prize', array(
			'staff_id' => null,
			'staff_name' => null
		));

		redirect('backend/prize');
	}

	public function prize()
	{
		$data['status'] = $this->input->get('status');
		
		if ($this->input->get('status')==1) {
			$this->db->where('staff_id is not null', '', false);
		}

		$data['rs'] = $this->db->select('*, prize.name as prize_name')
			->join('member', 'prize.staff_id = member.code')
			->join('color', 'member.color = color.code_id')
			->order_by('order', 'asc')->get('prize')->result_array();
		$this->load->view('backend/prize', $data);
	}

	public function random()
	{
		$rs = $this->db->where('staff_id', null)->order_by('order', 'asc')->limit($this->input->post('number'))->get('prize');

		if ($rs->num_rows()>0) {
			foreach($rs->result() as $r) {
				$sql = 'SELECT * FROM member WHERE register_date IS NOT NULL AND entrance_date IS NOT NULL AND prize_id IS NULL AND cancel = 2 ORDER BY RAND() LIMIT 1';
				$staff = $this->db->query($sql);
				if ($staff->num_rows()>0) {

					$this->db->set('prize_date', 'NOW()', false)->where('code', $staff->row()->code)->update('member', array(
						'prize_id' => $r->id
					));

					$this->db->where('id', $r->id)->update('prize', array(
						'staff_id' => $staff->row()->code,
						'staff_name' => 'คุณ'.$staff->row()->name.' '.$staff->row()->surname
					));

				}
			}
		}

		redirect('backend/prize');

	}
    

}
