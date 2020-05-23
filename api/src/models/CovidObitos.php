<?php


class CovidObitos extends Model {
    protected static $tableName = 'obitos';
    protected static $columns = [
        'novos',
        'last_updated'
    ];


    public static function updateObitos($obj) {
        $result = new CovidObitos([
            'novos' => $obj->novos,
            'last_updated' => date('Y-m-d H:i:s')
        ]);
        $result->insert();
    }
}
