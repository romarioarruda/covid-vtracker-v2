<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');


//Pastas
define('MODEL_PATH',      realpath(dirname(__FILE__) . '/../models'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('EXCEPTION_PATH',  realpath(dirname(__FILE__) . '/../exceptions'));

//Exceptions
require_once(EXCEPTION_PATH . '/AppException.php');

//Arquivos
require_once('database.php');

//Models, Controllers
spl_autoload_register(function($files) {
    if(file_exists(MODEL_PATH . '/'.$files.'.php')) {
        require_once MODEL_PATH . '/'.$files.'.php';
    }
    
    if(file_exists(CONTROLLER_PATH . '/'.$files.'.php')) {
        require_once CONTROLLER_PATH . '/'.$files.'.php';
    }
});
