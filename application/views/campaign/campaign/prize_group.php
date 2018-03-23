
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

	<style type="text/css">
		@media (max-width: 768px) { 
			.navbar-brand { width: 50%; }
		}
		/*
		.center {
			height: 100vh;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		}
		*/
		html, body { 
			background-size: cover;
			background-color: #000; }
		h1, h2,p { font-family: 'SukhumvitSet-SemiBold'; color: #fff; text-align: center; }
		p { font-size: 3.5em; text-align: left; padding-left: 70px;}
		h1 { font-size: 4em; }
		h1 font {
			margin-top: 10px; font-size: 0.8em;
		}

		
	</style>
</head>
<body>
	<div class='container-fluid'>

		
			<?php 
		  	$member = getMemberPrize($campaign_id, $prize_id);
		  	?>

		  	<?php if (count($member) ==0):?>
		  		<div class="row" id="p1">
		  			<div class='col-md-12'>
		  				<div class='center'>
							<h1>รางวัล <?php echo $r->name;?></h1>
						</div>
		  			</div>
		  			
		  		</div>
			  	<div class='row' id="p2" style="display: none;">
					<div class='col-md-12'>

						<div class='center'>
							<h1>รางวัล <?php echo $r->name;?></h1>
						</div>
					</div>

					<div class='col-md-12'>

											
					  	<?php if (count($member) ==0):?>
							<!--<p style="text-align: center; margin-top: 20px;"><a href="#" id="random" class="btn btn-lg btn-default"><i class="fa fa-money"></i> จับรางวัล</a></p>-->

						<?php endif;?>

						<div class='row' id="result" style="padding-top: 50px;">
							<?php 
							foreach($member as $m):?>
							<div class="items col-md-6">
								<p><?php echo $m->staff_id;?> - <?php echo $m->name;?></p>
							</div>
						<?php endforeach;?>
						</div>
					</div>
				</div>
			<?php else:?>
				<div class='row'>
					<div class='col-md-12'>

						<div class='center'>
							<h1>รางวัล <?php echo $r->name;?></h1>
						</div>
					</div>

					<div class='col-md-12'>

											
						<div class='row' id="result" style="padding-top: 50px;">
							
						</div>
					</div>
				</div>
			<?php endif;?>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script type="text/javascript">
$('html, body').css('background-image', "url('<?php echo base_url('assets/img/reward-group-background.jpg');?>')");

		<?php if (count($member) == 0):?>

		$(document).keypress(function(e) {
			if(e.which == 13) {
		       random();
		       $('html, body').css('background-image', "url('<?php echo base_url('assets/img/reward-group-background.jpg');?>')");
		    }
		});


		<?php else:?>

		animate()
		
		<?php endif;?>

		function animate() {
			$.post('<?php echo site_url('member/random2');?>', { type: 'group', 'campaign_id': '<?php echo $campaign_id;?>', prize_id: '<?php echo $prize_id;?>' }, function(res) {
				if (res.result) {
					var delay = 1000;
					var num = 1;
					$.each(res.data, function(k, v) {
						var _h = '<div style="" class="items col-md-6"><p>' + v.staff_id + ' - ' + v.name + '</p></div>';
						/*
						$('#result').append().children(':last').hide().fadeIn(delay * num);
						num++;
						*/

						$('#result').delay(2000).queue(function (next) {
						    //$(this).append(_h);
						    $(_h).hide().appendTo(this).fadeIn('fast');
						    next();
						});
					})
				}
			}, 'json');
		}


		$(function() {
			$("#random").on('click', function() {
				random()
			});
		})

		function random()
		{
			$("#p1").hide();
			$("#p2").show();
			//$("#random").fadeOut();
			$.post('<?php echo site_url('member/random');?>', { type: 'group', 'campaign_id': '<?php echo $campaign_id;?>', prize_id: '<?php echo $prize_id;?>' }, function(res) {
				if (res.result) {
					var delay = 1000;
					var num = 1;
					$.each(res.data, function(k, v) {
						var _h = '<div style="" class="items col-md-6"><p>' + v.staff_id + ' - ' + v.name + '</p></div>';
						/*
						$('#result').append().children(':last').hide().fadeIn(delay * num);
						num++;
						*/

						$('#result').delay(2000).queue(function (next) {
						    //$(this).append(_h);
						    $(_h).hide().appendTo(this).fadeIn('fast');
						    next();
						});
					})
				}
			}, 'json');
		}
	</script>
</body>
</html>