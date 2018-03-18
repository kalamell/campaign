<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Kerry</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry/css/site.css">

    <style type="text/css">
      label.error { display: none !important; }
      .header img {
        width: 90%;
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

      <div class="sub">
        2018 Annual Party<br>
        ลงทะเบียนเข้าร่วมงาน
      </div>

      <?php echo form_open('staff/do_submit', array('class' => 'form'));?>
        <input type="text" class="input required" maxlength="6" minlength="5" name="staff_id" placeholder="Staff ID">
        <input type="text" class="input required" maxlength="10" minlength="10" name="mobile" placeholder="Mobile number">

        <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>

        <button type="submit" class="btn">ถัดไป</button>

      <?php echo form_close();?>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

    <script type="text/javascript">
      $('form').validate();
      
    </script>
  

	 

  </body>
</html>
