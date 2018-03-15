<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Kerry Express</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-th/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-th/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-th/css/site.css">

    <style type="text/css">
      label.error { display: none !important; }
      img.logo {
        width: 70%;
      }

      .container {
        padding-bottom: 20px;
      }
    </style>
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
        <input type="text" name="company" class="company input required" placeholder="ชื่อบริษัท (ภาษาอังกฤษ)">
        <input type="text" name="name" class="input required" placeholder="ชื่อ">
        <input type="text" name="surname" class="input required" placeholder="นามสกุล">
        <input type="text" name="mobile" maxlength="20" minlength="9" class="input required" placeholder="เบอร์มือถือ">

        <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">

        <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>

        <button type="submit" class="btn">ถัดไป</button>

      <?php echo form_close();?>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

    <script type="text/javascript">
      $('form').validate();
      $('input.company').keyup(function (){
        if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
          this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
        }
      });
    </script>
	

  </body>
</html>
