<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li class=""><a href="<?php echo site_url('member/campaign');?>">ข้อมูล Campaign</a></li>
			  <li class="active">ข้อมูลของรางวัลแคมเปญ <?php echo $f->campaign_name;?></li>
			</ol>
		</div>

		
		
		
		<div class='col-md-12'>
			<div class="panel panel-default">
			  <div class="panel-heading">ข้อมูลของรางวัลแคมเปญ <?php echo $f->campaign_name;?></div>
			  <div class="panel-body">

			  	<?php echo form_open_multipart('member/do_prize', array('class' => 'form-inline'));?>

			  	<input type="hidden" name="campaign_id" value="<?php echo $f->campaign_id;?>">

			  	<div class="form-group">
			  		<input type="file" class="form-control" name="file"> <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-cloud"></i> Upload</button> 

			  		<a href="<?php echo site_url('member/reset_prize/'.$f->campaign_id);?>" onclick="javascript:return confirm('ต้องการ ยกเลิกการจับรางวัลหรือไม่ ?');" class="btn btn-default btn-sm">Reset การจับรางวัล</a>


			  		
			  		
			  	</div>

			  	<div class="clearfix"></div> <br><br>

			  	<?php echo form_close();?>


			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				<th width="120">&nbsp;</th>
			  				<th width="200">ชื่อของรางวัล</th>
			  				<th width="100">จำนวน</th>
			  				<th>พนักงานผู้ได้รับรางวัล</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="5" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						<td style="text-align: center;">
			  							<div class="btn-group">
			  								<a href="<?php echo site_url('member/delete_prize/'.$r->campaign_id.'/'.$r->prize_id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>

			  								
			  							</div>
			  						</td>




			  						<td><?php echo $r->name;?></td>
			  						<td style=""><?php echo $r->total;?></td>
			  						<td><?php echo $r->staff_name;?></td>
			  						
			  						
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

	
