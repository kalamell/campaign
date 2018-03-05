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
			  						<td><?php echo $r->type_boot == 'register' ? 'ลงทะเบียน' : 'บู๊ทกิจกรรม';?></td>
			  						
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

	
