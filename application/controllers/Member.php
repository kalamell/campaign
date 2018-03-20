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
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$order = $this->input->post('order');

			if (count($order) > 0) {
				foreach($order as $id => $val) {
					$this->db->where('id', $id)->update('prize', array(
						'order' => $val
					));

				}
			}

			//redirect('member/imp_prize/'.$campaign_id);
		}
		$this->rs = $this->cp->getPrize($campaign_id);
		$this->f = $this->cp->getData($campaign_id);
		$this->render('campaign/prize', $this);
	}

	public function export_prize($campaign_id)
	{
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename='prize-".$campaign_id.".xls'");
		header("Cache-Control: max-age=0");

		$this->rs = $this->cp->getPrize($campaign_id);
		$this->f = $this->cp->getData($campaign_id);
		$this->load->view('campaign/boots/export', $this);
	}

	public function clear_prize($campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id)->set('prize_id', null)->set('prize_date', null)->update('staff');
		$this->db->where('campaign_id', $campaign_id)->delete('prize');
		redirect('member/imp_prize/'.$campaign_id);

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

        	$dep = $this->db->where('campaign_id', $this->input->post('campaign_id'))->get('department')->result();

        	$gg = '';


			foreach($dep as $d) {
				$gg.=$d->dep_id;
				$gg.=',';
			}

			$gg = substr($gg, 0, -1);
			

        	

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
						'gg' => $gg
					));
			    }
			    $k++;
			}
			fclose($handle);

        } else {
        	echo $this->upload->display_errors();
        }

        redirect('member/imp_prize/'.$this->input->post('campaign_id'));
	}

	public function checkin($campaign_id, $staff_id)
	{
		$rs = $this->db->where('id', $staff_id)->get('staff');
		$no_prize = 0;
		if ($rs->num_rows() > 0) {

			if ($rs->row()->no_prize == 0 || $rs->row()->no_prize == 1) {
				$no_prize = 1;
			}

			$this->db->set('checkin', 'NOW()', false)->set('no_prize', $no_prize)->where('id', $staff_id)->update('staff');
		}
		redirect('member/imp_member/'.$campaign_id);

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

        	
			
			$handle = fopen("./upload/".$data['file_name'], "r");
			$k = 0;
			if ($this->input->post('file_type') == '1') {
				while (($data = fgets($handle)) !== FALSE) {
				    if ($k > 0) {
				    	//list($code, $name, $position, $dep_name, $mobile, $email, $checkin) = explode(",", $data);
				    	//list($no, $regis_time, $staff_type, $que, $prize_type, $prize, $staff_code, $name, $position,  $comp_code, $region, $area, $mobile, $group, $seat) = explode(",", $data);

				    	list($no, $staff_id, $name, $position, $comp_code, $seat, $status1, $status2, $status, $no_prize) = explode(',', $data);

				    	if (trim($no_prize) == 'no') {
				    		$no_prize = 2;
				    	} else {
				    		if (trim($status) == 'จับรางวัล') {
				    			$no_prize = 1;
				    		} else {
				    			$no_prize = 0;
				    		}
				    	}

				    	
				    	
				    	$dep_id = $this->md->dep($comp_code, $this->input->post('campaign_id'));

				    	$chk = $this->db->where('staff_id', $staff_id)->where('campaign_id', $this->input->post('campaign_id'))->get('staff');
				    	if ($chk->num_rows() ==0) {
				    		
							$this->db->insert('staff', array(
								'staff_id' => $staff_id,
								'staff_code' => $staff_id,
								'name' => $name,
								'position' => $position,
								'dep_id' => $dep_id,
								'mobile' => '-',
								'email' => '-',
								'no_prize' => $no_prize,
								'campaign_id' => $this->input->post('campaign_id'),
								'seat' => trim($seat),		
								'staff_type' => 'staff',			
							));

							//echo $this->db->last_query()."<BR>";

						
						} else {
							
							$this->db->where('staff_id', $chk->row()->staff_id)->where('campaign_id', $this->input->post('campaign_id'))->update('staff', array(
								'staff_id' => $staff_id,
								'staff_code' => $staff_id,
								'name' => $name,
								'position' => $position,
								'dep_id' => $dep_id,
								'mobile' => '-',
								'email' => '-',
								'no_prize' => $no_prize,
								'campaign_id' => $this->input->post('campaign_id'),
								'seat' => trim($seat),		
								'staff_type' => 'staff'								
							));

						//	echo $this->db->last_query()."<BR>";
						}

						//echo '<BR><BR>';
						
						

						
						
				    }
				    $k++;
				}
			} else {
				while (($data = fgets($handle)) !== FALSE) {
				    if ($k > 0) {
				    	//list($code, $name, $position, $dep_name, $mobile, $email, $checkin) = explode(",", $data);
				    	list($staff_code, $name, $shop_name, $tel, $address, $note) = explode("\t", $data);


				    	
				    	$code = 'U'.sprintf('%04d', $k);

				    	$chk = $this->db->where('staff_id', $code)->where('campaign_id', $this->input->post('campaign_id'))->get('staff');
				    	if ($chk->num_rows() ==0) {
				    		
							$this->db->insert('staff', array(
								'staff_id' => $code,
								'staff_code' => $staff_code,
								'name' => $name,
								'shop_name' => $shop_name,
								'mobile' => $tel,
								'no_prize' => 0,
								'campaign_id' => $this->input->post('campaign_id'),
								'lotto_no' => 0,
								'address' => $address,
								'note' => $note
							));

							//echo $this->db->last_query();
						} else {
							
							$this->db->where('staff_id', $chk->row()->staff_id)->where('campaign_id', $this->input->post('campaign_id'))->update('staff', array(
								'staff_code' => $staff_code,
								'name' => $name,
								'shop_name' => $shop_name,
								'mobile' => $tel,
								'no_prize' => 0,
								'campaign_id' => $this->input->post('campaign_id'),
								'lotto_no' => 0,
								'address' => $address,
								'note' => $note,
								'addi' => 1
							));
						}
						
				    }
				    $k++;
				}
			}
			fclose($handle);

        } 
        redirect('member/imp_member/'.$this->input->post('campaign_id'));
	}

	public function imp_member($campaign_id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			

			$this->session->set_userdata('txt', $this->input->post('txt'));

			$this->session->set_userdata('per_page', $this->input->post('per_page'));

			$this->session->set_userdata('staff_type', $this->input->post('staff_type'));
			redirect('member/imp_member/'.$campaign_id);
		}


		if ($this->session->userdata('txt')) {
			$this->db->like('staff.staff_id', $this->session->userdata('txt'))
				->or_like('staff.name', $this->session->userdata('txt'));
			if ($this->session->userdata('staff_type')) {
				$this->db->where('staff_type', $this->session->userdata('staff_type'));
			}
		}

		$this->total = $this->cp->getStaff($campaign_id);


		$this->load->library('pagination');

		$config['base_url'] = site_url('member/imp_member/'.$campaign_id).'/';
		$config['per_page'] = $this->session->userdata('per_page') ? $this->session->userdata('per_page') : 50;
		$config['total_rows'] = count($this->total);
		$config['uri_segment'] = 4; 
			

		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';	
		$config["first_link"] = "&laquo;";
		$config["first_tag_open"] = "<li>";
		$config["first_tag_close"] = "</li>";
		$config["last_link"] = "&raquo;";
		$config["last_tag_open"] = "<li>";
		$config["last_tag_close"] = "</li>";
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '<li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

	


		if ($this->session->userdata('txt')) {
			$this->db->like('staff.staff_id', $this->session->userdata('txt'))
				->or_like('staff.name', $this->session->userdata('txt'));
		}

		if ($this->session->userdata('staff_type')) {
				$this->db->where('staff_type', $this->session->userdata('staff_type'));
			}

		$this->rs = $this->cp->getStaff($campaign_id, $config['per_page'], $this->uri->segment(4));


		$this->comein = $this->db->where('campaign_id', $campaign_id)->where('checkin IS NOT NULL', null, false)->count_all_results('staff');
		$this->notcome = $this->db->where('campaign_id', $campaign_id)->where('checkin IS NULL', null, false)->count_all_results('staff');


		$this->f = $this->cp->getData($campaign_id);
		$this->txt = $this->session->userdata('txt');
		$this->render('campaign/staff', $this);
		
	}


	public function delete_prize($campaign_id, $prize_id)
	{

		$this->db->where('id', $prize_id)->delete('prize');
		$this->db->where('prize_id', $prize_id)->set('prize_id', null)->update('staff');
		redirect('member/imp_prize/'.$campaign_id);

	}

	public function delete_staff($campaign_id, $member_id)
	{

		$this->db->where('id', $member_id)->where('campaign_id', $campaign_id)->delete('staff');
		redirect('member/imp_member/'.$campaign_id);

	}

	public function reset_prize($campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id)->set('prize_id', null)->set('prize_date', null)->update('staff');
		$this->db->where('campaign_id', $campaign_id)->update('prize', array(
			'staff_id' => null,
			'staff_name' => null,
			'staff_dep' => null
		));
		redirect('member/imp_prize/'.$campaign_id);
	}

	

	public function reset_member($campaign_id)
	{
		$this->db->where('campaign_id', $campaign_id)->where('staff_type !=' ,'vip')->delete('staff');
		$this->db->where('campaign_id', $campaign_id)->delete('department');
		$this->db->where('campaign_id', $campaign_id)->update('prize', array(
			'staff_id' => null,
			'staff_name' => null,
			'staff_dep' => null,
			'gg' => null,
		));

		redirect('member/imp_member/'.$campaign_id);

	}


	public function add_member($campaign_id)
	{
		$this->campaign_id = $campaign_id;
		$this->load->view('campaign/member/add', $this);
	}


	public function edit_member($campaign_id, $id)
	{
		$this->campaign_id = $campaign_id;
		$this->r = $this->db->where(array(
			'staff.campaign_id' => $campaign_id,
			'staff.id' => $id
		))->join('department', 'staff.dep_id = department.dep_id', 'LEFT')->get('staff')->row();
		$this->load->view('campaign/member/edit', $this);
	}

	public function save_member()
	{
		$dep_id = $this->md->dep($this->input->post('dep_name'), $this->input->post('campaign_id'));
		$status = '';

		if ($this->input->post('no_prize') == '0') {
			$status = 'เข้าร่วมงานและจับรางวัล';

		} else if ($this->input->post('no_prize') == '1') {
			$status = 'จับรางวัล';
		} else {
			$status = 'เข้าร่วมงาน';
		}

    	$chk = $this->db->where('staff_id', $this->input->post('staff_id'))->get('staff');
    	if ($chk->num_rows() ==0) {
    		if ($this->input->post('checkin') == 1) {
    			$this->db->set('checkin', 'NOW()', false);
    		}
			$this->db->insert('staff', array(
				'staff_id' => $this->input->post('staff_id'),
				'staff_code' => $this->input->post('staff_code'),
				'name' => $this->input->post('name'),
				'position' => $this->input->post('position'),
				'dep_id' => $dep_id,
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'campaign_id' => $this->input->post('campaign_id'),
				'no_prize' => $this->input->post('no_prize'),
				'shop_name' => $this->input->post('shop_name'),
				'note' => $this->input->post('note'),
				'status' => $status,
				'seat' => $this->input->post('seat'),
				'staff_type' => $this->input->post('staff_type'),
				'company' => $this->input->post('company'),
			));
		} else {
			if ($this->input->post('checkin') == 1) {
    			$this->db->set('checkin', 'NOW()', false);
    		}
			$this->db->where('staff_id', $chk->row()->staff_id)->update('staff', array(
				'name' => $this->input->post('name'),
				'staff_code' => $this->input->post('staff_code'),
				'position' => $this->input->post('position'),
				'dep_id' => $dep_id,
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'campaign_id' => $this->input->post('campaign_id'),
				'no_prize' => $this->input->post('no_prize'),
				'shop_name' => $this->input->post('shop_name'),
				'note' => $this->input->post('note'),
				'status' => $status,
				'seat' => $this->input->post('seat'),
				'staff_type' => $this->input->post('staff_type'),
				'company' => $this->input->post('company'),
			));
		}

		
	}


	public function update_member()
	{
		$dep_id = $this->md->dep($this->input->post('dep_name'), $this->input->post('campaign_id'));

    	$no_prize = 0;
		
		$status = '';

		if ($this->input->post('no_prize') == '0') {
			$status = 'เข้าร่วมงานและจับรางวัล';
			$no_prize = 0;

		} else if ($this->input->post('no_prize') == '1') {
			$status = 'จับรางวัล';
			$no_prize = 1;
		} else {
			$status = 'เข้าร่วมงาน';
			$no_prize = 2;
		}

		if ($this->input->post('checkin') == 1) {
			$this->db->set('checkin', 'NOW()', false);
			$no_prize = 1;
		} else {
			$this->db->set('checkin', null);
		}


		$this->db->where('id', $this->input->post('id'))->update('staff', array(
			'staff_id' => $this->input->post('staff_id'),
			'staff_code' => $this->input->post('staff_code'),
			'name' => $this->input->post('name'),
			'position' => $this->input->post('position'),
			'dep_id' => $dep_id,
			'mobile' => $this->input->post('mobile'),
			'email' => $this->input->post('email'),
			'campaign_id' => $this->input->post('campaign_id'),
			'no_prize' => $no_prize,
			'shop_name' => $this->input->post('shop_name'),
			'note' => $this->input->post('note'),
			'status' => $status,
			'seat' => $this->input->post('seat'),
		));

		
	}


	public function imp_boot($campaign_id)
	{
		
		$this->rs = $this->cp->getBoot($campaign_id);
		$this->f = $this->cp->getData($campaign_id);
		$this->render('campaign/boots', $this);
	}

	public function add_boot($campaign_id)
	{
		$this->campaign_id = $campaign_id;
		$this->load->view('campaign/boots/add', $this);
	}

	public function edit_boot($campaign_id, $boot_id)
	{
		$this->campaign_id = $campaign_id;
		$this->r = $this->db->where(array(
			'campaign_id' => $campaign_id,
			'boot_id' => $boot_id
		))->get('boots')->row();
		$this->load->view('campaign/boots/edit', $this);
	}



	public function save_boot()
	{
		$this->db->insert('boots', array(
			'campaign_id' => $this->input->post('campaign_id'),
			'boot_name' => $this->input->post('boot_name'),
			'access' => $this->input->post('access'),
			'type_boot' => $this->input->post('type_boot'),
		));
	}

	public function update_boot()
	{
		$this->db->where(array(
				'campaign_id' => $this->input->post('campaign_id'),
				'boot_id' => $this->input->post('boot_id'),
			))->update('boots', array(
			
			'boot_name' => $this->input->post('boot_name'),
			'access' => $this->input->post('access'),
			'type_boot' => $this->input->post('type_boot'),
		));
	}

	public function delete_boot($campaign_id, $boot_id)
	{
		$this->db->where(array(
			'campaign_id' => $this->input->post('campaign_id'),
			'boot_id' => $this->input->post('boot_id'),
		))->delete('boots');

		$this->db->where('boot_id', $boot_id)->delete('boots_access');
		redirect('member/imp_boot/'.$campaign_id);
	}


	public function prize_group($campaign_id, $prize_id)
	{
		$this->campaign_id = $campaign_id;
		$this->prize_id = $prize_id;
		$this->r = $this->db->where('id', $prize_id)->get('prize')->row();
		$this->load->view('campaign/campaign/prize_group', $this);
	}

	public function prize_group_sms($campaign_id, $prize_id)
	{
		$r = $this->db->where('id', $prize_id)->get('prize')->row();
		$member = getMemberPrize($campaign_id, $prize_id);

		foreach($member as $m) {
			$ex = explode(' ', $m->name);
			$msg = 'คุณ'.$ex[0].'ได้รางวัล'.$r->label;
			$mobile = $m->mobile;
			//$mobile = '0954027399';

			$this->updatesms($m->staff_id);

			sendsms($mobile, $msg);
			//sendsms('0852120255', $msg);
			//sendsms('0814582996', $msg);
		}
		redirect('member/imp_prize/'.$campaign_id);
	}

	public function sms($campaign_id, $prize_id, $staff_id)
	{
		$rs = $this->db->select('staff.name as staff_name, label, staff.mobile')->where('prize.id', $prize_id)
			->where('staff.staff_id', $staff_id)
			->where('staff.prize_date !=', NULL)
			->join('staff', 'prize.id = staff.prize_id')
			->get('prize')->row();

			

		$ex = explode(' ', $rs->staff_name);

		
		

		$msg = 'คุณ'.$ex[0]. ' '.$staff_id.' ได้รับรางวัล'.$rs->label.' ติดต่อรับรางวัลที่บริษัทฯ';
		sendsms($rs->mobile, $msg);

		$this->updatesms($staff_id);

		redirect('member/imp_prize/'.$campaign_id);
	}

	private function updatesms($staff_id)
	{
		$this->db->set('sms_date', 'NOW()', false)->where('staff_id', $staff_id)->update('staff');
	}

	public function random2() {
		$member = getMemberPrize($this->input->post('campaign_id'), $this->input->post('prize_id'));

		$ar = array(
				'result' => true,
				'data' => $member
			);
		echo json_encode($ar);
	}

	public function random()
	{
		$prize = $this->db->where('id', $this->input->post('prize_id'))->where('staff_id IS NULL', null, false)->get('prize');


		$gg = '';

		if ($prize->num_rows() > 0) {

			$dep = $prize->row()->gg;

			if ($dep !='') {
				$ar = explode(',', $dep);
				$this->db->where_in('staff.dep_id', $ar);
			}
			$total = $prize->row()->total;

			if ($prize->row()->checkin_active == 1) {
				$thsi->db->where('checkin IS NOT NULL', null, false);
			}

			$member = $this->db->where('prize_id', null)
				//->where('checkin IS NOT NULL', null, false)
				->where('no_prize', 1)
				->join('department', 'staff.dep_id = department.dep_id', 'LEFT')
				->limit($total)
				->order_by('id', 'RANDOM')
				->get('staff');

			//echo $this->db->last_query();


			if ($member->num_rows() > 0) {
				foreach($member->result() as $m) {
					$this->db->set('prize_date', 'NOW()', false)->where('id', $m->id)->update('staff', array(
						'prize_id' => $prize->row()->id,
					));
				}
			}

			$this->db->where('id', $prize->row()->id)->update('prize', array(
				'staff_id' => $member->row()->staff_id,
				'staff_name' => $member->row()->name,
				'staff_dep' => $member->row()->dep_name
			));

			$ar = array(
				'result' => true,
				'data' => $member->result_array()
			);
		} else {
			$ar = array(
				'result' => false
			);
		}
		
		echo json_encode($ar);
	}
	

	public function add_prize($campaign_id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
		}

		

		$this->department = $this->db->where('campaign_id', $campaign_id)->get('department')->result();
		$this->campaign_id = $campaign_id;
		$this->load->view('campaign/prize/add', $this);
	}


	public function edit_prize($campaign_id, $prize_id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
		}

		

		$this->department = $this->db->where('campaign_id', $campaign_id)->get('department')->result();
		$this->campaign_id = $campaign_id;
		$this->r = $this->db->where('id', $prize_id)->get('prize')->row();
		$this->load->view('campaign/prize/edit', $this);
	}

	public function save_add_prize()
	{
		$gg = '';
		if ($this->input->post('dep')) {
			$inp = $this->input->post('dep');
			$j = 1;
			foreach($inp as $k => $v) {
				$gg.=$v;
				$gg.=',';
			}
		}

		$gg = substr($gg, 0, -1);

		$this->db->insert('prize', array(
			'campaign_id' => $this->input->post('campaign_id'),
			'label' => $this->input->post('label'),
			'name' => $this->input->post('name'),
			'total' => $this->input->post('total'),
			'gg' => $gg,
			'order' => $this->input->post('order'),
			'checkin_active' => $this->input->post('checkin_active') == NULL ? 0 : 1,
		));


	}

	public function update_add_prize()
	{
		$gg = '';
		if ($this->input->post('dep')) {
			$inp = $this->input->post('dep');
			$j = 1;
			foreach($inp as $k => $v) {
				$gg.=$v;
				$gg.=',';
			}
		}
		//echo substr('a,b,c,d,e,', 0, -1);

		$gg = substr($gg, 0, -1);

		
		$this->db->where('id', $this->input->post('prize_id'))->update('prize', array(
			'campaign_id' => $this->input->post('campaign_id'),
			'label' => $this->input->post('label'),
			'name' => $this->input->post('name'),
			'total' => $this->input->post('total'),
			'gg' => $gg,
			'order' => $this->input->post('order'),
			'checkin_active' => $this->input->post('checkin_active') == NULL ? 0 : 1,
		));

		echo $this->db->last_query();
	}


	public function register($campaign_id)
	{
		$this->staff = $this->db->where('campaign_id', $campaign_id)->get('staff')->result();
		$this->load->view('campaign/campaign/register', $this);
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

	public function confirm()
	{
		$this->db->set('checkin', 'NOW()', false)
		->where(array(
			'staff_id' => $this->input->post('staff_id'),
			'campaign_id' => $this->input->post('campaign_id')
		))->update('staff');
		echo json_encode(array('result' => true));
	}

	public function vote($campaign_id)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$vote_id = $this->input->post('vote_id');
			$this->db->update('vote', array(
				'active' => 0
			));

			foreach($vote_id as $id => $val) {
				$this->db->where('vote_id', $id)->update('vote', array(
					'active' => 1
				));
			}
		}
		$this->rs = $this->cp->getVote($campaign_id, 0);
		$this->f = $this->cp->getData($campaign_id);
		$this->render('campaign/vote', $this);
	}

	public function add_vote($campaign_id)
	{
		$this->campaign_id = $campaign_id;
		$this->load->view('campaign/vote/add', $this);

	}

	public function edit_vote($campaign_id, $vote_id)
	{
		$this->campaign_id = $campaign_id;
		$this->r = $this->db->where('vote_id', $vote_id)->get('vote')->row();
		$this->load->view('campaign/vote/edit', $this);

	}

	public function save_vote()
	{
		$this->db->insert('vote', array(
			'title' => $this->input->post('title'),
			'type' => $this->input->post('type'),
			'campaign_id' => $this->input->post('campaign_id'),
			'mobile' => $this->input->post('mobile'),
		));
		$vote_id = $this->db->insert_id();

		$config['upload_path']          = './upload/';
        $config['allowed_types']        = '*';
        $config['file_name']            = 'vote-'.$vote_id.'-'.$this->input->post("campaign_id");
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('thumbnail'))
        {
        	$data = $this->upload->data();
        	$this->db->where('vote_id', $vote_id)->update('vote', array(
        		'thumbnail' => $data['file_name'],
        	));
        	
        } 
        redirect('member/vote/'.$this->input->post('campaign_id'));
	}

	public function update_vote()
	{
		$this->db->where('vote_id', $this->input->post('vote_id'))->update('vote', array(
			'title' => $this->input->post('title'),
			'type' => $this->input->post('type'),
			'campaign_id' => $this->input->post('campaign_id'),
			'mobile' => $this->input->post('mobile'),
		));
		$vote_id = $this->input->post('vote_id');

		$config['upload_path']          = './upload/';
        $config['allowed_types']        = '*';
        $config['file_name']            = 'vote-'.$vote_id.'-'.$this->input->post("campaign_id");
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('thumbnail'))
        {
        	$data = $this->upload->data();
        	$this->db->where('vote_id', $vote_id)->update('vote', array(
        		'thumbnail' => $data['file_name'],
        	));
        	
        } 
        redirect('member/vote/'.$this->input->post('campaign_id'));
	}

	public function delete_vote($campaign_id, $vote_id)
	{
		$this->db->where('vote_id', $vote_id)->delete('vote');
		$this->db->where('vote_id', $vote_id)->delete('vote_member');
		redirect('member/vote/'.$campaign_id);

	}

	public function export_member($campaign_id)
	{
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename='member-".$campaign_id.".xls'");
		header("Cache-Control: max-age=0");

		$this->rs = $this->cp->getStaff($campaign_id);

		$this->boot = $this->cp->getBoot($campaign_id);

		$this->load->view('campaign/member/export', $this);
	}

	public function vote_active($campaign_id, $act)
	{
		$this->db->where('campaign_id', $campaign_id)->update('campaign', array(
			'vote_active' => $act
		));

		redirect('member/campaign');
	}
}
