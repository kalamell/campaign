<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title></title>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/register/font/font.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/register/css/normalize.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/register/css/site.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/register/css/overlay.css">
	</head>
	<body>

		<div class="container cf">
			<div class="search">
					
				<h2 style="color: #fff; font-size: 2em;"><?php echo $r->campaign_name;?></h2>

				<div class="search-header cf">

					<h2>ค้นหาข้อมูล</h2>
					<a class="register-button" href="#">ลงทะเบียนใหม่</a>
				</div>

				<form action="">
					<div class="triangle">
						<img src="<?php echo base_url();?>assets/register/img/triangle.png" alt="">
					</div>
					<input class="search--input" type="text">
					<datalist id="list" class="auto-complete list">
						
						<?php foreach($staff as $s):?>
						<option value="<?=$s->staff_id;?>"><?=$s->staff_code.' '.$s->name.' ร้าน '.$s->shop_name;?></option>
						<?php endforeach; ?>
					</datalist>
				</form>

				<div class="logo">
					<img src="<?php echo base_url();?>assets/register/img/logo_campaign.png" alt="">
				</div>
			</div>

			<div class="search-result">
				
				<div class="header">
					<!--
					<div class="meta-data">
						<h4>Checked-in</h4>
						<p>2018-02-22 07:49:03</p>
					</div>
					<div class="id-number">
						<h4>5814596</h4>
					</div>-->
				</div>

				<div class="info">
					<!--
					<h3>วราภรธ์ เมธาธนโชติ</h3>
					<a href="#" class="add-button">
						เพิ่มผู้ร่วมงาน
					</a>
					<table class="info-table">
						<tr>
							<th>ชื่อร้าน</th>
							<td>Ramsita</td>
						</tr>
						<tr>
							<th>Shop ID</th>
							<td>A0101</td>
						</tr>
						<tr>
							<th>ที่อยู่</th>
							<td>ห้อง 222/154 ซอย Ginza 4 ชั้น B โซน 2</td>
						</tr>
						<tr>
							<th>โทร</th>
							<td>0878276556</td>
						</tr>
					</table>
					<a class="confirm-button" href="#">ยืนยันเข้างาน</a>-->
				</div>
			</div>
		</div>

		<div class="overlay" style="display: none;">
			<div class="box">
				<div class="header">
					<h3>เพิ่มผู้ร่วมงาน</h3>
					<a href="#" class="close"></a>
				</div>
				<div class="body">
					<h4>&nbsp;</h4>
					<form class="register-form" action="">
						<input type="hidden" id="staff_id" name="staff_id" value="">
						<input type="hidden" name="campaign_id" value="<?php echo $this->uri->segment(2);?>">
						<div class="form-control cf">
							<div class="col-2">
								<label for="firstname">ชื่อ</label>
								<input type="text" name="name" class="sm" id="firstname">
							</div>
							<div class="col-2">
								<label for="lastname">นามสกุล</label>
								<input type="text" name="lastname" class="sm" id="lastname">
							</div>
						</div>
						<div class="form-control">
							<label for="phone">โทรศัพท์</label>
							<input id="phone" name="mobile" type="text">
						</div>
						<div class="form-control">
							<label for="email">อีเมล์</label>
							<input id="email" name="email" type="email">
						</div>

						<div class="form-control">
							<label for="note">Note</label>
							<input id="note" name="note" type="text">
						</div>

						<div class="form-control">
							<label for="">&nbsp;</label>
							<button class="submit" type="submit" style="cursor: pointer;">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url();?>assets/register/js/jquery-2.2.4.min.js"></script>
		<script src="<?php echo base_url();?>assets/register/js/site.js"></script>
		<script src="<?php echo base_url();?>assets/scripts/awesomplete.min.js"></script>

		<script type="text/javascript">
			var comboplete2 = new Awesomplete('input.search--input', {
				minChars: 1,
				maxItems: 4,
				list: "#list",
				replace: function(text) {
					//$('tr.nodata').remove();
					
					this.input.value = text;

					console.log(text);

					$.post('<?php echo site_url('event/checkregister');?>', {
						'staff_id': text.value,
						'campaign_id': '<?php echo $this->uri->segment(2);?>'
					}, function(res) {
						var html = '';
						$("#staff_id").val(res.data.staff_id);

						if (res.result == true) {
							
							$(".search-result .header").html('');
							html = '<div class="meta-data"><h4>Checked-in</h4><p>&nbsp;</p></div>';
							html += '<div class="id-number"><h4>' + res.data.staff_code +'</h4></div>';
							
							$(html).appendTo($('.search-result .header'));

							$(".search-result div.info").html('');

							html = '<h3>' + res.data.name + '<h3>';

							$('.body h4').html('อ้างอิง ' + res.data.name);
							
							html += '<a href="#" class="add-button">เพิ่มผู้ร่วมงาน</a>';

							html +='<table class="info-table">';
							html +='<tr>';
								html +='<th>ชื่อร้าน</th>';
								html +='<th width="300">' + res.data.shop_name + '</th>';
							html +='</tr>';

							html +='<tr>';
								html +='<th>Shop ID</th>';
								html +='<th>' + res.data.staff_code +'</th>';
							html +='</tr>';

							html +='<tr>';
								html +='<th>ที่อยู่</th>';
								html +='<th>' + res.data.address +'</th>';
							html +='</tr>';

							html +='<tr>';
								html +='<th>โทร</th>';
								html +='<th>' + res.data.mobile + '</th>';
							html +='</tr>';


							html +='<tr>';
								html +='<th>Note</th>';
								html +='<th>' + res.data.note + '</th>';
							html +='</tr>';

							html +='</table>';

							html +='<a class="confirm-button" href="#">ยืนยันเข้างาน</a>';

							

							$(html).appendTo($(".search-result div.info"));
						} else {
							$("#confirm").hide();
							if (res.error_code == '404') {
								alert('ไม่พบข้อมูล');
							} else {
								$(".search-result .header").html('');
								html = '<div class="meta-data"><h4>Checked-in</h4><p>' + res.data.checkin + '</p></div>';
								html += '<div class="id-number"><h4>' + res.data.staff_code +'</h4></div>';
								
								$(html).appendTo($('.search-result .header'));

								$(".search-result div.info").html('');

								html = '<h3>' + res.data.name + '<h3>';

								$('.body h4').html('อ้างอิง ' + res.data.name);

								//html += '<a href="#" class="add-button">เพิ่มผู้ร่วมงาน</a>';

								html +='<table class="info-table">';
								html +='<tr>';
									html +='<th>ชื่อร้าน</th>';
									html +='<th width="300">' + res.data.shop_name + '</th>';
								html +='</tr>';

								html +='<tr>';
									html +='<th>Shop ID</th>';
									html +='<th>' + res.data.staff_code +'</th>';
								html +='</tr>';

								html +='<tr>';
									html +='<th>ที่อยู่</th>';
									html +='<th>' + res.data.address +'</th>';
								html +='</tr>';

								html +='<tr>';
									html +='<th>โทร</th>';
									html +='<th>' + res.data.mobile + '</th>';
								html +='</tr>';

								html +='<tr>';
									html +='<th>Note</th>';
									html +='<th>' + res.data.note + '</th>';
								html +='</tr>';

								html +='</table>';

								

								$(html).appendTo($(".search-result div.info"));


								/*
								html =  '<h1>ลำดับคูปอง ' + res.data.lotto_no + '</h1>';
								html += '<h1 class="name">' + res.data.name + '</h1>'; 
								html += '<h1 class="">' + res.data.staff_code + '</h1>'; 
								html += '<h1>' + res.data.position + '</h1>';

								

								html += '<br><br><p style="text-align: center; color: green;">' + res.data.checkin + '</p>';

								$("#result").html(html);
								*/
							}
						}

						$("input.search--input").val('');
					}, 'json');

				}
			});

			$('a.close').on('click', function() {
				$('.overlay').hide();
			})

			$(document).on('click', '.add-button', function() {
				$(".overlay").show();
			})

			$(".register-button").on('click', function() {
				$("h4").html('');
				$("#staff_id").val('');
				$(".overlay").show();

			})

			$(document).on('click', '.confirm-button', function() {

				$.post('<?php echo site_url('event/confirm');?>', {
					'code': $("#staff_id").val(),
					'campaign_id': '<?php echo $this->uri->segment(2);?>'
				}, function(res) {
					$(".search-result .header").html('');
					html = '<div class="meta-data"><h4>Checked-in</h4><p>' + res.data.checkin + '</p></div>';
					html += '<div class="id-number"><h4>' + res.data.staff_code +'</h4></div>';
					
					$(html).appendTo($('.search-result .header'));

					$(".search-result div.info").html('');

					html = '<h3>' + res.data.name + '<h3>';

					$('.body h4').html('อ้างอิง ' + res.data.name);

					//html += '<a href="#" class="add-button">เพิ่มผู้ร่วมงาน</a>';

					html +='<table class="info-table">';
					html +='<tr>';
						html +='<th>ชื่อร้าน</th>';
						html +='<th width="300">' + res.data.shop_name + '</th>';
					html +='</tr>';

					html +='<tr>';
						html +='<th>Shop ID</th>';
						html +='<th>' + res.data.staff_code +'</th>';
					html +='</tr>';

					html +='<tr>';
						html +='<th>ที่อยู่</th>';
						html +='<th>' + res.data.address +'</th>';
					html +='</tr>';

					html +='<tr>';
						html +='<th>โทร</th>';
						html +='<th>' + res.data.mobile + '</th>';
					html +='</tr>';


					html +='<tr>';
						html +='<th>Note</th>';
						html +='<th>' + res.data.note + '</th>';
					html +='</tr>';

					html +='</table>';

					

					$(html).appendTo($(".search-result div.info"));
					
				}, 'json');
			});

			$("form.register-form").on('submit', function(e) {
				e.preventDefault();
				$.post('<?php echo site_url('event/savedata');?>', $('form.register-form').serialize(), function() {
					$('input[type=text], input[type=email]').val('');
					$('.overlay').hide();
				});
				
			})


			

		</script>
	
	</body>
</html>