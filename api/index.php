<?php
require_once 'vendor/autoload.php';
require_once 'src/config/config.php';

$dadosCovid = new dadosCovidController;

Flight::route('GET /dados-covid-br', array($dadosCovid, 'getDadosCovid'));
Flight::route('GET /varre-api', array($dadosCovid, 'varreApiGoverno'));


Flight::start();