<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT, PATCH');

require_once('./vendor/autoload.php');
require_once('./env.php');
require_once('./src/setting.php');
require_once('./App/Routes/index.php');
