<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
    </head>
    <body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo site_url('main/data_static');?>">
					Backend
					</a>
				</div>
			
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">สมาชิก</a></li>
					<li><a href="<?php echo site_url('backend/prize');?>">ของรางวัล</a></li>
				</ul>
			</div>
		</nav>
    <div class="container">

		<!--	<p><a class='btn btn-default' href="<?php echo site_url('backend/reset');?>?type=register">Reset ลงทะเบียน</a> | <a class='btn btn-default' href="<?php echo site_url('backend/reset');?>?type=entrance">Reset รับสิทธิ์</a></p>-->

    	
		<ul class="nav nav-tabs">
		  <li role="presentation"<?php if($status == 0):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>">ทั้งหมด</a></li>
		  <li role="presentation"<?php if($status == 1):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>?status=1">ลงทะเบียนแล้ว</a></li>
			<li role="presentation"<?php if($status == 2):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>?status=2">ไม่ลงทะเบียน</a></li>
			
		<li role="presentation"<?php if($status == 4):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>?status=4">รับสิทธิ์แล้ว</a></li>
		  <li role="presentation"<?php if($status == 3):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>?status=3">ยังไม่รับสิทธิ์</a></li>
		
		<li role="presentation"<?php if($status == 5):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>?status=5">ลงทะเบียนรอบเย็น</a></li>
		
		<li role="presentation"<?php if($status == 6):?> class="active"<?php endif?>><a href="<?php echo site_url('backend');?>?status=6">ยังไม่ลงทะเบียนรอบเย็น</a></li>
		

		</ul>

		<table class="table table-striped">
		<thead><tr>
            <th width="10">#</th>
            <th>ชื่อ - นามสกุล</th>
            <th width="200">หน่วยงาน</th>
            <th>เบอร์ติดต่อ</th>
            <th>กลุ่ม</th>
            <th>สี</th>
			<?php if ($status=='5' || $status=='6'):?>
				<td width='200'>เวลารอบเย็น</td>
			<?php else:?>
            <th width="200">วันที่สมัคร</th>
			<?php endif;?>
            </tr></thead>
		<tbody>
		
		<?php $i=1; foreach($rs as $row):?>
			<tr>
				<td><?php echo $i++?></td>
				<td><?php echo $row['code'];?> <?php echo $row['name'].' '.$row['surname'];?></td>
                <td><?php echo $row['branch']?></td>
                <td><?php echo $row['mobile']?></td>
                <td><?php echo $row['color_name']?></td>
				<td><?php echo $row['group_name']?></td>
				<?php if ($status=='5' || $status=='6'):?>
				<td><?php echo $row['entrance_date2'] ? $row['entrance_date2'] : '-'?></td>
				<?php else:?>
				<td><?php echo $row['register_date'] ? date('Y-m-d m:i',strtotime($row['register_date'])) : '-'?></td>
				<?php endif;?>
			</tr>
		<?php endforeach;?>
		</tbody>
		</table>
    </div> <!-- /container -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="ModalContent">
      
    </div>
  </div>
</div>

	<script src="<?php echo base_url();?>assets/js/vendor/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/vendor/bootstrap.min.js"></script>
	<script>
	$('a.popup').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		$('#ModalContent').load(href, function() {
			$('#myModal').modal('show');
		})
	})
	
	$("a.btn").on('click', function(e) {
		e.preventDefault();
		
		var conf = confirm('ต้องการ reset หรือไม่');
		if (conf) {
			return true;
		} else {
			return false;
		}
	});
	</script>
    </body>
</html>
