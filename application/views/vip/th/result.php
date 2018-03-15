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
        <a href="<?php echo site_url('vip/setlang/en');?>"><img src="<?php echo base_url();?>assets/kerry/kerry-th/img/lang.png" alt="Thai"></a>
      </div>
      <div class="header">
        <img class="logo" src="<?php echo base_url();?>assets/kerry/kerry-th/img/logo.png" alt="">
      </div>

      <div class="sub">
        2018 Annual Party<br>
        ลงทะเบียนเข้าร่วมงาน
      </div>

      <div class="qr">
        <img src="<?php echo base_url();?>assets/kerry/kerry-th/img/qr_code.png" alt="QR CODE" id="qrcode" class="qr-code">
        <div class="description">
          <p class="sm">QR Code ของคุณ</p>
          <p class="name"><span><?php echo $r->name;?></span></p>
        </div>
      </div>
      

      <div class="footer">
        โปรดบันทึกหน้าจอนี้ไว้<br>
        เพื่อแสดงกับเจ้าหน้า ณ จุดลงทะเบียน
      </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript">
      var id = '<?php echo $r->staff_id;?>#<?php echo $r->campaign_id;?>';
      $("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + encodeURIComponent(id) + "&chs=160x160&chld=L|0");
    </script>
  
	

  </body>
</html>
