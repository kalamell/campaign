<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CAMPAIGN</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/register/font.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/register/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css"/>
</head>
<body>
	<div id="fullpage">
		<div id="section0" class='section container'>
			<div class='row'>
				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="<?php echo base_url();?>assets/register/img/logo.png" class='img-responsive' alt="">
				</div>

				<div class='col-xs-12 box' style="margin: 15px 0px 30px 0px;">
					<p class='name'>ลงทะเบียนเข้าร่วมงาน</p>
				</div>


				<div class='col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 box'>
					<input id="code" type="text" class='form-control' style="font-size: 30px !important;" autocomplete="off" maxlength="5" name="code" placeholder="รหัสประจำตัว 5 หลัก" />
				</div>

				<div class='col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 box' style="margin-bottom: 20px;">
					<input id="mobile" type="text" class='form-control' autocomplete="off" maxlength="10" name="mobile" placeholder="หมายเลขโทรศัพท์" />
				</div>

				<div class='col-xs-12 box' style="margin: 15px 0px 30px 0px;">
					<p class='name'>* กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>
				</div>

				<div class='col-xs-12' id="msg">
					<h2>กรุณารอสักครู่</h2>
				</div>

				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2'>
					<a href="" class="next" style='display: block; margin: 0 auto;'>
						<img src="<?php echo base_url();?>assets/register/img/confirm.png" class="img-responsive" alt=""/>
					</a>
				</div>
			</div>
		</div>

		

	</div>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112067985-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-112067985-1');
</script>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.js"></script>
	<script>
		function htmlEncode (value){
  return $('<div/>').text(value).html();
}

	$(function() {
		var url = '<?php echo site_url();?>';
		$("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + htmlEncode(url) + "&chs=160x160&chld=L|0");
		$("#fullpage").fullpage({
			autoScrolling: true
		});

		
	

		$("a.next").on('click', function(e) {
			e.preventDefault();
			if ($("#code").val() == '' ||  $("#code").val().length <5) {
				alert('รหัสไม่ครบ 5 หลัก');
				$("#code").focus();
				return false;
			}

			
			if ($("#mobile").val() == '' || $("#mobile").val().length < 9 || $("#mobile").val().length > 10) {
				alert('เบอร์โทรศัพท์ขั้นต่ำ 9 หลัก');
				$("#mobile").focus();
				return false;
			}
			

			$("#msg").show();
			$(".box").hide();

			$.post('<?php echo site_url('event/checkuser');?>', {
				code: $("#code").val(),
				mobile: $("#mobile").val(),
				campaign_id: '<?php echo $this->uri->segment(2);?>',
			}, function(res) {
				

				if (res.result == false) {
					alert(res.msg);
					$("#msg").hide();
					$(".box").show();
				} else {
					/*
					$(".name").html(res.data.name+ ' ' + res.data.surname);
					$("#code2").val($("#code").val());
					$(".name_color").html('กลุ่มสี' + res.data.group);

					var url = '<?php echo site_url('member/id');?>/' + res.data.id;
					$("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + htmlEncode(url) + "&chs=160x160&chld=L|0");
				

					if (res.exists) {
						$.fn.fullpage.moveTo(3);
					} else {
						$.fn.fullpage.moveSectionDown();
					}
					*/

					top.location.href='<?php echo site_url('event/'.$this->uri->segment(2).'/confirm_data');?>/' + res.data.staff_id;
				}
			}, 'json');

			
		})

		$("a.back").on('click', function(e) {
			e.preventDefault();
			$.fn.fullpage.moveTo(1);
		})

		$("a.confirm").on('click', function(e) {
			e.preventDefault();
			$.post('<?php echo site_url('main/confirm');?>', {
				code: $("#code2").val(),
			}, function(res) {
				$.fn.fullpage.moveSectionDown();
				
			}, 'json');


		})
		
	});
	</script>
</body>
</html>