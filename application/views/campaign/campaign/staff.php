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
			  		<input type="file" class="form-control" name="file"> <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-cloud"></i> Upload</button> <a href="<?php echo site_url('member/reset_member/'.$f->campaign_id);?>" onclick="javascript:return confirm('ต้องการ ยกเลิกการจับรางวัลหรือไม่ ?');" class="btn btn-default btn-sm">ล้างข้อมูล</a>
			  		
			  	</div>

			  	<div class="clearfix"></div> <br><br>

			  	<?php echo form_close();?>


			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				<th width="80">&nbsp;</th>
			  				<th width="120">รหัสประจำตัว</th>
			  				<th width="200">ชื่อ - นามสกุล</th>
			  				<th>ข้อมูล</th>
			  				<th>วันที่เข้างาน</th>
			  				<th>ของรางวัล</th>

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
			  								<a href="<?php echo site_url('member/delete_staff/'.$r->campaign_id.'/'.$r->id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>

			  								
			  							</div>
			  						</td>



			  						<td><?php echo $r->staff_id;?></td>
			  						<td><?php echo $r->name;?></td>
			  						<td>ตำแหน่ง : <?php echo $r->position;?><br> หน่วยงาน : <?php echo $r->dep_name;?><br>เบอร์โทรศัพท์ : <?php echo $r->mobile;?> <br> Email : <?php echo $r->email;?></td>
			  						<td><?php echo $r->checkin == null ? '-' : $r->checkin;?></td>
			  						<td><?php echo $r->prize_id == null ? '-' : $r->prize_name;?></td>
			  						
			  						
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

	
