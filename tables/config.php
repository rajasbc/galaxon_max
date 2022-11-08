<?php
session_start();
error_reporting(0);
date_default_timezone_get('Asia/Kolkata');
ini_set('date.timezone', 'Asia/Kolkata');

spl_autoload_register(function ($class_name) {
	include  $class_name . '.php';
});


?>