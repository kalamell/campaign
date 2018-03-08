<?php 
/*
Username : nottpeera Password : 03aeb8
*/

$USERNAME = 'nottpeera';
$PASSWORD = '03aeb8';
$FROM     = 'SPECIAL';
$TO       = '0954027399';
$MESSAGE  = 'สวัสดี ท่านได้รับทองหยอง ขนาด 1 ปี๊บ ติดต่อกลับเลย';
$command = 'curl -q "http://www.thsms.com/api/rest?method=send&username='.$USERNAME.'&password='.$PASSWORD.'&from='.$FROM.'&to='.$TO.'&message='.$MESSAGE."'";
echo $command;

echo exec($command);
?>