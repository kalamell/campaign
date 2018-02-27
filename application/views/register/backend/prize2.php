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
					สถิติ
					</a>
				</div>
			
				<ul class="nav navbar-nav">
					<li class=""><a href="<?php echo site_url('main/member');?>">สมาชิก</a></li>
					<li class="active"><a href="<?php echo site_url('main/prize');?>">ของรางวัล</a></li>
				</ul>
			</div>
		</nav>
    <div class="container">

		
    	
		<ul class="nav nav-tabs">
		  <li role="presentation"<?php if($status == 0):?> class="active"<?php endif?>><a href="<?php echo site_url('main/prize');?>">ทั้งหมด</a></li>
         

        </ul>
        
        <?php if ($status!=3):?>

		<table class="table table-striped">
		<thead><tr>
            <th width="10">#</th>
            <th>ชื่อรางวัล</th>
            <th width="200">ผู้ได้รับรางวัล</th>
            
            </tr></thead>
		<tbody>
		
		<?php $i=1; foreach($rs as $row):?>
			<tr>
				<td><?php echo $i++?></td>
				<td><?php echo $row['name'];?></td>
                <td><?php echo $row['staff_id'].' '.$row['staff_name']?></td>
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
			top.location.href = 'staff.php?type=reset';
		}
	});
	</script>
    </body>
</html>
