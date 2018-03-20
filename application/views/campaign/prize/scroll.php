<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ประกวด</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/register_qr/font.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/register_qr/style.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css"/>
</head>
<body id="section0" style="overflow: hidden;">

	<div id="scroll">

	<?php foreach($rs as $r){?>

		<?php 
		$member = getMemberPrize($r->campaign_id, $r->prize_id);

		if (count($member) > 0) {?>
			<p style='font-size: 5em; color: #fff !important;'   class='name'><?php echo $r->name;?></p>

			<div class="row" style="margin-bottom: 30px; margin-top: 30px;">

			<?php 
			foreach($member as $m):?>
				<div class="col-md-6"><p style="color: #fff !important; font-size: 3em" class="name"><?php echo $m->staff_id.' '.$m->name;?></p></div>
			<?php endforeach;?>
			
			
			
			</div>

			
		<?php } ?>
		
	<?php } ?>

</div>
	

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>



<script type="text/javascript">
	var pos = 0;
	var scroll = null;

	var click = true;

	scroll = setInterval(function() {
				pos+=20;
				$('html,body').animate({scrollTop: pos}, 'fast');
			}, 1);

	$('body').on('click', function() {

		if (click) {
			scroll = setInterval(function() {
				pos+=20;
				$('html,body').animate({scrollTop: pos}, 'fast');
			}, 1);
		} else {
			console.log('clear');
			clearInterval(scroll);
		}

		click = click ? false : true;
	})

	
</script>
</body>
</html>