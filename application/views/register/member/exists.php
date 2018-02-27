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
		
		
        
        <div class='section container'>
			<div class='row'>
				<div class='col-xs-8 col-xs-offset-2' style="margin-bottom: 20px;">
					<img src="<?php echo base_url();?>assets/img/logo.png" class='img-responsive' alt="">
				</div>

		
                <div class='col-xs-12' style="margin: 20px 0px 20px 0px;">
					<h3 class='name'>ได้ทำการรับสิทธิ์ไปแล้ว</h3>
				</div>

				

				<div class='col-xs-6 col-xs-offset-3' style='margin-top: 5px;'>
					<a href="<?php echo site_url('member');?>" class=''> 
						<img src="<?php echo base_url();?>assets/img/close.png" class="img-responsive" alt="">
					</a>
				</div>


			</div>
		</div>


	</div>
	
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