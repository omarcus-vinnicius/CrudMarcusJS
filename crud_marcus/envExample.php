<?php

putenv('DISPLAY_ERRORS_DETAILS=' . true);

$databaseHost = 'localhost';
$databaseName = '';
$databaseUser = 'root';
$databasePass = '';
$databasePort = 3306;

putenv("DB_HOST=$databaseHost");
putenv("DB_NAME=$databaseName");
putenv("DB_USER=$databaseUser");
putenv("DB_PASSWORD=$databasePass");
putenv("DB_PORT=$databasePort");