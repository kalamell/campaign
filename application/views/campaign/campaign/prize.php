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


			  	<p><a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/add_prize/'.$f->campaign_id);?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a></p>

			  	<?php echo form_open('');?>

			  	<button type="submit" name="update" class="btn btn-sm btn-info">ปรับปรุงข้อมูล</button>

			  	<table class="table table-bordered table-striped">
			  		<thead>
			  			<tr>
			  				<th width="120">&nbsp;</th>
			  				<th>ลำดับ</th>
			  				<th width="200">ชื่อของรางวัล</th>
			  				<th width="100">จำนวน</th>
			  				<th>พนักงานผู้ได้รับรางวัล</th>
			  				<th width="100">&nbsp;</th>
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
			  								<a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/edit_prize/'.$r->campaign_id.'/'.$r->prize_id);?>" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
			  								<a href="<?php echo site_url('member/delete_prize/'.$r->campaign_id.'/'.$r->prize_id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>

			  								
			  							</div>
			  						</td>

			  						<td>
			  							<input type="text" name="order[<?php echo $r->prize_id;?>]" value="<?php echo $r->order;?>">
			  						</td>




			  						<td><?php echo $r->name;?></td>
			  						<td style=""><?php echo $r->total;?></td>
			  						<td><?php if ($r->total > 1):?>
			  							<?php 
			  							$member = getMemberPrize($r->campaign_id, $r->prize_id);
			  							if(count($member)>0) {
			  								foreach($member as $m) {
			  									echo '<p>'.$m->staff_id.' - '.$m->name.'</p>';
			  								}
			  							}
			  							?>
			  							<?php else:?>
			  								<?php echo $r->staff_name;?>
			  							<?php endif;?>
			  						</td>
			  						<td>
			  							<?php if ($r->total > 1):?>
			  								<a class="btn btn-sm btn-info" target="_blank" href="<?php echo site_url('member/prize_group/'.$r->campaign_id.'/'.$r->prize_id);?>">จับแบบกลุ่ม</a>
			  							<?php else:?>
			  								&nbsp;
			  							<?php endif;?>
			  						</td>
			  						
			  					</tr>
			  				<?php endforeach;?>
			  			<?php endif;?>
			  		</tbody>
			  		
			  	</table>
			  	<?php echo form_close();?>

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

	