<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CAMPAIGN</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/register_qr/font.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/register_qr/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css">
</head>
<body>
	<div id="fullpage">
		<div id="section1" class='section container'>
			<div class='row'>
				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="<?php echo base_url();?>assets/register_qr/img/logo.png" class='img-responsive' alt="">
				</div>


				<div class='col-xs-12' id="msg">
					<h2>กรุณารอสักครู่</h2>
				</div>



				<div class='col-xs-12 box' style="margin: 15px 0px 30px 0px;">
					<p class='name'>* กรุณาตรวจสอบความถูกต้องก่อนกดยืนยัน</p>
				</div>


				<div class='col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 box'>
					<input type="text" id="code2" class='form-control' autocomplete="off" maxlength="5" value="<?php echo $r->staff_id;?>" name="id" placeholder="รหัสประจำตัว 5 หลัก" />
				</div>

				<div class='col-xs-12 box' style="margin: 15px 0px 10px 0px;">
					<h3 class='name'>คุณ<?php echo $r->name;?></h3>
				</div>

				

				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px;">
					<a href="<?php echo site_url();?>" class="confirm">
						<img src="<?php echo base_url();?>assets/register_qr/img/confirm.png" class="img-responsive" alt=""/>
					</a>
				</div>


				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="text-align: center; margin-bottom: 20px;">
					<a class="btn btn-sm btn-default" style="background-color: #1f1f1f; color: #fff; border: 0px; border-radius: 0px; margin: 0 auto; " href="<?php echo site_url('event/'.$this->uri->segment(2).'/register');?>" class="back">ย้อนกลับ
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
			autoScrolling: false
		});

		
		
		$("a.confirm").on('click', function(e) {
			$("#msg").show();
			$(".box").hide();
			e.preventDefault();
			$.post('<?php echo site_url('event/'.$this->uri->segment(2).'/confirm');?>', {
				code: $("#code2").val(),
			}, function(res) {
				$.fn.fullpage.moveSectionDown();

                top.location.href='<?php echo site_url('event/'.$this->uri->segment(2).'/code');?>/' + res.staff_code;
				
			}, 'json');


		})
		
		
	});
	</script>
</body>
</html>