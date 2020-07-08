<?php
class connFactory
{

    const BIENES_JSON = 'bj';
    const BIENES_MYSQL = 'mysql';
    const datosConn = array(
        "mysql" => [
            "servername" => "localhost",
            "username" => "root",
            "password" => ""
        ]
    );

    public static function getConn($val)
    {
        if ($val == connFactory::BIENES_JSON) {
            $strJsonFileContents = file_get_contents(dirname(dirname(__FILE__)) . "/data-1.json");
            $datos = json_decode($strJsonFileContents);
            return array(
                "tamaño" => count($datos),
                "datos" => $datos
            );
        } else if ($val == connFactory::BIENES_MYSQL) {

            $servername = connFactory::datosConn["mysql"]["servername"];
            $username = connFactory::datosConn["mysql"]["username"];
            $password = connFactory::datosConn["mysql"]["password"];

            // Create connection
            $conn = new mysqli($servername, $username, $password);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
                return $conn;
            }
        }
    }
}
