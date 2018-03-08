
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>
    <h4 class="modal-title" id="myModalLabel">ข้อมูลสมาชิก</h4>
</div>
<?php echo form_open('');?>
<div class="modal-body">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;?>">

  <div class="row">
    <div class="form-group col-md-12">
      <label for="staff_id">รหัสจับรางวัล</label>
      <input type="text" class="form-control required" value=""  id="staff_id" name="staff_id" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
    </div>

    <div class="form-group col-md-12">
      <label for="staff_code">รหัสพนักงาน / รหัสร้าน</label>
      <input type="text" class="form-control required" value=""  id="staff_code" name="staff_code" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
    </div>


    <div class="form-group col-md-12">
      <label for="name">ชื่อ</label>
      <input type="text" class="form-control required" value="" id="name" name="name" placeholder="">
    </div>

    <div class="form-group col-md-12">
      <label for="position">ตำแหน่ง</label>
      <input type="text" class="form-control required" value="" id="position" name="position" placeholder="">
    </div>


    <div class="form-group col-md-12">
      <label for="dep_name">หน่วยงาน</label>
      <input type="text" class="form-control required" value="" id="dep_name" name="dep_name" placeholder="ชื่อผู้ใช้งาน">
    </div>

    

    <div class="form-group col-md-6">
      <label for="email">อีเมล์</label>
      <input type="text" class="form-control required" value=""  id="email" name="email" placeholder="อีเมล์">
    </div>

    <div class="form-group col-md-6">
      <label for="mobile">เบอร์โทรศัพท์</label>
      <input type="text" class="form-control required" value="" id="mobile" maxlength="20" minlength="1" name="mobile" placeholder="">
    </div>

    <div class="form-group col-md-6">
    	<label>เข้างานเลย</label>
    	<div class="checkin">
    		<label>
    			<input type="checkbox" name="checkin" value="1" id="checkin"> เข้างานเลย 
    		</label>
    	</div>
    </div>

    <div class="form-group col-md-6">
      <label>สถานะ</label>
      <div class="radio">
        <label>
          <input type="radio" name="no_prize" value="1" id="no_prize" checked="checked"> รับรางวัลไม่ต้องผ่านลงทะเบียน 
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="no_prize" value="0" id="no_prize"> รับรางวัลและต้องลงทะเบียน 
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="no_prize" value="2" id="no_prize"> ลงทะเบียนอย่างเดียว 
        </label>
      </div>

    </div>

    

    <div class="form-group col-md-12">
      <label for="shop_name">ชื่อร้าน</label>
      <input type="text" class="form-control required" value="" id="shop_name" name="shop_name" placeholder="">
    </div>

    <div class="form-group col-md-12">
      <label for="note">Note</label>
      <textarea class="form-control required" value="" id="note" name="note"></textarea>
    </div>




  </div>


</div>
<div class="modal-footer">
    
    <button type="button" class="btn btn-success" id="save_member"><i class="fa fa-floppy-o"></i> บันทึก</button>
</div>
	
<?php echo form_close();?>
