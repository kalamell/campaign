<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Kerry Express Party</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry/css/site.css">

    <style type="text/css">
      label.error { display: none !important; }
      @media only screen and (max-width: 600px) {
        .header img {
          width: 90%;
        }
      }

      .container {
        padding-bottom: 20px;
      }
    </style>

  </head>
  <body>
    <div class="container">
      <div class="header">
        <img src="<?php echo base_url();?>assets/kerry/kerry/img/logo.png" alt="">
      </div>

      <div class="confirm">
        <?php echo form_open('staff/do_confirm', array('class' => 'form'));?>
          <input type="text" class="input" value="<?php echo $r->staff_id;?>" disabled>
          <input type="hidden" name="staff_id" value="<?php echo $r->staff_id;?>">
          <p class="name"><span><?php echo $r->name;?></span></p>
        

          <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>
          <button type="submit" class="btn">ยืนยัน</button>

        <?php echo form_close();?>


      </div>

      <a href="<?php echo site_url('staff');?>" class="btn-back">ย้อนกลับ</a>
    </div>
	

  </body>
</html>
