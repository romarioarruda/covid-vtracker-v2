<?php
require_once 'vendor/autoload.php';
require_once 'src/config/config.php';

$dadosCovid = new dadosCovidController;
$varreduraCovid = new execVarreduraCovidController;
$newsCovid  = new ultimasNoticiasController;

//Endpoints que pegam dados
Flight::route('GET /covid', array($dadosCovid, 'getDadosCovid'));
Flight::route('GET /covid/totais', array($dadosCovid, 'getCovidTotais'));
Flight::route('GET /covid/recuperados', array($dadosCovid, 'getRecuperados'));
Flight::route('GET /covid/obitos', array($dadosCovid, 'getObitos'));

//Endpoints de execução de varredura
Flight::route('GET /covid/atualizar-casos', array($varreduraCovid, 'execVarreduraApiGoverno'));
Flight::route('GET /covid/atualizar-acumulados', array($varreduraCovid, 'execTotalAcumulado'));
Flight::route('GET /covid/ultimas-noticias', array($newsCovid, 'execUltimasNoticias'));

//Mapeando rota que não tem nada.
Flight::map('notFound', function(){
    echo '<h1>Rota sem conteúdo</h1>';
});

Flight::start();