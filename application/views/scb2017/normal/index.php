<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>2017 THE CHAMPIONS DAY</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/scb2017/normal/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/scb2017/normal/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/scb2017/normal/css/site.css?v=<?php echo time();?>">
  </head>
  <body>
    <div class="container" style="padding-bottom: 20px">
      <div class="logo">
        <img src="<?php echo base_url();?>assets/scb2017/normal/img/logo.png" alt="Logo">
      </div>

      <?php echo form_open('', array('id' => 'frm'));?>
        <h2 class="form-title">
          ลงทะเบียนเข้าร่วมงาน
        </h2>
        <input type="text" class="input" autocomplete="off" maxlength="5" name="staff_id" id="staff_id" placeholder="Staff ID">

        <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>

        <button type="submit" class="btn" style="margin-top: 200px">ถัดไป</button>
      <?php echo form_close();?>



      <div class="confirm" style="display: none">

         <div class="info">
          <div class="id">x</div>
          <div class="name">xxx</div>
          <div class="department">xxx</div>
        </div>

        <p class="sm">*กรุณาตรวจสอบชื่อให้ถูกต้องก่อนกดยืนยัน</p>
        <a href="javascript::void(0);" class="btn btn-confirm">ยืนยัน</a>
        <a href="javascript::void(0);" class="btn-back">ย้อนกลับ</a>

        
      </div>  


      <div class='box-complete' style="display: none">
        <div class="complete" style="margin-top: 40px;">
            <div class="name">xxx</div>
            <div class="text">ลงทะเบียนเรียบร้อย</div>
        </div>

        <p class="sub-text">
          กรุณาติดต่อรับสติ๊กเกอร์<br>
          กับเจ้าหน้าที่ลงทะเบียน
        </p>
      </div>


    </div>

    <div class="overlay" style="display: none">
      
      <div class="popup">
        <a href="javascript::void(0);" class="btn-close"></a>  
        <h3>คุณคือผู้รับรางวัล</h3>
        <p>
          กรุณาติดต่อลงทะเบียนที่เคาเตอร์<br>
          ลงทะเบียนผู้รับรางวัล
        </p>
      </div>
    </div>
	 
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
      $(function() {
        $("#staff_id").focus();

        $('a.btn-close').on('click', function() {
          $('.overlay').fadeOut('fast');
          $("#staff_id").val('');
        });

        $('a.btn-back').on('click', function() {
          top.location.reload();
        });


        $('a.btn-confirm').on('click', function() {
          $.post('<?php echo site_url('event/checkin_scb');?>', {
            'staff_id': $("#staff_id").val(),
          }, function() {
            $('.confirm').fadeOut('fast');
            $('.box-complete').fadeIn();
          })
          
        });

        $("form").on('submit', function(e) {
          e.preventDefault();
          if ($("#staff_id").val() == '') {
            $("#staff_id").focus();
            return;
          }
          $.post('<?php echo site_url('event/check_scb');?>', {
            staff_id: $("#staff_id").val()
          }, function(res) {
            if (res.result) {
              if (res.type != '') {
                $(".overlay").fadeIn();
              } else {
                $("div.id").html(res.data.staff_id);
                $("div.name").html(res.data.name);
                $("div.department").html(res.data.dep_name);
                $("form#frm").fadeOut('fast');
                $(".confirm").fadeIn();

              }
            } else {
              alert('ขออภัยไม่พบข้อมูล');
            }
          }, 'json')

        })
      })
    </script>

  </body>
</html>
