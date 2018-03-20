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

       @media print {
        .header, .lang {
          display: none;
        }

        p { color: #000; }
      }

      
    </style>



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

      <div class="qr">
        <img src="<?php echo base_url();?>assets/kerry/kerry-en/img/qr_code.png" alt="QR CODE" id="qrcode" class="qr-code">
        <div class="description">
          <p class="sm">Your QR Code</p>
          <p class="name"><span><?php echo $r->name;?></span></p>
          <!--<p class="seat-number"><span>เลขที่นั่ง</span> T12 S08</p>-->
        </div>
      </div>
      

      <div class="footer">
        Please capture this picture<br>
        and show it to our staff at reception.
      </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript">
      var id = '<?php echo $r->staff_id;?>#<?php echo $r->campaign_id;?>';
      $("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + encodeURIComponent(id) + "&chs=160x160&chld=L|0");
    </script>
	

  </body>
</html>
