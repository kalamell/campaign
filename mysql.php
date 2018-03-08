<?php
define('BASEPATH', 1);
define('ENVIRONMENT', 'production');

require_once('application/config/database.php');
//mysql.php

/*
	

Home	Webmail	Password	Help	File Manager	Logout


Database Created

Details

Your database has been setup. Use the following values:

Database:	poszeeco_scb-app
Host:	localhost
Username:	poszeeco_scb-app
Password:	rp4UmBu5
*/




mysql_connect($db[$active_group]['hostname'], $db[$active_group]['username'], $db[$active_group]['password']);
mysql_select_db($db[$active_group]['database']);
mysql_query('SET NAMES utf8');


/*
mysql_connect('localhost', 'root', '');
mysql_select_db('poszeeco_scb-app');
mysql_query('SET NAMES utf8');
*/

/*

mysql_connect('localhost', 'bkkcupon_scb', 'f9QWxbuNpH') or die('mysql');
mysql_select_db('bkkcupon_scb');
mysql_query('SET NAMES utf8');
*/




function dep($name) {
	$name = trim($name);
	$sql = "SELECT `id` FROM `department` WHERE `name` = '$name'";
	$query = mysql_query($sql);
	
	while($row = mysql_fetch_assoc($query)) {
		return $row['id'];
	}
	
	$sql = "INSERT INTO `department` (`name`) VALUES ('$name')";
	mysql_query($sql);
	
	return mysql_insert_id();
}




function groups($name) {
	$name = trim($name);
	$sql = "SELECT `group_id` FROM `groups` WHERE `group_name` = '$name'";
	$query = mysql_query($sql);
	
	while($row = mysql_fetch_assoc($query)) {
		return $row['group_id'];
	}
	
	$sql = "INSERT INTO `groups` (`group_name`) VALUES ('$name')";
	mysql_query($sql);
	
	return mysql_insert_id();
}

function sendsms($mobile, $name, $prize) {
	
}