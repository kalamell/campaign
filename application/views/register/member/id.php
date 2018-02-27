<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SCB WEALTH 2018</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/font.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css">
</head>
<body>
	<div id="fullpage">
		
		<div class='section container' id="section0" style="margin-top: -10px !important">
			<div class='row'>
				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="<?php echo base_url();?>assets/img/logo.png" class='img-responsive' alt="">
				</div>

				
				

				<div class='col-xs-12' style="margin-bottom: 10px;">
					<h3 class='name'>S<?php echo $r->code;?></h3>
                </div>
                
                <div class='col-xs-12' style="margin-bottom: 10px;">
					<h3 class='name'>คุณ<?php echo $r->name.' '.$r->surname;?></h3>
				</div>

				<div class='col-xs-12'>
					<?php 
					$color = '01-grey';
					if ($r->color !='') {
						$color = $r->color.'-'.$r->color_name;
					}

					?>
					<img src="<?php echo base_url();?>assets/img/<?php echo $color;?>.png" class='' style="width: 70px; margin: 0 auto; display: block;"/>
					
				</div>

				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-top: 20px;">
					<a href="" class='confirm'> 
						<img src="<?php echo base_url();?>assets/img/confirm_staff.png" class="img-responsive" alt="">
					</a>
				</div>


			</div>
        </div>
        
        <div class='section container' id="section1">
			<div class='row'>
				<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-bottom: 20px">
					<img src="<?php echo base_url();?>assets/img/logo.png" class='img-responsive' alt="">
				</div>

		
                <div class='col-xs-12' style="margin: 20px 0px 20px 0px;">
					<h3 class='name'>ลงทะเบียนเรียบร้อย</h3>
				</div>

				

				<div class='col-xs-6 col-xs-offset-3' style='margin-top: 5px;'>
					<a href="<?php echo site_url('member');?>" class=''> 
						<img src="<?php echo base_url();?>assets/img/close.png" class="img-responsive" alt="">
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
		

	$(function() {
		$("#fullpage").fullpage({
			keyboardScrolling: false
		});

		$.fn.fullpage.setMouseWheelScrolling(false);
    	$.fn.fullpage.setAllowScrolling(false);

		

		$("a.confirm").on('click', function(e) {
			e.preventDefault();
			$.post('<?php echo site_url('member/confirm');?>', {
				code: '<?php echo $r->code;?>',
			}, function(res) {
				$.fn.fullpage.moveSectionDown();
				
			});


		})
		
	});
	</script>
</body>
</html>