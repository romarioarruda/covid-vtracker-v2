<?php
require_once 'vendor/autoload.php';
require_once 'src/config/config.php';

$dadosCovid = new dadosCovidController;
$varreduraCovid = new execVarreduraCovidController;
$newsCovid  = new ultimasNoticiasController;

//Endpoints que pegam dados
Flight::route('GET /covid', array($dadosCovid, 'getDadosCovid'));
Flight::route('GET /covid/recuperados', array($dadosCovid, 'getRecuperados'));
Flight::route('GET /covid/obitos', array($dadosCovid, 'getObitos'));

//Endpoints de execução de varredura
Flight::route('GET /covid/atualizar-casos', array($varreduraCovid, 'execVarreduraApiGoverno'));
Flight::route('GET /covid/atualizar-recuperados', array($varreduraCovid, 'execTotalRecuperados'));
Flight::route('GET /covid/atualizar-obitos', array($varreduraCovid, 'execTotalObitos'));
Flight::route('GET /covid/ultimas-noticias', array($newsCovid, 'execUltimasNoticias'));

//Views
Flight::set('flight.views.path', 'src/views');
Flight::map('notFound', function(){
    Flight::render('pageNotFound');
});

Flight::start();