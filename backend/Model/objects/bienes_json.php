<?php
require_once(dirname(dirname(__FILE__)) . "\interfaces\inter_bienes.php");
require_once(dirname(dirname(__FILE__)) . '\connection\connFactory.php');

class get_bienes implements bienes_json
{
    private $conn;

    function __construct()
    {
        $this->conn = connFactory::getConn(connFactory::BIENES_JSON);
    }

    public function getAllCity()
    {
        $datos = $this->conn;
        $ciudades = [];
        foreach ($datos["datos"] as $key => $dato) {
            $ciudad = $dato->Ciudad;
            if (!in_array($ciudad, $ciudades)) {
                array_push($ciudades, $ciudad);
            }
        }
        return $ciudades;
    }

    public function getAllTypes()
    {
        $datos = $this->conn;
        $tipos = [];
        foreach ($datos["datos"] as $key => $dato) {
            $tipo = $dato->Tipo;
            if (!in_array($tipo, $tipos)) {
                array_push($tipos, $tipo);
            }
        }
        return $tipos;
    }

    public function getProperty()
    {
        return $this->conn;
    }

    public function getPropertyB($tipo, $ciudad)
    {
        $datos = $this->conn;
        $res = [];
        foreach ($datos["datos"] as $key => $dato) {
            if (trim($ciudad) != "" && trim($tipo) != "") {
                if (trim($dato->Ciudad) == $ciudad && trim($dato->Tipo) == $tipo) {
                    array_push($res, $dato);
                }
            } else {
                if (trim($dato->Ciudad) == $ciudad || trim($dato->Tipo) == $tipo) {
                    array_push($res, $dato);
                }
            }
        }
        return $res;
    }
}
