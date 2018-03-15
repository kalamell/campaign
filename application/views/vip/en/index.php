<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Kerry Express</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-en/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-en/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/kerry/kerry-en/css/site.css">

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
        <a href="<?php echo site_url('vip/setlang/th');?>"><img src="<?php echo base_url();?>assets/kerry/kerry-en/img/lang.png" alt="Thai"></a>
      </div>
      <div class="header">
        <img class="logo" src="<?php echo base_url();?>assets/kerry/kerry-en/img/logo.png"  alt="">
      </div>

      <div class="sub">
        2018 Annual Party<br>
        Registration
      </div>

      <?php echo form_open('vip/do_submit');?>
        <input type="text" name="company" class="input required company" placeholder="Company Name">
        <input type="text" name="name" class="input required" placeholder="First Name">
        <input type="text" name="surname" class="input required" placeholder="Last Name">
        <input type="text" name="mobile" maxlength="20" minlength="9" class="input required" placeholder="Mobile number">

        <input type="hidden" name="staff_id" value="<?php echo $staff_id;?>">

        <p class="sm">*Please check your information before submit</p>

        <button type="submit" class="btn">Submit</button>

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
