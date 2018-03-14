<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li class=""><a href="<?php echo site_url('member/campaign');?>">ข้อมูล Campaign</a></li>
			  <li class="active">ข้อมูลประกวดแต่งกาย <?php echo $f->campaign_name;?></li>
			</ol>
		</div>


		
		
		
		<div class='col-md-12'>
			<div class="panel panel-default">
			  <div class="panel-heading">ข้อมูลประกวดแต่งกาย <?php echo $f->campaign_name;?></div>
			  <div class="panel-body">

			  	
			  	<div class="clearfix"></div> <br><br>

			  	<p><a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/add_vote/'.$f->campaign_id);?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a></p>

			  	
			  	<div class="clearfix"></div><br><br>

			  	
			  	<?php echo form_open('');?>

			  	<button type="submit" class="btn btn-default">อัพเดตข้อมูล</button>


			  	<!-- Nav tabs -->
			  	<br><br>
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#alone" aria-controls="alone" role="tab" data-toggle="tab">เดี่ยว</a></li>
				    <li role="presentation"><a href="#group" aria-controls="group" role="tab" data-toggle="tab">กลุ่ม</a></li>
				  </ul>

				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="alone">

				    	<table class="table table-bordered table-striped">
					  		<thead>
					  			<tr>
					  				
					  				<th width="120">แสดงผล<br><input type="checkbox" id="checkall" name=""></th>
					  				<th width="200">ภาพ</th>
					  				<th>ชื่อชุดประกวด</th>
					  				<th width="200">ประเภท</th>
					  				
					  				<th>จำนวนโหวต</th>
					  				<th>&nbsp;</th>

					  			</tr>
					  		</thead>
					  		<tbody>
					  			<?php if (count($rs) == 0):?>
					  				<tr><td colspan="6" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
					  			<?php else:?>
					  				<?php $no = 1; foreach($rs as $r):?>

					  					<?php if($r->type=="เดี่ยว"):?>
					  					<tr>
					  						

					  						<td><input type="checkbox" <?php echo $r->active == '1' ? 'checked' : '';?> name="vote_id[<?php echo $r->vote_id;?>]" value="1"></td>
					  						<td><img src="<?php echo base_url();?>upload/<?php echo $r->thumbnail;?>" class="img-responsive"></td>

					  						<td><?php echo $r->title;?><br>เบอร์ติดต่อ : <?php echo $r->mobile;?></td>
					  						<td><?php echo $r->type;?></td>

					  						
					  						<td><?php echo $r->c;?> ครั้ง</td>
					  						
					  						<td width="85">
					  							<div class='btn-group'>
					  								<a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/edit_vote/'.$r->campaign_id.'/'.$r->vote_id);?>" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
					  								<a href="<?php echo site_url('member/delete_vote/'.$r->campaign_id.'/'.$r->vote_id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');"  class="btn btn-sm btn-default"><i class="fa fa-trash"></i></a>
					  							</div>
					  						</td>
					  						
					  						
					  					</tr>
					  				<?php endif;?>
					  				<?php $no++; endforeach;?>
					  			<?php endif;?>
					  		</tbody>
					  		
					  	</table>
				    	
				    </div>
				    <div role="tabpanel" class="tab-pane" id="group">

				    	<table class="table table-bordered table-striped">
					  		<thead>
					  			<tr>
					  				
					  				<th width="120">แสดงผล<br><input type="checkbox" id="checkall" name=""></th>
					  				<th width="200">ภาพ</th>
					  				<th>ชื่อชุดประกวด</th>
					  				<th width="200">ประเภท</th>
					  				
					  				<th>จำนวนโหวต</th>
					  				<th>&nbsp;</th>

					  			</tr>
					  		</thead>
					  		<tbody>
					  			<?php if (count($rs) == 0):?>
					  				<tr><td colspan="6" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
					  			<?php else:?>
					  				<?php $no = 1; foreach($rs as $r):?>
					  					<?php if ($r->type != 'เดี่ยว'):?>
					  					<tr>
					  						

					  						<td><input type="checkbox" <?php echo $r->active == '1' ? 'checked' : '';?> name="vote_id[<?php echo $r->vote_id;?>]" value="1"></td>
					  						<td><img src="<?php echo base_url();?>upload/<?php echo $r->thumbnail;?>" class="img-responsive"></td>

					  						<td><?php echo $r->title;?><br>เบอร์ติดต่อ : <?php echo $r->mobile;?></td>
					  						<td><?php echo $r->type;?></td>

					  						
					  						<td><?php echo $r->c;?> ครั้ง</td>
					  						
					  						<td width="85">
					  							<div class='btn-group'>
					  								<a data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('member/edit_vote/'.$r->campaign_id.'/'.$r->vote_id);?>" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></a>
					  								<a href="<?php echo site_url('member/delete_vote/'.$r->campaign_id.'/'.$r->vote_id);?>" onclick="javascript:return confirm('ต้องการลบหรือไม่ ?');"  class="btn btn-sm btn-default"><i class="fa fa-trash"></i></a>
					  							</div>
					  						</td>
					  						
					  						

					  					</tr>
					  				<?php endif;?>
					  				<?php $no++; endforeach;?>
					  			<?php endif;?>
					  		</tbody>
					  		
					  	</table>
				    	
				    </div>
				  </div>


			  	

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

	
