<?php

class ultimasNoticiasController {

    public function execUltimasNoticias() {
        header("Access-Control-Allow-Origin: *");
        $content = file_get_contents('https://www.bing.com/news/search?q=coronavirus+brasil');
        $arrayData = [];
        $materiasRecentes = [];
    
        if (preg_match('#<div class="main-container">(.*?)</main>#is', $content, $htmlTarget)){
            if (preg_match_all('#class="title"[^>]*?href="(.*?)"[^>]*?>(.*?)</a>.*?class="snippet"[^>]*?>(.*?)</div>.*?source">[^>]*?>(.*?)</a>.*?<span aria-label[^>]*?>(.*?)</span>#is', $htmlTarget[1], $linksRecentes)){
                $materiasRecentes['links'] = $linksRecentes[1];
                $materiasRecentes['titulos'] = $linksRecentes[2];
                $materiasRecentes['soutiens'] = $linksRecentes[3];
                $materiasRecentes['fontes'] = $linksRecentes[4];
                $materiasRecentes['datas'] = $linksRecentes[5];
    
                foreach($materiasRecentes['links'] as $key => $links) {
                    $arrayData[$key]['link'] = $links;
                    $arrayData[$key]['fonte'] = $materiasRecentes['fontes'][$key];
                    $arrayData[$key]['titulo'] = $materiasRecentes['titulos'][$key];
                    $arrayData[$key]['data'] = $materiasRecentes['datas'][$key];
                    $arrayData[$key]['soutien'] = $materiasRecentes['soutiens'][$key];
                }
            }
        }
        return Flight::json(array('news' => $arrayData));
    }
}