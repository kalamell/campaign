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

	<?php if ($this->input->get('type') == 'print'):?>

		<script type="text/javascript">
			window.print();
		</script>

		

	<?php endif;?>

	<style>
			@media print {
				.pc { display: none;}
				p.site { color: #000 !important; }
			}
		</style>

</head>
<body>
	<div id="fullpage">
		<div id="section1" class='section container'>
			<div class='row'>
				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="display: none; margin-bottom: 20px">
					<img src="<?php echo base_url();?>assets/register_qr/img/logo.png" class='img-responsive pc' alt="">
				</div>


				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="" id="qrcode" class='img-responsive' alt="" style="margin: 0 auto;">
				</div>



				


				<div class='col-xs-12 box' style="margin: 15px 0px 0px 0px;">
					<p class='name pc'>QR Code ของคุณ</p>
				</div>



				<div class='col-xs-12 box' style="margin: 5px 0px 10px 0px;">
					<h3 class='name'>คุณ<?php echo $r->name;?></h3>
					<p style="color: #fff !important;">รหัสพนักงาน <?php echo $r->staff_id;?></p>
					<p style="color: #fff !important;">เบอร์โทรศัพท์ <?php echo $r->mobile;?></p>
				</div>

				<?php if ($campaign->vote_active == '0'):?>

				<?php $boots = get_access($r->staff_id, 'major01');?>
				
				<div class="col-xs-12" style="margin-top: 5px;">
					<?php foreach($boots as $b):?>
						<p class='site' style="color: #fff !important; <?php echo $b['can_access'] == 0 ? 'text-decoration: line-through;' : '';?>"><?php echo $b['can_access'];?> สิทธิ์ กิจกรรม<?php echo $b['boot_name'];?></p>
					<?php endforeach;?>

					<?php if ($r->prize_date != null):?>
						<?php echo $r->prize_name;?>
					<?php endif;?>

				</div>

				<?php else:?>

					<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<a href="<?php echo site_url('vote');?>"><img src="<?php echo base_url('assets/img/vote.png');?>" id="" class='img-responsive' alt="" style="margin: 0 auto;"></a>
				</div>


				<?php endif;?>

				

				
				



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

setInterval(function() {
	top.location.realod();
}, 1800000);

	$(function() {
		var url = '<?php echo site_url('event/'.$r->campaign_id.'/qr/'.$r->staff_code);?>';
		var id = '<?php echo $r->staff_id;?>#<?php echo $this->uri->segment(2);?>';
		$("#qrcode").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + encodeURIComponent(id) + "&chs=160x160&chld=L|0");
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