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
<body id="section0">

	<div class='container-fluid'>
		<div class='row'>
			<div class='col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-8 col-xs-offset-2' style="margin-top: 20px">
				<img src="<?php echo base_url();?>assets/register_qr/img/logo.png" class='img-responsive' alt="">
			</div>

			<div class='col-xs-12' style="margin: 10px 0px 10px 0px;">
				<p class='name'>ประกวดแฟนซี</p>
				<p>ท่านมีสิทธิ์โหวตได้ 1 ภาพ / 1 ประเภท</p>
			</div>
		</div>

		<div class="row" style="margin-bottom: 20px;">
			<p class="name">ประเภททีม</p>

			<?php $no = 0; foreach($rs as $r):?>
				<?php if ($r->type != 'เดี่ยว'):?>
					<div class='col-md-6 col-xs-6'>
						<a  data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('vote/data/'.$r->campaign_id.'/'.$r->vote_id);?>">
							<img src="<?php echo base_url();?>upload/<?php echo $r->thumbnail;?>" class="img-responsive">
						</a>
					</div>
				<?php $no++; ?>

					<?php if ($no%2 == 0):?>
						<div class="clearfix" style="margin: 10px 0px;"></div>
					<?php endif;?>

				<?php endif;?>

				

			<?php endforeach;?>
			
		</div>


		<div class="row" style="margin-bottom: 20px;">
			<p class="name">ประเภทเดี่ยว</p>

			<?php $no = 0; foreach($rs as $r):?>
				<?php if ($r->type == 'เดี่ยว'):?>
					<div class='col-md-6 col-xs-6'>
						<a  data-toggle="modal" data-remote="false" data-target="#myModal" href="<?php echo site_url('vote/data/'.$r->campaign_id.'/'.$r->vote_id);?>">
							<img src="<?php echo base_url();?>upload/<?php echo $r->thumbnail;?>" class="img-responsive">
						</a>
					</div>
				<?php $no++; ?>

					<?php if ($no%2 == 0):?>
						<div class="clearfix" style="margin: 10px 0px;"></div>
					<?php endif;?>

				<?php endif;?>

			<?php endforeach;?>
			
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
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
	        
	    </div>
    </div>
</div>

<script type="text/javascript">
	$(function() {
		$("#myModal").on('show.bs.modal', function(e) {
           var link = $(e.relatedTarget);
           $(this).find('.modal-content').load(link.attr('href'));
        });

        $('#myModal').on('hide.bs.modal', function () {
		  //$(this).hide('.modal-content').load('<?php echo site_url('vote/loaddata');?>');
		})
	})
	$(document).on('click', '#btn_vote', function() {
		var vote_id = $("#vote_id").val();
		$.post('<?php echo site_url('vote/confirm');?>', { vote_id: vote_id }, function() {
			$("#myModal").modal('hide');
		});
	})
</script>
</body>
</html>