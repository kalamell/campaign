<?php
	include('mysql.php');
	
	$campaign_id 		= mysql_real_escape_string($_POST['id']);

	$sql = "SELECT * FROM boots WHERE campaign_id = '".$campaign_id."'";

	

	$ar = array(
		'result' => false,
	);

	$rs = mysql_query($sql) or die(mysql_error());

	$data = array();

	if (mysql_num_rows($rs) > 0) {
		while($f = mysql_fetch_assoc($rs)) {
			$data[] = array(
				'boot_id' => $f['boot_id'],
				'boot_name' => $f['boot_name'],
				'type_boot' => $f['type_boot'],
			);
		}

		$ar = array(
			'result' => true,
			'data' => $data
		);
	}

	echo json_encode($ar);

	