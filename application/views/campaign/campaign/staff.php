<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li class=""><a href="<?php echo site_url('member/campaign');?>">ข้อมูล Campaign</a></li>
			  <li class="active">ข้อมูลพนักงานแคมเปญ <?php echo $f->campaign_name;?></li>
			</ol>
		</div>


		
		
		
		<div class='col-md-12'>
			<div class="panel panel-default">
			  <div class="panel-heading">ข้อมูลผู้เข้าร่วมงานแคมเปญ <?php echo $f->campaign_name;?></div>
			  <div class="panel-body">

			  	<?php echo form_open_multipart('member/do_staff', array('class' => 'form-inline'));?>

			  	<input type="hidden" name="campaign_id" value="<?php echo $f->campaign_id;?>">

			  	<div class="form-group">
			  		<div class='radio'>
			  			<label>
			  				<input type="radio" name="file_type" value="1" checked> อัพโหลดสมาชิก
			  			</label>
			  		</div>

			  		<div class='radio'>
			  			<label>
			  				<input type="radio" name="file_type" value="2"> อัพโหลดร้าน
			  			</label>
			  		</div>
			  	</div>

			  	<div class="form-group">
			  		<input type="file" class="form-control" name="file"> 
			  		<button type="submit" class="btn btn-info btn-sm"><i class="fa fa-cloud"></i> Upload</button>
			  		 <a href="<?php echo site_url('member/reset_member/'.$f->campaign_id);?>" onclick="javascript:return confirm('ต้องการ ยกเลิกการจับรางวัลหรือไม่ ?');" class="btn btn-default btn-sm">ล้างข้อมูล</a>


			  		  <a href="<?php echo site_url('member/export_member/'.$f->campaign_id);?>" onclick="" class="btn btn-success btn-sm">ส่งออก Excel</a>
			  		
			  	</div>

			  	<div class="clearfix"></div> <br><br>

			  	<?php echo form_close();?>

			  	<p><a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/add_member/'.$f->campaign_id);?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a></p>

			  	<?php echo form_open('', array('id' => 'frmsearch', 'class' => 'form-inline'));?>

			  		<div class="form-group">
			  			<label>ค้นหา (รหัสพนักงาน, ชื่อ)</label>
			  			<input type="text" name="txt" value="<?php echo $txt;?>" class="form-control" style="width: 200px;">
			  		</div>

			  		<div class="form-group">
			  			<label>แสดงผลต่อหน้า</label>	
			  			<select name="per_page" class="form-control">
			  				<option value="50" <?php echo $this->session->userdata('per_page') == '50' || !$this->session->userdata('per_page') ? 'selected' :'';?>>50</option>
			  				<option value="100"  <?php echo $this->session->userdata('per_page') == '100' ? 'selected' :'';?>>100</option>
			  				<option value="1000"  <?php echo $this->session->userdata('per_page') == '1000' ? 'selected' :'';?>>1000</option>
			  				<option value="3000"  <?php echo $this->session->userdata('per_page') == '3000' ? 'selected' :'';?>>3000</option>
			  			</select>
			  		</div>

			  		<div class="form-group">
			  			<label>แสดงสถานะ</label>	
			  			<select name="staff_type" class="form-control">
			  				<option value="">ดูทั้งหมด</option>
			  				<option value="staff"  <?php echo $this->session->userdata('staff_type') == 'staff' ? 'selected' :'';?>>พนักงาน</option>
			  				<option value="vip"  <?php echo $this->session->userdata('staff_type') == 'vip' ? 'selected' :'';?>>VIP</option>
			  			</select>
			  		</div>



			  		<button type="submit" class="btn btn-default btn-sm" name="search"> ค้นหา</button>
			  	<?php echo form_close();?>

			  	<div class="clearfix"></div><br><br>

			  	<p>ผู้เข้างาน : <?php echo $comein;?> คน <br> ยังไม่เข้างาน : <?php echo $notcome;?> คน</p>





			  	<?php echo $this->pagination->create_links();?>


			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				
			  				<th width="120">รหัสประจำตัว</th>
			  				<th>รหัสพนักงาน</th>
			  				<th width="200">ชื่อ - นามสกุล</th>
			  				<th>ที่นั่ง</th>
			  				<th>ข้อมูล</th>
			  				<th>สถานะ</th>
			  				<th>วันที่เข้างาน</th>
			  				<th>ของรางวัล</th>
			  				<th>&nbsp;</th>

			  			</tr>
			  		</thead>
			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="8" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						

			  						<td><?php echo $r->staff_id;?></td>
			  						
			  						<td><?php echo $r->staff_code;?></td>
			  						<td><?php echo $r->name;?></td>
			  						<td><?php echo $r->seat;?></td>
			  						<td>ตำแหน่ง : <?php echo $r->position;?>
			  							<br> หน่วยงาน : <?php echo $r->dep_name;?>
			  							<br>เบอร์โทรศัพท์ : <?php echo $r->mobile;?> 
			  							<br>เลขที่นั่ง : <?php echo $r->seat;?>

			  							<?php if ($r->company != null):?>
			  								<br>บริษัท : <?php echo $r->company;?>
			  						<?php endif;?>
			  							
			  						</td>
			  						<td><?php echo $r->staff_type == '' ? '-' : $r->staff_type;?></td>
			  						<td style="text-align: center;"><?php echo $r->checkin == null ? '<a href="'.site_url('member/checkin/'.$r->campaign_id.'/'.$r->id).'" class="btn btn-sm btn-default">เข้างาน</a>' : '<label class="label label-success">'.$r->checkin.'</label>';?></td>

			  						<td>
			  							<?php if ($r->no_prize == '2'):?>
			  								&nbsp;
			  							<?php else:?>
			  								<?php echo $r->prize;?>
			  							<?php endif;?>
			  								</td>
			  						<td width="200">
			  							<div class='btn-group'>
			  								<a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/edit_member/'.$r->campaign_id.'/'.$r->id);?>" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
			  								<a href="<?php echo site_url('member/delete_staff/'.$r->campaign_id.'/'.$r->id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');"  class="btn btn-sm btn-default"><i class="fa fa-trash"></i></a>

<a href="<?php echo site_url('event/'.$r->campaign_id.'/code/'.$r->staff_id);?>?type=print"class="btn btn-sm btn-default"><i class="fa fa-barcode"></i></a>

			  							</div>
			  						</td>
			  						
			  						
			  					</tr>
			  				<?php endforeach;?>
			  			<?php endif;?>
			  		</tbody>
			  		
			  	</table>

			  	<?php echo $this->pagination->create_links();?>

			  </div>
			</div>
		</div>


		

	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
	        
	    </div>
    </div>
</div>

	
