<?php


class Covid extends Model {
    protected static $tableName = 'dados_covid';
    protected static $columns = [
        'uf',
        'casos_acumulado',
        'obitos_acumulado',
        'last_updated',
    ];


    public static function save($obj) {
        $temUF = Covid::getOne([
            'uf' => $obj->nome
        ]);

        if($temUF){
            $result = new Covid([
                'id_registro' => $temUF->id_registro,
                'uf' => $obj->nome,
                'casos_acumulado' =>$obj->casosAcumulado,
                'obitos_acumulado' => $obj->obitosAcumulado,
                'last_updated' => date('Y-m-d H:i:s')
            ]);
            $result->update();
        } else {
            $result = new Covid([
                'uf' => $obj->nome,
                'casos_acumulado' =>$obj->casosAcumulado,
                'obitos_acumulado' => $obj->obitosAcumulado,
                'last_updated' => date('Y-m-d H:i:s')
            ]);
            $result->insert();
        }
    }
}
