
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
			
			<th width="120">รหัสประจำตัว</th>
			<th>รหัสพนักงาน</th>
			<th width="200">ชื่อ - นามสกุล</th>
			<th>ตำแหน่ง</th>
			<th>หน่วยงาน</th>
			<th>เบอร์โทรศัพท์</th>
			<th>บริษัทฯ</th>
			<th>สถานะ</th>
			<th>วันเข้างาน</th>
			<th>ของรางวัล</th>
			<th>Note</th>
			<?php foreach($boot as $b):?>
				<th><?php echo $b->boot_name;?></th>
			<?php endforeach;?>
			<th>รอบลงทะเบียน</th>
			<th>คิวรับรางวัล</th>
			<th>ที่นั่ง</th>
			<th>ประเภทรางวัล</th>
			<th>ชื่อรางวัล</th>
			<th>Area</th>

		</tr>
	</thead>
	<tbody>
		<?php if (count($rs) == 0):?>
			<tr><td colspan="6" style="text-align: center;"> - - - - ไม่มีข้อมูล - - - -</td></tr>
		<?php else:?>
			<?php foreach($rs as $r):
				
				?>
				<tr>
					

					<td><?php echo $r->staff_id;?></td>
					<td><?php echo $r->staff_code;?></td>
					<td><?php echo $r->name;?></td>
					<td><?php echo $r->position;?></td>
					<td><?php echo $r->dep_name;?></td>
					<td><?php echo $r->company;?></td>
					<td><?php echo $r->mobile;?> </td>
					<td><?php echo $r->status;?></td>
					<td><?php echo $r->checkin;?></td>
					<td><?php 
					if ($r->prize_date != null) {
						echo $r->prize_name;
					}
					?></td>

					<td><?php echo $r->note;?></td>
					<?php foreach($boot as $b):?>
						<th><?php echo countBoot($b->boot_id, $r->staff_id);?></th>
					<?php endforeach;?>

					<td><?php echo $r->regis_time;?></td>
					<td><?php echo $r->que;?></td>
					<td><?php echo $r->seat;?></td>
					<td><?php echo $r->prize_type;?></td>
					<td><?php echo $r->prize;?></td>
		
					
					
				</tr>
			<?php endforeach;?>
		<?php endif;?>
	</tbody>
	
</table>

</body>
</html>
