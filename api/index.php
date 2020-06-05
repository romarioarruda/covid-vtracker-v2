<?php
require_once 'vendor/autoload.php';
require_once 'src/config/config.php';

$dadosCovid = new dadosCovidController;
$newsCovid  = new ultimasNoticiasController;

//End-points que pegam dados
Flight::route('GET /covid', array($dadosCovid, 'getDadosCovid'));
Flight::route('GET /covid/recuperados', array($dadosCovid, 'getRecuperados'));
Flight::route('GET /covid/obitos', array($dadosCovid, 'getObitos'));

//Endpoints de execução de varredura
Flight::route('GET /covid/atualizar-casos', array($dadosCovid, 'execVarreduraApiGoverno'));
Flight::route('GET /covid/atualizar-recuperados', array($dadosCovid, 'execTotalRecuperados'));
Flight::route('GET /covid/atualizar-obitos', array($dadosCovid, 'execTotalObitos'));
Flight::route('GET /covid/ultimas-noticias', array($newsCovid, 'execUltimasNoticias'));


Flight::start();