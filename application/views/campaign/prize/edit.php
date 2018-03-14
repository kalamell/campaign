
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-window-close"></i></button>
    <h4 class="modal-title" id="myModalLabel">ข้อมูลของรางวัล</h4>
</div>
<?php echo form_open('', array('id' => 'frmupdateprize'));?>
<div class="modal-body">
    <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $campaign_id;?>">
    <input type="hidden" name="prize_id" value="<?php echo $r->id;?>">

    <div class='row'>

      <div class="form-group col-md-12">
        <label for="order">ลำดับ</label>
        <input type="text" class="form-control required" value="<?php echo $r->order;?>"  id="order" name="order" maxlength="50" minlength="1" placeholder="รหัสของรางวัล">
      </div>


      <div class="form-group col-md-12">
        <label for="label">Label</label>
        <input type="text" class="form-control required" value="<?php echo $r->label;?>"  id="label" name="label" maxlength="50" minlength="1" placeholder="">
      </div>


      <div class="form-group col-md-12">
        <label for="name">ชื่อ</label>
        <input type="text" class="form-control required" value="<?php echo $r->name;?>" id="name" name="name" placeholder="">
      </div>

      <div class="form-group col-md-12">
        <label for="checkin_active">ให้สิทธิ์ผู้เข้างานเท่านั้น</label>
        <div class='checkbox'>
          <label>
            <input type="checkbox"  value="1" <?php echo $r->checkin_active == '1' ? 'checked' : '';?> id="checkin_active" name="checkin_active" maxlength="50" minlength="1" placeholder="">  ให้สิทธิ์เฉพาะผู้เข้างาน
          </label>
      </div>

      <br><br><br>

      <div class="form-group col-md-6">
        <label>แผนกที่มีสิทธิ์<input type="checkbox" id="checkall"> เลือกทั้งหมด</label>
        <?php 
        $ex = explode(',', $r->gg);
        ?>
        <?php foreach($department as $dp):
        $chk = '';
        if(count($ex)>0) {
          foreach($ex as $k => $v) {
            if ($v == $dp->dep_id) {
              $chk = 'checked';
            }
          }
        }
        ?>
        <div class="checkin">
          <label>
            <input type="checkbox" name="dep[]" <?php echo $chk;?> value="<?php echo $dp->dep_id;?>"> <?php echo $dp->dep_name;?> 
          </label>
        </div>
        <?php endforeach;?>
      </div>

      <div class="form-group col-md-12">
        <label for="total">จำนวน</label>
        <input type="text" class="form-control required" value="<?php echo $r->total;?>" id="total" name="total" placeholder="จำนวนของรางวัล">
      </div>
    </div>

  

  

</div>
<div class="modal-footer">
    
    <button type="button" class="btn btn-success" id="save_update_prize"><i class="fa fa-floppy-o"></i> บันทึก</button>
</div>
	
<?php echo form_close();?>
