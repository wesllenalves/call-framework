<?php
ob_start();
ini_set('display_errors', 1);
set_time_limit(0);
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', str_replace("/",DS,dirname(dirname(__FILE__))));
define('APP_PATH', 'App');
define('TEMPLATES_PATH', str_replace("/",DS, sprintf("%s/templates/",ROOT_PATH)));
/**
 * Verifica se o autoload do Composer está configurado
 */
$composer_autoload = '../vendor' . DS . 'autoload.php';

if (!file_exists($composer_autoload)):
    die('Execute o comando: composer install');
endif;
if (version_compare(PHP_VERSION, '7.0.0', '<')) {
    die('
    	<h2>
    		O suporte ao PHP 5 terminou. 
    	</h2>
    	<h3>    		
    		ou atualize seu PHP para a vers&atilde;o: 7.0.0 ou superior.
    	</h3>
    	');
}
require_once($composer_autoload);
\SIGA\Services\Sessions\StartSession::sec_session_start();
$App=new \SIGA\App(include sprintf("%s/%s/config/configs.php",ROOT_PATH,APP_PATH));
$App->run();