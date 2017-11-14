<?php
$configs=new SIGA\Config();
$configs->baseURI = '/';
$configs->baseURL = 'http://localhost:8080';
define('SIS_DB_HOST','localhost');
define('SIS_DB_USER','root');
define('SIS_DB_PASS','');
define('SIS_DB_DBSA','mvc');
return $configs;