<?php
require_once 'vendor/autoload.php';
require_once 'src/config/config.php';

$dadosCovid = new dadosCovidController;
$newsCovid  = new ultimasNoticiasController;

Flight::route('GET /dados-covid-br', array($dadosCovid, 'getDadosCovid'));
Flight::route('GET /get-recuperados', array($dadosCovid, 'getRecuperados'));
Flight::route('GET /varre-api', array($dadosCovid, 'execVarreduraApiGoverno'));
Flight::route('GET /atualiza-recuperados', array($dadosCovid, 'execTotalRecuperados'));
Flight::route('GET /ultimas-noticias', array($newsCovid, 'execUltimasNoticias'));


Flight::start();