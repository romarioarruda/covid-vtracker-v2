<?php

class execVarreduraCovidController {

    public function execVarreduraApiGoverno() {
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalEstado'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if(count($objetoJson) <=0) return Flight::json(['updated' => 0]);
        
        foreach($objetoJson as $chave => $valor) {
            $result = Covid::save($valor);
        }
        return Flight::json(['updated' => 1]);
    }


    public function execTotalAcumulado(){
        exec("curl 'https://xx9p7hp1p7.execute-api.us-east-1.amazonaws.com/prod/PortalGeralApi'", $output_curl);
        
        $objetoJson = json_decode($output_curl[0]);

        if(!$objetoJson) return Flight::json(['acumulados_updated' => 0]);

        CovidRecuperados::updateRecuperados($objetoJson->confirmados);
        CovidObitos::updateObitos($objetoJson->obitos);
        CovidAcumulados::updateAcumulados($objetoJson);

        return Flight::json(['acumulados_updated' => 1]);
    }

}