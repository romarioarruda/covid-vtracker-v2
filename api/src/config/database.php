<?php


class Database {

    public static function getConnection() {
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);        
        $conn = new mysqli($env['host'], $env['username'], $env['password'], $env['database']);

        if($conn->connect_error) {
            throw new AppException("Erro na conexão com o banco de dados", 500);
        }

        return $conn;
    }


    public static function getResultFromQuery($sql) {
        $conn = self::getConnection();
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }


    public static function executeSQL($sql) {
        $conn = self::getConnection();

        if(!mysqli_query($conn, $sql)) {
            throw new AppException('Erro na execução de query', 500);
        }

        $id = $conn->insert_id;
        $conn->close();

        return $id;
    }
}