
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>
    <h4 class="modal-title" id="myModalLabel">ข้อมูลบู๊ท</h4>
</div>
<?php echo form_open('');?>
<div class="modal-body">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;?>">

  <div class="row">
    <div class="form-group col-md-12">
      <label for="boot_name">ชื่อบู๊ท</label>
      <input type="text" class="form-control required" value=""  id="boot_name" name="boot_name" placeholder="">
    </div>

    <div class="form-group col-md-12">
      <label for="access">จำนวนที่สมาชิกใช้สิทธิ์เข้าบู๊ท</label>
      <input type="text" class="form-control required" value="0"  id="access" name="access" maxlength="50" minlength="1" placeholder="">
      <p class="help-block" style="color: red;">* ใส่เลข 0 เพื่อเข้าไม่จำกัด</p>
    </div>

    

    <div class="form-group col-md-6">
    	<label>ชนิดบู๊ท</label>
    	<div class="radio">
    		<label>
    			<input type="radio" name="type_boot" value="register" id="type_boot"> สำหรับลงทะเบียน 
    		</label>
    	</div>

    	<div class="radio">
    		<label>
    			<input type="radio" name="type_boot" value="event" id="type_boot"> สำหรับกิจกรรม 
    		</label>
    	</div>

    </div>

    



  </div>


</div>
<div class="modal-footer">
    
    <button type="button" class="btn btn-success" id="save_boot"><i class="fa fa-floppy-o"></i> บันทึก</button>
</div>
	
<?php echo form_close();?>
