<?php

class dadosCovidController {

    public function getDadosCovid() {
        header("Access-Control-Allow-Origin: *");
        
        $filtro_uf = Flight::request()->query->uf;

        return $filtro_uf ? $this->getCovidFiltroUF($filtro_uf) : $this->getCovidAll();
    }


    public function getCovidFiltroUF($uf) {
        $result = Covid::getOne(['uf' => addslashes($uf)]);
        
        if(!$result) return Flight::json(array('casos' => []));

        $dados = [
            'id_registro' => $result->id_registro,
            'uf' =>$result->uf,
            'casos_acumulado' => $result->casos_acumulado,
            'obitos_acumulado' => $result->obitos_acumulado,
            'last_updated' => $result->last_updated
        ];

        return Flight::json(array('casos' => $dados));
    }


    public function getCovidAll(){
        $result =  Covid::get();
        $dados  = [];

        if(!$result) return Flight::json(array('casos' => $dados));
        
        foreach($result as $chave => $valor) {
            $dados[] = [
                'id_registro' => $valor->id_registro,
                'uf' =>$valor->uf,
                'casos_acumulado' => $valor->casos_acumulado,
                'obitos_acumulado' => $valor->obitos_acumulado,
                'last_updated' => $valor->last_updated
            ];
        }
        return Flight::json(array('casos' => $dados));
    }
 

    public function getRecuperados() {
        header("Access-Control-Allow-Origin: *");
        $dados = [];
        $result = CovidRecuperados::get();

        if(!$result) return Flight::json(array('recuperados' => $dados));
        
        foreach($result as $chave => $valor) {
            $dados[] = [
                'id_registro' => $valor->id_registro,
                'novos' => $valor->novos,
                'recuperados' => $valor->recuperados,
                'acompanhamento' => $valor->acompanhamento,
                'last_updated' => $valor->last_updated
            ];
        }
        return Flight::json(array('recuperados' => $dados));
    }


    public function getObitos() {
        header("Access-Control-Allow-Origin: *");
        $dados = [];
        $result = CovidObitos::get();

        if(!$result) return Flight::json(array('obitos' => $dados));
        
        foreach($result as $chave => $valor) {
            $dados[] = [
                'id_registro' => $valor->id_registro,
                'novos' => $valor->novos,
                'last_updated' => $valor->last_updated
            ];
        }
        return Flight::json(array('obitos' => $dados));
    }


    public function execVarreduraApiGoverno() {
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalEstado'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if(count($objetoJson) <=0) return Flight::json(['updated' => 0]);
        
        foreach($objetoJson as $chave => $valor) {
            $result = Covid::save($valor);
        }
        return Flight::json(['updated' => 1]);
    }


    public function execTotalRecuperados(){
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalGeralApi'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if(!$objetoJson) return Flight::json(['recuperados_updated' => 0]);

        CovidRecuperados::updateRecuperados($objetoJson->confirmados);
        return Flight::json(['recuperados_updated' => 1]);
    }


    public function execTotalObitos(){
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalGeralApi'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if(!$objetoJson) return Flight::json(['obitos_updated' => 0]);

        CovidObitos::updateObitos($objetoJson->obitos);
        return Flight::json(['obitos_updated' => 1]);
    }
}
