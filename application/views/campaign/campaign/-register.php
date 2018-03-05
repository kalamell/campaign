
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Campaign Solution</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fontawesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/datetimepicker/bootstrap-datetimepicker.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/fonts/styles.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/scripts/awesomplete.css">

	<style type="text/css">
		@media (max-width: 768px) { 
			.navbar-brand { width: 50%; }
		}
		.center {
			height: 100vh;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		}
		html, body { background-image: url('<?php echo base_url('assets/img/reward-group-background.jpg');?>'); 
			background-size: cover;
			background-color: #000; }
		h1, h2,p { font-family: 'SukhumvitSet-SemiBold'; color: #fff; text-align: center; }
		button { font-family: 'SukhumvitSet-SemiBold'; }
		p { font-size: 2em; text-align: left }
		h1 { font-size: 2em; }
		h1 font {
			margin-top: 10px; font-size: 1em;
		}
		h1.name {
			font-size: 3em;
			background-color: #232323;
			color: #fff;
		}
	</style>
</head>
<body>
	<div class='container-fluid'>
		<div class='row'>
			<div class='col-md-6'>

				<div class='' style="margin-top: 40px;">
					<h1>ค้นหาชื่อหรือรหัสพนักงาน</h1>

					<input class="staffcode form-control input-lg" id="province" placeholder="ค้นหารหัสพนักงาน หรือ ชื่อพนักงาน" type="text">
					<datalist id="staff">
						<?php foreach($staff as $s):?>
						<option value="<?=$s->staff_id;?>"><?=$s->staff_code.' '.$s->name;?></option>
						<?php endforeach; ?>
					</datalist>

				</div>
			</div>

			<div class='col-md-6'>

				
				<div class='' id="result" style="margin-top: 100px;">
				</div>

				<center>
				<button id="confirm" style="display: none; margin-top: 20px;" class="btn btn-lg btn-default">ลงทะเบียนเข้างาน</button>
			</center>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

	<script src="<?php echo base_url();?>assets/scripts/awesomplete.min.js"></script>
	<script type="text/javascript">

		$(function() {

			$("#province").focus();

			$("#confirm").on('click', function() {
				$.post('<?php echo site_url('member/confirm');?>', {
					'staff_id': $("#staff_id").val(),
					'campaign_id': '<?php echo $this->uri->segment(3);?>'
				}, function() {
					$("#result").html('<h1>บันทึกข้อมูลเรียบร้อย</h1>');

					$("#confirm").hide();
				})
			})


		});

		$(document).keypress(function(e) {
			if ($("#staff_id").size() == 1) {


			    if(e.which == 13) {
			       $.post('<?php echo site_url('member/confirm');?>', {
						'staff_id': $("#staff_id").val(),
						'campaign_id': '<?php echo $this->uri->segment(3);?>'
					}, function() {
						$("#result").html('<h1>บันทึกข้อมูลเรียบร้อย</h1>');

						$("#confirm").hide();
						$("#staff_id").focus();
					})
			    }
			}
		});



		var comboplete2 = new Awesomplete('input.staffcode', {
			minChars: 1,
			maxItems: 4,
			list: "#staff",
			replace: function(text) {
				//$('tr.nodata').remove();
				
				this.input.value = text;

				console.log(text);

				$.post('<?php echo site_url('member/checkregister');?>', {
					'staff_id': text.value,
					'campaign_id': '<?php echo $this->uri->segment(3);?>'
				}, function(res) {
					var html = '';
					if (res.result == true) {
						$("#confirm").show();
							html =  '<h1>ลำดับคูปอง ' + res.data.lotto_no + '</h1>';
							html += '<h1 class="name">' + res.data.name + '</h1>'; 
							html += '<h1 class="">' + res.data.staff_code + '</h1>'; 
							html += '<h1>' + res.data.position + '</h1>';
							html += '<input type="hidden" id="staff_id" value="' + res.data.staff_id + '" />';

							$("#result").html(html);
					} else {
						$("#confirm").hide();
						if (res.error_code == '404') {
							alert('ไม่พบข้อมูล');
						} else {
							
							html =  '<h1>ลำดับคูปอง ' + res.data.lotto_no + '</h1>';
							html += '<h1 class="name">' + res.data.name + '</h1>'; 
							html += '<h1 class="">' + res.data.staff_code + '</h1>'; 
							html += '<h1>' + res.data.position + '</h1>';

							

							html += '<br><br><p style="text-align: center; color: green;">' + res.data.checkin + '</p>';

							$("#result").html(html);
						}
					}

					$("#province").val('');
				}, 'json');

				/*
				do_search_province(text.value);
				$.post('<?=site_url('th/dealer/do_search_province_id');?>', {
					'name': text.value,
					'csrf_honda': '<?=$this->security->get_csrf_hash();?>'
				}, function(res) {
					$(".tbody").html(res);

					var _top = $('div.table').offset().top - 100;

					$('html,body').animate({
			        scrollTop: _top},
			        'slow', function() {
			        });
				});
				*/
			}
		});


		$(function() {
			
		})
	</script>
</body>
</html>