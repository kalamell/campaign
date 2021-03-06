<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li><a href="<?php echo site_url('backend');?>">Backend</a></li>
			  <li class=""><a href="<?php echo site_url('backend/campaign');?>">ข้อมูล Campaign</a></li>
			  <li class="active">แก้ไข Campaign</li>
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
			  <div class="panel-heading">ข้อมูล แคมเปญ</div>
			  <div class="panel-body">

			  	<?php echo save();?>
			  	
			  	<?php echo form_open('backend/campaign/update', array('id' => 'memberupdate'));?>

			  	<input type="hidden" name="campaign_id" value="<?php echo $r->campaign_id;?>">

				  <div class="form-group col-md-12">
				    <label for="campaign_name">ชื่อแคมเปญ</label>
				    <input type="text" class="form-control required" value="<?php echo $r->campaign_name;?>"  id="campaign_name" name="campaign_name" maxlength="100" minlength="1" placeholder="ชื่อผู้ใช้งาน">
				  </div>

				  
				 

				  <div class="form-group col-md-12">
				    <label for="name">ชื่อลูกค้า</label>
				    <select name="member_id" class="form-control required">
				    	<option value=""> - - - เลือก - - - </option>
				    	<?php foreach($member as $m):?>
				    		<option value="<?php echo $m->id;?>" <?php echo $r->member_id == $m->id ? 'selected' : '';?>><?php echo $m->name;?></option>
				    	<?php endforeach;?>
				    </select>
				  </div>

				  


				  <div class="clearfix"></div>

				  <div class="form-group col-md-6">
				    <label for="">วันที่เริ่ม</label>
				    <input type="text" class="form-control date" name="on_date" id="on_date"  value="<?php echo $r->on_date;?>" placeholder="">
				  </div>


				  <div class="form-group col-md-6">
				    <label for="confirm_password">วันที่สิ้นสุด</label>
				    <input type="text" class="form-control date" name="end_date" id="end_date" value="<?php echo $r->end_date;?>" placeholder="">
				  </div>


				  <div class="form-group col-md-6">
				  	<label>จำนวนสมาชิก</label>
				  	<input type="text" name="total_user" value="<?php echo $r->total_user;?>" class="required form-control">
				  	
				  </div>


				  <div class="form-group col-md-6">
				  	<label>Lucky Draw</label>
				  	
				  	<div class="radio">
				  		<label>
				  			<input type="radio" name="lucky_draw" class="required"  value="1" <?php echo $r->lucky_draw == '1' ? 'checked' : '';?>> ใช้งาน
				  		</label>
				  	</div>

				  	<div class="radio">
				  		<label>
				  			<input type="radio" class="required"  name="lucky_draw" value="0" <?php echo $r->lucky_draw == '0' ? 'checked' : '';?>> ไม่ใช้งาน
				  		</label>
				  	</div>



				  </div>

				  <div class="form-group col-md-6">
				  	<label>รูปแบบหน้าลงทะเบียน</label>
				  	
				  	<div class="radio">
				  		<label>
				  			<input type="radio" class="required" name="register" <?php echo $r->register == '0' ? 'checked' : '';?> value="0"> ค้นหาชื่อ
				  		</label>
				  	</div>

				  	<div class="radio">
				  		<label>
				  			<input type="radio" class="required"  name="register" <?php echo $r->register == '1' ? 'checked' : '';?> value="1"> QR CODE
				  		</label>
				  	</div>


				  
				  
				  <div class='col-md-12'>
					  <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-user"></i> ปรับปรุงข้อมูล</button><br><br>
				  </div>

				<?php echo form_close();?>
			  </div>
			</div>
		</div>


		

	</div>
</div>

	
