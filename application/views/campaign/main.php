<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li class="active">ข้อมูล Campaign</li>
			</ol>
		</div>

		
		<div class="col-md-3">
			<div class="panel panel-default">
			  <div class="panel-heading">เมนู</div>
			  <div class="panel-body">
			  	<?php $this->load->view('campaign/member/menu');?>
			  </div>
			</div>
		</div>
		<div class='col-md-9'>
			<div class="panel panel-default">
			  <div class="panel-heading">ข้อมูล Campaign</div>
			  <div class="panel-body">

			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				<th>ชื่อแคมเปญ</th>
			  				<th>จำนวนผู้ใช้งาน</th>
			  				<th>Lucky Draw</th>
			  				<th><i class="fa fa-edit"></i></th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="4" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						<td><?php echo $r->campaign_name;?><br><?php echo $r->on_date.' ถึง '.$r->end_date;?></td>
			  						<td style="text-align: center"><?php echo $r->total_user;?> คน</td>
			  						<td style="text-align: center;">
			  							<span class="label label-<?php echo $r->lucky_draw == '0'? 'default' : 'success';?>"><?php echo $r->lucky_draw == '0' ? 'ไม่มีจับรางวัล' : 'Y';?></span>
			  						</td>

			  						<td style="text-align: center;">
			  							<div class="btn-group">
			  								

			  								<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										    <span class="caret"></span>
										    <span class="sr-only">Toggle Dropdown</span>
										  </button>
										  <ul class="dropdown-menu">
										    <?php if ($r->lucky_draw == '1'):?>
										    	<li><a href="<?php echo site_url('campaign/imp_prize/'.$r->campaign_id);?>">นำเข้าของรางวัล</a></li>
										    <?php endif;?>
										    <li><a href="<?php echo site_url('campaign/imp_member/'.$r->campaign_id);?>">นำเข้ารายชื่อ</a></li>
										  </ul>
			  								
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

	
