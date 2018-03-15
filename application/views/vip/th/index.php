<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Kerry</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-th/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-th/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-th/css/site.css">
  </head>
  <body>
    <div class="container">
      <div class="lang">
        <a href="<?php echo site_url('vip/setlang/en');?>"><img src="<?php echo base_url();?>assets/kerry/kerry-th/img/lang.png" alt="English"></a>
      </div>
      <div class="header">
        <img class="logo" src="<?php echo base_url();?>assets/kerry/kerry-th/img/logo.png" alt="">
      </div>

      <div class="sub">
        2018 Annual Party<br>
        ลงทะเบียนเข้าร่วมงาน
      </div>

      <?php echo form_open('vip/do_submit');?>
        <input type="text" name="company" class="input required" placeholder="ชื่อบริษัท">
        <input type="text" name="name" class="input required" placeholder="ชื่อ">
        <input type="text" name="surname" class="input required" placeholder="นามสกุล">
        <input type="text" name="mobile" class="input required" placeholder="เบอร์มือถือ">

        <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>

        <button type="submit" class="btn">ถัดไป</button>

      <?php echo form_close();?>
    </div>

    <script type="text/javascript" src="<?php echo base_url();?>asets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asets/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
      $('form').validate();
    </script>
	

  </body>
</html>
