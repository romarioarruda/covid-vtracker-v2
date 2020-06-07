<?php


class CovidAcumulados extends Model {
    protected static $tableName = 'casos_acumulados';
    protected static $columns = [
        'casos_acumulado',
        'obitos_acumulado',
        'last_updated'
    ];


    public static function updateAcumulados($obj) {
        $result = new CovidAcumulados([
            'casos_acumulado' => $obj->confirmados->novos,
            'obitos_acumulado' =>$obj->obitos->novos,
            'last_updated' => date('Y-m-d H:i:s')
        ]);
        $result->insert();
    }
}
