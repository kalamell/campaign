<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li><a href="<?php echo site_url('backend');?>">Backend</a></li>
			  <li class="active">ข้อมูล Campaign</li>
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
			  <div class="panel-heading">ข้อมูล Campaign</div>
			  <div class="panel-body">


			  	<p><a href="<?php echo site_url('backend/campaign/add');?>" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a></p>


			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				<th width="120">&nbsp;</th>
			  				<th>ID</th>
			  				<th>ชื่อแคมเปญ</th>
			  				<th>จำนวนผู้ใช้งาน</th>
			  				<th width="120" >Lucky Draw</th>
			  				<th>เจ้าของ</th>
			  				<th>วันเริ่ม - จบ แคมเปญ</th>
				  				<th>ลงทะเบียน</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="6" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						<td style="text-align: center;">
			  							<div class="btn-group">
			  								<a href="<?php echo site_url('backend/campaign/edit/'.$r->campaign_id);?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
			  								<a href="<?php echo site_url('backend/campaign/delete/'.$r->campaign_id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>

			  								<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    <span class="caret"></span>
										    <span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu">
										    <?php if ($r->lucky_draw == '1'):?>
										    	<li><a href="<?php echo site_url('backend/campaign/imp_prize/'.$r->campaign_id);?>">ของรางวัล</a></li>
										    <?php endif;?>
										    <li><a href="<?php echo site_url('backend/campaign/imp_member/'.$r->campaign_id);?>">รายชื่อ</a></li>
										  </ul>
			  								
			  							</div>
			  						</td>
			  						<td><?php echo $r->campaign_id;?></td>

			  						<td><?php echo $r->campaign_name;?></td>
			  						<td style=""><?php echo $r->total_user;?> คน</td>
			  						<td style="text-align: center;">
			  							<span class="label label-<?php echo $r->lucky_draw == '0'? 'default' : 'success';?>"><?php echo $r->lucky_draw == '1' ? 'Y' : 'N';?></span>
			  						</td>
			  						<td><?php echo $r->name.'<br>'.$r->mobile;?></td>

			  						<td><?php echo $r->on_date.' ถึง '.$r->end_date;?></td>
			  						<td style="text-align: center;">
			  							<a target="_blank" href="<?php echo site_url('event/'.$r->campaign_id.'/register');?>" class="btn btn-sm btn-default">ลงทะเบียนเข้างาน</a>
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

	
