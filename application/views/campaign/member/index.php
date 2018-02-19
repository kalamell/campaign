<div class='container-fluid'>
	<div class="row">

		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="<?php echo site_url();?>">หน้าหลัก</a></li>
			  <li class="active">ข้อมูลสมาชิก</li>
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
			  <div class="panel-heading">ข้อมูลผู้ใช้งาน</div>
			  <div class="panel-body">

			  	<?php echo save();?>
			  	
			  	<?php echo form_open('member/update', array('id' => 'memberupdate'));?>

				  <div class="form-group col-md-12">
				    <label for="username">ชื่อผู้ใช้งาน</label>
				    <input type="text" class="form-control required" value="<?php echo $r->username;?>" readonly id="username" name="username" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
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
				    <input type="text" class="form-control required" value="<?php echo $r->name;?>" id="name" name="name" placeholder="ชื่อผู้ใช้งาน">
				  </div>

				  

				  <div class="form-group col-md-12">
				    <label for="email">อีเมล์</label>
				    <input type="text" class="form-control required" value="<?php echo $r->email;?>"  id="email" name="email" placeholder="อีเมล์">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="mobile">เบอร์โทรศัพท์</label>
				    <input type="text" class="form-control required" value="<?php echo $r->mobile;?>" id="mobile" maxlength="20" minlength="10" name="mobile" placeholder="">
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

	
