<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>

	<table class="table table-bordered table-striped" border="1">
			  		<thead>
			  			<tr>
			  				<th>Dep(s)</th>
			  				
			  				<th>ลำดับ</th>
			  				<th width="200">ชื่อของรางวัล</th>
			  				<th width="100">จำนวน</th>
			  				<th>พนักงานผู้ได้รับรางวัล</th>
			  			</tr>
			  		</thead>

			  		<tbody>
			  			<?php if (count($rs) == 0):?>
			  				<tr><td colspan="8" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
			  			<?php else:?>
			  				<?php foreach($rs as $r):?>
			  					<tr>
			  						<td style="text-align: center;">
			  							<?php echo getCountDepVote($r->prize_id);?>
			  						</td>
			  						
			  						<td>
			  							<?php echo $r->order;?> 
			  						</td>




			  						<td><?php echo $r->name;?></td>
			  						<td style=""><?php echo $r->total;?></td>
			  						<td>
			  							<?php 
			  							$member = getMemberPrize($r->campaign_id, $r->prize_id);
			  							if(count($member)>0) {
			  								foreach($member as $m) {
			  									echo '<p>'.$m->staff_id.' - '.$m->name;
			  									?>

			  									
			  									</p>

			  									<?php
			  								}
			  							}
			  							?>
			  							
			  							
			  						</td>
			  						
			  						
			  					</tr>
			  				<?php endforeach;?>
			  			<?php endif;?>
			  		</tbody>
			  		
			  	</table>

</body>
</html>