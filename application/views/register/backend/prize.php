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
					<li class=""><a href="<?php echo site_url('backend');?>">สมาชิก</a></li>
					<li class="active"><a href="<?php echo site_url('backend/prize');?>">ของรางวัล</a></li>
				</ul>
			</div>
		</nav>
    <div class="container">

		<!--<p><a class='btn btn-default' href="<?php echo site_url('backend/reset_prize');?>">Reset การจับรางวัล</a> </p>-->

    	
		<ul class="nav nav-tabs">
		  <li role="presentation"<?php if($status == 0):?> class="active"<?php endif?>><a href="<?php echo site_url('backend/prize');?>">ทั้งหมด</a></li>
          <li role="presentation"<?php if($status == 1):?> class="active"<?php endif?>><a href="<?php echo site_url('backend/prize');?>?status=1">จับรางวัลแล้ว</a></li>
          <li role="presentation"<?php if($status == 3):?> class="active"<?php endif?>><a href="<?php echo site_url('backend/prize');?>?status=3">จับรางวัลอัตโนมัติ</a></li>
          

        </ul>
        
        <?php if ($status!=3):?>

        <br>

		<table class="table table-striped table-bordered">
		<thead><tr>
            <th width="10" rowspan="2">#</th>
            <th width="400" rowspan="2">ชื่อรางวัล</th>
            <th width="200" colspan="4">ผู้ได้รับรางวัล</th>
            </tr>
            <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อ - นามสกุล</th>
                <th>หน่วยงาน</th>
                <th>สี</th>
                <th>เบอร์โทร</th>
            </tr></thead>
		<tbody>
		
		<?php $i=1; foreach($rs as $row):?>
			<tr>
				<td><?php echo $i++?></td>
				<td><?php echo $row['prize_name'];?></td>
                <td><?php echo $row['staff_id'];?></td>
                <td><?php echo $row['name'].' '.$row['surname'];?></td>
                <td><?php echo $row['branch'];?></td>
                <td><?php echo $row['color_name'];?></td>
                <td><?php echo $row['mobile'];?></td>
            </tr>
		<?php endforeach;?>
		</tbody>
        </table>
        <?php endif;?>


        <?php if ($status ==3):?>

        <?php echo form_open('backend/random');?>

        <div class="form-group">
            <label for="number">จำนวนรางวัล :</label>
            <input type="text" class="form-control" id="number" name="number" value="0" placeholder="">
        </div>
        
            <button type="submit" class="btn btn-default">จับรางวัล</button>

        <?php echo form_close();?>

        <?php endif;?>
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
			top.location.href = '<?php echo site_url('backend/reset_prize');?>';
		}
	});
	</script>
    </body>
</html>
