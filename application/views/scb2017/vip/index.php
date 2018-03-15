<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>2017 THE CHAMPIONS DAY</title>

    <link rel="stylesheet" href="<?php echo base_url();?>assets/scb2017/vip/font/font.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/scb2017/vip/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/scb2017/vip/css/site.css?v=3">
  </head>
  <body>
    <div class="container vip">
      <div class="logo">
        <img src="<?php echo base_url();?>assets/scb2017/vip/img/logo.png" alt="Logo">
      </div>

      <?php echo form_open('', array('id' => 'frm'));?>
        <input type="text" class="input" name="staff_id" autocomplete="off" id="staff_id" placeholder="Staff ID">

        <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>

        <button type="submit" class="btn" style="margin-top: 200px">ถัดไป</button>
      <?php echo form_close();?>

      <div class="confirm" style="display: none;">

         <div class="info">
          <div class="id">08789</div>
          <div class="name">นายรางวัล ได้รับรางวัล</div>
          <div class="department">หน่วยงาน</div>
        </div>

        <p class="sm">*กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>
        <a href="javascript::void(0);" class="btn btn-confirm">ยืนยัน</a>
        <a href="javascript::void(0);" class="btn-back">ย้อนกลับ</a>

        
      </div>  

      <div class='box-complete' style="display: none;">
        <div class="complete">
            <div class="name">-</div>
            <div class="text">ลงทะเบียนเรียบร้อย</div>
        </div>

        <table class="summary">
          <tr>
            <th>คุณได้รับรางวัล</th>
            <td class="prize">-</td>
          </tr>
          <tr>
            <th>ขึ้นรับรางวัลลำดับที่</th>
            <td class="que">-</td>
          </tr>
          <tr>
              <th>หมายเลขที่นั่ง</th>
              <td class="seat">-</td>
            </tr>
        </table>

        <div class="footer">
          <span>เพื่อความรวดเร็ว กรุณาบันทึกหน้านี้ไว้</span>
        </div>

      </div>


    </div>

    <div class="overlay" style="display: none;">
      
      <div class="popup">
        <a href="javascript::void(0);" class="btn-close"></a>  
        <h3>ผู้ร่วมงานทั่วไป</h3>
        <p>
          กรุณาสแกน QR CODE<br>
          ที่บริเวณหน้างาน
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
              if (res.type == null) {
                $(".overlay").fadeIn();
              } else {
                $("div.id").html(res.data.staff_id);
                $("div.name").html(res.data.name);
                $("div.department").html(res.data.dep_name);
                $("form#frm").fadeOut('fast');
                $(".confirm").fadeIn();

                $('td.que').html(res.data.que);
                $('td.prize').html(res.data.prize);
                $('td.seat').html(res.data.seat);

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
