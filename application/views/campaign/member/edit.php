
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>
    <h4 class="modal-title" id="myModalLabel">ข้อมูลสมาชิก</h4>
</div>
<?php echo form_open('');?>
<div class="modal-body">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;?>">
    <input type="hidden" name="id" value="<?php echo $r->id;?>" id="id">

  <div class="form-group col-md-12">
    <label for="staff_id">รหัสจับรางวัล</label>
    <input type="text" class="form-control required" value="<?php echo $r->staff_id;?>"  id="staff_id" name="staff_id" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
  </div>

  <div class="form-group col-md-12">
    <label for="staff_code">รหัสพนักงาน</label>
    <input type="text" class="form-control required" value="<?php echo $r->staff_code;?>"  id="staff_code" name="staff_code" maxlength="50" minlength="1" placeholder="ชื่อผู้ใช้งาน">
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
    <label>มีสิทธิ์รับรางวัล</label>
    <div class="no_prize">
      <label>
        <input type="checkbox" name="no_prize" value="1" id="no_prize" <?php echo $r->no_prize == '1' ? 'checked' :'';?>> มีสิทธิ์รับรางวัล 
      </label>
    </div>
  </div>



</div>
<div class="modal-footer">
    
    <button type="button" class="btn btn-success" id="save_member_edit"><i class="fa fa-floppy-o"></i> บันทึก</button>
</div>
	
<?php echo form_close();?>
