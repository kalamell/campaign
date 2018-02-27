<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
	<style type="text/css">
		body {
		 	background: url('<?php echo base_url();?>assets/img/bg2.jpg') no-repeat center center fixed;
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  background-size: cover;
		  -o-background-size: cover;
		}

		#main { 
		margin-top: 50px; }

		.box {
			outline: 2px solid #fff;
		}

		.box p {
			color: #fff;
			font-size :3em;
			text-align: center;
		}

		h2 { color: #fff; }

	</style>
	<title>สถิติ</title>
</head>

<body>

	<div class='container' id="main">


		<div class='row' style="margin-bottom: 40px;">
			<div class='col-md-12'>
				<h2>ลงทะเบียนหน้างาน Register QR Code ( Total <span id="total1">0</span> )</h2>				
			</div>
			<div class='col-md-6'>
				<div class='box'>
					<p>ลงทะเบียนแล้ว</p>
					<p id="regis">0</p>
				</div>
			</div>

			<div class='col-md-6'>
				<div class='box'>
					<p>ยังไม่ลงทะเบียน</p>
					<p id="not_regis">0</p>
				</div>
			</div>
			
		</div>

		<div class='row' style="margin-bottom: 40px;">
			<div class='col-md-12'>
				<h2>ลงทะเบียนรับสิทธิ์ Check-in Group ( Total <span id="total2">0</span>)</h2>	
			</div>
			<div class='col-md-6'>
				<div class='box'>
					<p>รับสิทธิ์รวมแล้ว</p>
					<p id="checkin">0</p>
				</div>
			</div>

			<div class='col-md-6'>
				<div class='box'>
					<p>ยังไม่รับสิทธิ์รวมแล้ว</p>
					<p id="not_checkin">0</p>
				</div>
			</div>
			
		</div>

		<?php 
foreach($rs as $r):?>

		<div class='row' style="margin-bottom: 40px">
			<div class='col-md-12'>
				<h2>การรับสิทธิ์ กลุ่มสี <?php echo $r->color_name;?> ( Total <span id="total<?php echo $r->code_id;?>">0</span> )</h2>				
			</div>
			<div class='col-md-6'>
				<div class='box'>
					<p>รับสิทธิ์แล้ว</p>
					<p id="checkin_<?php echo $r->code_id;?>">0</p>
				</div>
			</div>

			<div class='col-md-6'>
				<div class='box'>
					<p>ยังไม่รับสิทธิ์</p>
					<p id="not_checkin<?php echo $r->code_id;?>">0</p>
				</div>
			</div>
			
		</div>

<?php endforeach;?>


		

	</div>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		setInterval(function() {
			var total1 = 0;
			var total2 = 0;
			$.get('<?php echo site_url('main/static_data');?>', function(res) {

				$("#regis").html(res.regis);
				$("#not_regis").html(res.not_regis);

				total1 = parseInt(res.regis) + parseInt(res.not_regis);
				


				$("#checkin").html(res.checkin);
				$("#not_checkin").html(res.not_checkin);

				total2 = parseInt(res.checkin) + parseInt(res.not_checkin);
				

				$.each(res.c1, function(key, val) {
					//console.log(val);
					$("#checkin_" + val.code_id).html(val.c);
				})

				$.each(res.c2, function(key, val) {
					$("#not_checkin" + val.code_id).html(val.c);
				});

				$("#total1").html(total1);
				$("#total2").html(total2);

				$.each(res.c3, function(key, val) {
					//console.log(val);
					$("#total" + val.code_id).html(val.c);
				})


			}, 'json');
		}, 2000);
	</script>
</body>
</html>
