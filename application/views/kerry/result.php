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

      <div class="qr">
        <img src="" alt="QR CODE" id="qrcode" class="qr-code">
        <div class="description">
          <p class="sm">QR Code ของคุณ</p>
          <p class="name"><span><?php echo $r->name;?></span></p>
          <p class="seat-number"><span>เลขที่นั่ง</span> <?php echo $r->seat;?></p>
        </div>
      </div>
      

      <div class="footer">
        โปรดแคปภาพหน้าจอ<br>
        และแสดง QR Code ณ จุดลงทะเบียน
      </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript">
      var id = '<?php echo $r->staff_id;?>#<?php echo $r->campaign_id;?>';
      $("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + encodeURIComponent(id) + "&chs=160x160&chld=L|0");
    </script>
  
	

  </body>
</html>
