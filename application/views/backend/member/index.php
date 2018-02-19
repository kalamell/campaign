<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li><a href="<?php echo site_url('backend');?>">Backend</a></li>
			  <li class="active">ข้อมูล สมาชิก</li>
			</ol>
		</div>

		
		<div class="col-md-3">
			<div class="panel panel-default">
			  <div class="panel-heading">เมนู</div>
			  <div class="panel-body">
			  	<?php $this->load->view('backend/menu');?>
			  </div>
			</div>
		</div>
		<div class='col-md-9'>
			<div class="panel panel-default">
			  <div class="panel-heading">ข้อมูล สมาชิก</div>
			  <div class="panel-body">

			  	<p><a href="<?php echo site_url('backend/member/add');?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> เพิ่มสมาชิก</a></p>

			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				<th>ชื่อสมาชิก</th>
			  				<th>Username</th>
			  				<th>ช่วงรันแคมเปญ</th>
			  				<th>สถานะ</th>
			  				<th>Admin</th>
			  				<th width="120">&nbsp;</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="4" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						<td><?php echo $r->name;?></td>
			  						<td><?php echo $r->username;?></td>
			  						<td><?php echo $r->startdate.' - '.$r->enddate;?></td>
			  						<td>
			  							<span class="label label-<?php echo $r->active == '0'? 'default' : 'success';?>"><?php echo $r->active == '1' ? 'Y':'N';?></span>
			  						</td>
			  						<td>
			  							<span class="label label-<?php echo $r->isstaff == 'N'? 'default' : 'success';?>"><?php echo $r->isstaff == 'N' ? 'N':'Y';?></span>
			  						</td>

			  						<td style="text-align: center;">
			  							<div class="btn-group">
			  								<a href="<?php echo site_url('backend/member/edit/'.$r->id);?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
			  								<a href="<?php echo site_url('backend/member/delete/'.$r->id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>
			  								
			  							</div>
			  						</td>

			  						
			  					</tr>
			  				<?php endforeach;?>
			  			<?php endif;?>
			  		</tbody>
			  		
			  	</table>

			  </div>
			</div>
		</div>


		

	</div>
</div>

	
