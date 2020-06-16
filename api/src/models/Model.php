<?php

class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];


    public function __construct($array) {
        $this->loadFromArray($array);
    }


    public function loadFromArray($array) {
        $class = get_called_class();
        if (!$array) throw new AppException(
            "A estrutura de dados passada no objeto {$class} precisa ser uma matriz válida"
        );

        foreach($array as $key => $value) {
            $this->$key = $value;
        }
    }


    public function __get($key) {
        return $this->values[$key];
    }


    public function __set($key, $value) {
        $this->values[$key] = $value;
    }
    

    public static function getOne($filters = [], $columns = '*') {
        $class  = get_called_class();
        $result = static::getResultSetFromSelect($filters, $columns);

        return $result ? new $class($result->fetch_assoc()) : null;
    }


    public static function get($filters = [], $columns = '*') {
        $objects = [];
        $result  = static::getResultSetFromSelect($filters, $columns);
        
        if (!$result) return $objects;

        $class = get_called_class();
        while($row = $result->fetch_assoc()) {
            array_push($objects, new $class($row));
        }

        return $objects;
    }
    
    
    public static function getResultSetFromSelect($filters = [], $columns = '*') {
        $sql = "SELECT {$columns} FROM "
            . static::$tableName
            . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        
        return $result->num_rows === 0 ? null : $result;
    }


    public function insert() {
        $sql = "INSERT INTO ".static::$tableName." ("
            . implode(",", static::$columns) . ") VALUES (";
        foreach(static::$columns as $col) {
            $sql .= static::getFormatValue($this->$col) . ",";
        }

        $sql[strlen($sql) - 1] = ')';
        $id = Database::executeSQL($sql);

        $this->id_registro = $id;
    }


    public function update() {
        $sql = "UPDATE " . static::$tableName .  " SET ";
        foreach(static::$columns as $col) {
            $sql .= " {$col} = " . static::getFormatValue($this->$col). ",";
        }
        $sql[strlen($sql) - 1] = ' ';
        $sql .= " WHERE id_registro = {$this->id_registro}";
 
        Database::executeSQL($sql);
    }


    public static function getFilters($filters) {
        $sql = '';
        if (count($filters) <= 0) return $sql;
        $sql .= " WHERE 1 = 1";

        foreach($filters as $columns => $values) {
            if($columns === 'raw') {
                $sql .= " AND {$values}";
            } elseif ($columns === 'order') {
                $sql .= " {$values}";
            } else {
                $sql .= " AND {$columns} = ". static::getFormatValue($values);
            }
        }
        return $sql;
    }


    public static function getFormatValue($value) {
        if(is_null($value)) return "null";
        if(gettype($value) === "string") return "'$value'";
        return $value;
    }

}
