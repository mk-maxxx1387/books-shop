<?php
///////////////MAIN INIT////////////////////
header("Content-Type: text/html; charset=utf-8");
include_once('./config.php');

spl_autoload_register(function ($name){
	include 'libs/'.$name.'.php';
});
require 'libs/Router.php';

Router::start();