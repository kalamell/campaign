<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li><a href="<?php echo site_url('backend');?>">Backend</a></li>
			  <li class=""><a href="<?php echo site_url('backend/member');?>">ข้อมูล สมาชิก</a></li>
			  <li class="active">เพิ่มข้อมูล สมาชิก</li>
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
			  <div class="panel-heading">ข้อมูลผู้ใช้งาน</div>
			  <div class="panel-body">

			  	<?php echo save();?>
			  	
			  	<?php echo form_open('backend/member/save', array('id' => 'memberupdate'));?>

				  <div class="form-group col-md-12">
				    <label for="username">ชื่อผู้ใช้งาน</label>
				    <input type="text" class="form-control required" value=""  id="username" name="username" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="password">รหัสผ่าน</label>
				    <input type="password" class="form-control" minlength="4" maxlength="20" id="password" name="password" placeholder="รหัสผ่าน">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="confirm_password">ยืนยันรหัสผ่าน</label>
				    <input type="password" class="form-control " minlength="4" maxlength="20"  name="confirm_password" id="confirm_password" placeholder="รหัสผ่าน">
				  </div>

				 

				  <div class="form-group col-md-12">
				    <label for="name">ชื่อ</label>
				    <input type="text" class="form-control required" value="" id="name" name="name" placeholder="ชื่อผู้ใช้งาน">
				  </div>

				  

				  <div class="form-group col-md-6">
				    <label for="email">อีเมล์</label>
				    <input type="text" class="form-control required" value=""  id="email" name="email" placeholder="อีเมล์">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="mobile">เบอร์โทรศัพท์</label>
				    <input type="text" class="form-control required" value="" id="mobile" maxlength="20" minlength="1" name="mobile" placeholder="">
				  </div>

				  <div class="clearfix"></div>

				  <div class="form-group col-md-6">
				    <label for="confirm_password">วันที่เริ่ม</label>
				    <input type="text" class="form-control date" name="startdate" id="startdate" placeholder="">
				  </div>


				  <div class="form-group col-md-6">
				    <label for="confirm_password">วันที่สิ้นสุด</label>
				    <input type="text" class="form-control date" name="enddate" id="enddate" placeholder="">
				  </div>


				  <div class="form-group col-md-6">
				  	<label>ประเภทผู้ใช้งาน</label>
				  	<div class="radio">
				  		<label>
				  			<input type="radio" class="required" name="isstaff" value="Y"> Admin
				  		</label>
				  	</div>

				  	<div class="radio">
				  		<label>
				  			<input type="radio" name="isstaff" value="N"> ผู้ใช้งานทั่วไป
				  		</label>
				  	</div>
				  </div>


				  <div class="form-group col-md-6">
				  	<label>การใช้งาน</label>
				  	
				  	<div class="radio">
				  		<label>
				  			<input type="radio" name="active" value="1"> ใช้งาน
				  		</label>
				  	</div>

				  	<div class="radio">
				  		<label>
				  			<input type="radio" class="required"  name="active" value="0"> ไม่ใช้งาน
				  		</label>
				  	</div>



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

	
