<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
    }
    
    public function id($id)
    {
        $rs = $this->db->where('id', $id)->join('color', 'member.color = color.code_id')->get('member');
		
        if ($rs->num_rows()>0) {
            $data['r'] = $rs->row();
            $view = 'member/id';
            if ($rs->row()->entrance_date !='' || $rs->row()->entrance_date !=null) {
                $view = 'member/exists';
            }
            $this->load->view($view, $data);
        } else {
            redirect('');
        }
    }

    public function confirm()
    {
        $this->db->where('code', $this->input->post('code'))->set('entrance_date', 'NOW()', false)->update('member', array(
            'entrance' => 1
        ));
    }

	
}
