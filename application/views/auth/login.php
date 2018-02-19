
	<div class='container'>

		
		<div class="row">

			<div class='col-md-12'>
				<div class="panel panel-default">
				  <div class="panel-heading">เข้าสู่ระบบ</div>
				  <div class="panel-body">

				  	<div class='row'>
				  		<div class='col-md-4'>
				  			<?php if ($this->session->flashdata('error')):?>
				  				<div class="alert alert-danger">
				  					กรุณาตรวจสอบ username และ password
				  				</div>
				  			<?php endif;?>

				  			<?php if ($this->session->flashdata('expire')):?>
				  				<div class="alert alert-danger">
				  					Account ของท่านหมดอายุแล้ว
				  				</div>
				  			<?php endif;?>


						    <?php echo form_open('auth/do_login', array('id' => 'login'));?>
							  <div class="form-group">
							    <label for="username">ชื่อผู้ใช้งาน</label>
							    <input type="text" class="form-control required" id="username" name="username" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
							  </div>
							  <div class="form-group">
							    <label for="password">รหัสผ่าน</label>
							    <input type="password" class="form-control required" id="password"  name="password" placeholder="รหัสผ่าน">
							  </div>
							  
							  <div class="checkbox">
							    <label>
							      <input type="checkbox"> จดจำฉันไว้
							    </label>
							  </div>
							  <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-user"></i> เข้าสู่ระบบ</button><br><br>
							  
							<?php echo form_close();?>
						</div>

						<div class='col-md-8'>
						    <p><strong>หมายเหตุ</strong></p>
						    <p>Campaign Solution</p>
						    <ul class="">
						    	
						    	<li>Username, Password สามารถรับได้ที่ผู้ติดต่อ</li>
						    	<li>หากไม่สามารถเข้าใช้งานได้ ให้ติดต่อที่ </li>
						    	<li>กรณีทีท่านไม่สามารถเข้าสู่ระบบได้ อาจจะเนื่องมาจาก username, password นั้น หมดอายุแล้ว กรุณาติดต่อได้จากข้อมูลข้างต้นครับ</li>
						    </ul>
						</div>



					</div>

				  </div>
				</div>

			</div>


		</div>
	</div>

	
