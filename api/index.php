<?php
require_once 'vendor/autoload.php';
require_once 'src/config/config.php';

$dadosCovid = new dadosCovidController;
$newsCovid  = new ultimasNoticiasController;

Flight::route('GET /dados-covid-br', array($dadosCovid, 'getDadosCovid'));
Flight::route('GET /varre-api', array($dadosCovid, 'varreApiGoverno'));
Flight::route('GET /ultimas-noticias', array($newsCovid, 'ultimasNoticias'));


Flight::start();