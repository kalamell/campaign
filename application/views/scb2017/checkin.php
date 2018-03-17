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
    <div class="container" style="padding-bottom: 50px; background: url(<?php echo base_url();?>assets/scb2017/normal/img/bg.jpg) fixed !important;">
      
      <br><br><br>
        <h2 class="form-title">
          รวมยังไม่มา <?php echo $no_come;?><br>
          รวมมาแล้ว <?php echo $come;?><br>


          รับรางวัลยังไม่มา <?php echo $que_no_come;?><br>
          รับรางวัลมาแล้ว <?php echo $que_come;?><br>

          รอบ 11.00 ยังไม่มา <?php echo $no_come_11;?><br>
          รอบ 11.00 มาแล้ว <?php echo $come_11;?><br>

          รอบ 14.30 ยังไม่มา <?php echo $no_come_14;?><br>
          รอบ 14.30 มาแล้ว <?php echo $come_14;?>
        </h2>

        <h2>รายชื่อผู้ยังไม่มา</h2>

        <table style="margin: 0 auto;">
          <thead>
            <tr>
              <th>รหัสพนักงาน</th>
              <th>ชื่อ - นามสกุล</th>
              <th>เบอร์โทรศัพท์</th>
              <th>รับรางวัล</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($rs as $r):?>
              <tr>
                <td><?php echo $r->staff_id;?></td>
                <td><?php echo $r->name.' '.$r->surname;?></td>
                <td><?php echo $r->mobile;?></td>
                <td>
                  <?php if ($r->prize !=''):?>
                    <?php echo $r->prize;?>
                  <?php endif;?>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>

        <hr>

        <h2>รายชื่อผู้มาแล้วทั้งหมด</h2>


        <table style="margin: 0 auto;">
          <thead>
            <tr>
              <th>รหัสพนักงาน</th>
              <th>ชื่อ - นามสกุล</th>
              <th>เบอร์โทรศัพท์</th>
              <th>รับรางวัล</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($rs2 as $r):?>
              <tr>
                <td><?php echo $r->staff_id;?></td>
                <td><?php echo $r->name.' '.$r->surname;?></td>
                <td><?php echo $r->mobile;?></td>
                <td>
                  <?php if ($r->prize !=''):?>
                    <?php echo $r->prize;?>
                  <?php endif;?>
                </td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
        
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
