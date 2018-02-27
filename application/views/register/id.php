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
</head>
<body>
	<div id="fullpage">
		<div id="section1" class='section container'>
			<div class='row'>
				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="<?php echo base_url();?>assets/register/img/logo.png" class='img-responsive' alt="">
				</div>


				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="" id="qrcode" class='img-responsive' alt="" style="margin: 0 auto;">
				</div>



				


				<div class='col-xs-12 box' style="margin: 15px 0px 0px 0px;">
					<p class='name'>QR Code ของคุณ</p>
				</div>



				<div class='col-xs-12 box' style="margin: 5px 0px 10px 0px;">
					<h3 class='name'>คุณ<?php echo $r->name;?></h3>
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
		var url = '<?php echo site_url('event/'.$r->campaign_id.'/qr/'.$r->staff_code);?>';
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