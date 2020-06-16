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
        $result = new CovidRecuperados([
            'novos' => $obj->novos,
            'recuperados' => $obj->recuperados,
            'acompanhamento' => $obj->acompanhamento,
            'last_updated' => date('Y-m-d H:i:s')
        ]);
        $result->insert();
    }
}
