
<div class="modal-body">
  <input type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $r->campaign_id;?>">
  <input type="hidden" id="vote_id" value="<?php echo $r->vote_id;?>">
  <div class="row">
    <div class="col-md-12">
     <img src="<?php echo base_url();?>upload/<?php echo $r->thumbnail;?>" class="img-responsive">
     <p style="color: #000 !important;"><?php echo $r->title;?></p>
    </div>

  </div>


</div>
<div class="modal-footer">
    
    <button type="submit" class="btn btn-success btn-lg col-md-12 col-xs-12" id="btn_vote" <?php echo $disable=='true' ? 'disabled' : '';?>><i class="fa fa-floppy-o"></i> โหวต</button>
</div>
	

