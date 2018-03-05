<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li class=""><a href="<?php echo site_url('member/campaign');?>">ข้อมูล Campaign</a></li>
			  <li class="active">ข้อมูลบู๊ทแคมเปญ <?php echo $f->campaign_name;?></li>
			</ol>
		</div>


		
		
		
		<div class='col-md-12'>
			<div class="panel panel-default">
			  <div class="panel-heading">ข้อมูลบู๊ทแคมเปญ <?php echo $f->campaign_name;?></div>
			  <div class="panel-body">

			  	

			  	<p><a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/add_boot/'.$f->campaign_id);?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a></p>

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

			  		<button type="submit" class="btn btn-default btn-sm" name="search"> ค้นหา</button>
			  	<?php echo form_close();?>

			  	<div class="clearfix"></div><br><br>

			  	<p>ผู้เข้างาน : <?php echo $comein;?> คน <br> ยังไม่เข้างาน : <?php echo $notcome;?> คน</p>





			  	<?php echo $this->pagination->create_links();?>


			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				

			  				<th width="200">ชื่อบู๊ท</th>
			  				<th>จำนวนเข้าบู๊ท<br><span style='color: red;'>* 0 เข้าได้ไม่จำกัด</span></th>
			  				<th>ประเภท</th>
			  				<th>&nbsp;</th>

			  			</tr>
			  		</thead>
			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="6" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						

			  						<td><?php echo $r->boot_name;?></td>
			  						<td><?php echo $r->access;?></td>
			  						<td><?php echo $r->type_boot;?></td>
			  						
			  						<td width="85">
			  							<div class='btn-group'>
			  								<a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/edit_boot/'.$r->campaign_id.'/'.$r->boot_id);?>" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
			  								<a href="<?php echo site_url('member/delete_boot/'.$r->campaign_id.'/'.$r->boot_id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');"  class="btn btn-sm btn-default"><i class="fa fa-trash"></i></a>
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

	
