<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Kerry</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-en/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-en/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-en/css/site.css">
  </head>
  <body>
    <div class="container">
      <div class="lang">
        <a href="<?php echo site_url('vip/setlang/th');?>"><img src="<?php echo base_url();?>assets/kerry/kerry-en/img/lang.png" alt="Thai"></a>
      </div>
      <div class="header">
        <img class="logo" src="<?php echo base_url();?>assets/kerry/kerry-en/img/logo.png" alt="">
      </div>

      <div class="sub">
        2018 Annual Party<br>
        Registration
      </div>

      <?php echo form_open('vip/do_submit');?>
        <input type="text" name="company" class="input required" placeholder="Company Name">
        <input type="text" name="name" class="input required" placeholder="First Name">
        <input type="text" name="surname" class="input required" placeholder="Last Name">
        <input type="text" name="mobile" maxlength="20" minlength="9" class="input required" placeholder="Mobile number">

        <p class="sm">*Please check your information before submit</p>

        <button type="submit" class="btn">Submit</button>

      <?php echo form_close();?>
    </div>

    <script type="text/javascript" src="<?php echo base_url();?>asets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asets/js/jquery.validate.min.js"></script>

    <script type="text/javascript">
      $('form').validate();
    </script>
  
	

  </body>
</html>
