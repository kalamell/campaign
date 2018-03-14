
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>
    <h4 class="modal-title" id="myModalLabel">ข้อมูลผู้เข้าประกวด</h4>
</div>
<?php echo form_open_multipart('member/save_vote');?>
<div class="modal-body">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;?>">

  <div class="row">
    <div class="form-group col-md-12">
      <label for="title">ชื่อชุด</label>
      <input type="text" class="form-control required" value=""  id="title" name="title" placeholder="">
    </div>

    <div class="form-group col-md-12">
      <label for="mobile">เบอร์ติดต่อ</label>
      <input type="text" class="form-control required" value=""  id="mobile" name="mobile" placeholder="">
    </div>

   
    

    <div class="form-group col-md-6">
    	<label>ประเภท</label>
    	<div class="radio">
    		<label>
    			<input type="radio" name="type" value="เดี่ยว" id="type"> ประกวดเดี่ยว 
    		</label>
    	</div>

    	<div class="radio">
    		<label>
    			<input type="radio" name="type" value="กลุ่ม" id="type"> ประกวดกลุ่ม 
    		</label>
    	</div>

    </div>


    <div class="form-group col-md-12">
      <label for="thumbnail">ภาพ</label>
      <input type="file" class="form-control required" value=""  id="thumbnail" name="thumbnail" placeholder="">
    </div>


    



  </div>


</div>
<div class="modal-footer">
    
    <button type="submit" class="btn btn-success" id=""><i class="fa fa-floppy-o"></i> บันทึก</button>
</div>
	
<?php echo form_close();?>
