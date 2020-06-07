<?php


class CovidRecuperados extends Model {
    protected static $tableName = 'recuperados';
    protected static $columns = [
        'novos',
        'recuperados',
        'acompanhamento',
        'last_updated'
    ];


    public static function updateRecuperados($obj) {
        $currentRecuperados = CovidRecuperados::getOne(
            ["raw" => "last_updated >= '".date('Y-m-d' , strtotime('-2 days'))." 00:00:00' ORDER BY recuperados DESC"],
            'recuperados'
        );

        $novoTotal = $currentRecuperados->recuperados + $obj->recuperados;
        $result = new CovidRecuperados([
            'novos' => $obj->novos,
            'recuperados' =>$novoTotal,
            'acompanhamento' => $obj->acompanhamento,
            'last_updated' => date('Y-m-d H:i:s')
        ]);
        $result->insert();
    }
}
