<?php
	include('mysql.php');
	
	$id 		= mysql_real_escape_string($_POST['id']);
	$staff_id 	= mysql_real_escape_string($_POST['staff_id']);

	//$ex = explode('P', $staff_id);

	//$staff_id = $ex[1];
	
	$query = "SELECT `staff`.*, `department`.`dep_name` as `staff_dep`  FROM `staff`,`department` WHERE `staff`.`dep_id` = `department`.`dep_id` AND `staff`.`staff_id` = '$staff_id' LIMIT 1";


	/*
	
	$result = mysql_query($query);

	if (mysql_num_rows($result) > 0) {
	
		while($row = mysql_fetch_assoc($result)) {
			mysql_query ("UPDATE `staff` SET `prize_date` =  NOW()  WHERE `staff_id` = '$staff_id' AND `prize_id` = '$id' LIMIT 1");
			mysql_query ("UPDATE `prize` SET `staff_id` = '$staff_id', `staff_name` = '". $row['name'] ."', `staff_dep` = '". $row['staff_dep'] ."' WHERE `id` = '$id' LIMIT 1");
			
			if(mysql_affected_rows()) {
				echo json_encode(array(
					'update' => 'complete'
				));
			}else {
				echo json_encode(array(
					'update' => 'fail'
				));
			}
		}
	} else {
		echo json_encode(array(
					'update' => 'fail',
					'msg' => 'data not found'
				));	
	}

	*/

	echo json_encode(array(
					'update' => 'complete'
				));

