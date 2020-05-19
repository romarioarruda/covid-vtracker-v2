<?php


class CovidRecuperados extends Model {
    protected static $tableName = 'recuperados';
    protected static $columns = [
        'id_registro',
        'novos',
        'recuperados',
        'acompanhamento',
        'last_updated'
    ];


    public static function updateRecuperados($obj) {
        $temCasos = CovidRecuperados::getOne([
            'titulo' => $obj->titulo
        ]);

        if($temCasos){
            $result = new CovidRecuperados([
                'id_registro' => $temCasos->id_registro,
                'novos' => $obj->novos,
                'recuperados' =>$obj->recuperados,
                'acompanhamento' => $obj->acompanhamento,
                'last_updated' => date('Y-m-d H:i:s')
            ]);
            $result->update();
        }
    }
}
