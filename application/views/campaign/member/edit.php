
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>
    <h4 class="modal-title" id="myModalLabel">ข้อมูลสมาชิก</h4>
</div>
<?php echo form_open('');?>
<div class="modal-body">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;?>">
    <input type="hidden" name="id" value="<?php echo $r->id;?>" id="id">

  <div class="row">
    <div class="form-group col-md-12">
      <label for="staff_id">รหัสจับรางวัล</label>
      <input type="text" class="form-control required" value="<?php echo $r->staff_id;?>"  id="staff_id" name="staff_id" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
    </div>

    <div class="form-group col-md-12">
      <label for="staff_code">รหัสพนักงาน / รหัสร้าน</label>
      <input type="text" class="form-control required" value="<?php echo $r->staff_code;?>"  id="staff_code" name="staff_code" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
    </div>

    <div class="form-group col-md-12">
      <label for="seat">เลขที่นั่ง</label>
      <input type="text" class="form-control required" value="<?php echo $r->seat;?>"  id="seat" name="seat" maxlength="50" minlength="1" placeholder="">
    </div>


    <div class="form-group col-md-12">
      <label for="name">ชื่อ</label>
      <input type="text" class="form-control required" value="<?php echo $r->name;?>" id="name" name="name" placeholder="">
    </div>

    <div class="form-group col-md-12">
      <label for="position">ตำแหน่ง</label>
      <input type="text" class="form-control required" value="<?php echo $r->position;?>" id="position" name="position" placeholder="">
    </div>


    <div class="form-group col-md-12">
      <label for="dep_name">หน่วยงาน</label>
      <input type="text" class="form-control required" value="<?php echo $r->dep_name;?>" id="dep_name" name="dep_name" placeholder="ชื่อผู้ใช้งาน">
    </div>

    

    <div class="form-group col-md-6">
      <label for="email">อีเมล์</label>
      <input type="text" class="form-control required" value="<?php echo $r->email;?>"  id="email" name="email" placeholder="อีเมล์">
    </div>

    <div class="form-group col-md-6">
      <label for="mobile">เบอร์โทรศัพท์</label>
      <input type="text" class="form-control required" value="<?php echo $r->mobile;?>" id="mobile" maxlength="20" minlength="1" name="mobile" placeholder="">
    </div>

    <div class="form-group col-md-6">
    	<label>เข้างาน</label>
    	<div class="checkin">
    		<label>
    			<input type="checkbox" name="checkin" value="1" id="checkin" <?php echo $r->checkin == null ? '' : 'checked';?>> เข้างาน 
    		</label>
    	</div>
    </div>

    <div class="form-group col-md-6">
      <label>สถานะ</label>
      <div class="radio">
        <label>
          <input type="radio" name="no_prize" value="1" <?php echo $r->no_prize == '1' ? 'checked' : '';?> id="no_prize"> รับรางวัลไม่ต้องผ่านลงทะเบียน 
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="no_prize" value="0" <?php echo $r->no_prize == '0' ? 'checked' : '';?> id="no_prize"> รับรางวัลและต้องลงทะเบียน 
        </label>
      </div>

      <div class="radio">
        <label>
          <input type="radio" name="no_prize" value="2" <?php echo $r->no_prize == '2' ? 'checked' : '';?> id="no_prize"> ลงทะเบียนอย่างเดียว 
        </label>
      </div>

    </div>

    

    <div class="form-group col-md-12">
      <label for="shop_name">ชื่อร้าน</label>
      <input type="text" class="form-control required" value="<?php echo $r->shop_name;?>" id="shop_name" name="shop_name" placeholder="">
    </div>

    <div class="form-group col-md-12">
      <label for="note">Note</label>
      <textarea class="form-control required" value="" id="note" name="note"><?php echo $r->note;?></textarea>
    </div>
  </div>



</div>
<div class="modal-footer">
    
    <button type="button" class="btn btn-success" id="save_member_edit"><i class="fa fa-floppy-o"></i> บันทึก</button>
</div>
	
<?php echo form_close();?>
