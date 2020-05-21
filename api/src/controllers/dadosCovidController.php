<?php

class dadosCovidController {

    public function getDadosCovid() {
        header("Access-Control-Allow-Origin: *");
        $dados = [];
        $result = Covid::get();

        if($result) {
            foreach($result as $chave => $valor) {
                $dados[] = [
                    'id_registro' => $valor->id_registro,
                    'uf' =>$valor->uf,
                    'casos_acumulado' => $valor->casos_acumulado,
                    'obitos_acumulado' => $valor->obitos_acumulado,
                    'last_updated' => $valor->last_updated
                ];
            }
        }
        return Flight::json(array('dados' => $dados));
    }


    public function getRecuperados() {
        header("Access-Control-Allow-Origin: *");
        $dados = [];
        $result = CovidRecuperados::get();

        if($result) {
            foreach($result as $chave => $valor) {
                $dados[] = [
                    'id_registro' => $valor->id_registro,
                    'novos' => $valor->novos,
                    'recuperados' => $valor->recuperados,
                    'acompanhamento' => $valor->acompanhamento,
                    'last_updated' => $valor->last_updated
                ];
            }
        }
        return Flight::json(array('dados' => $dados));
    }


    public function execVarreduraApiGoverno() {
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalEstado'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if(count($objetoJson)) {
            foreach($objetoJson as $chave => $valor) {
                $result = Covid::save($valor);
            }
            return Flight::json(['updated' => 1]);
        }
        return Flight::json(['updated' => 0]);
    }


    public function execTotalRecuperados(){
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalGeralApi'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if($objetoJson) {
            CovidRecuperados::updateRecuperados($objetoJson->confirmados);
            return Flight::json(['recuperados_updated' => 1]);
        }
        return Flight::json(['recuperados_updated' => 0]);
    }
}
