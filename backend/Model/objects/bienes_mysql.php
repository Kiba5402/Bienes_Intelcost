<?php
require_once(dirname(dirname(__FILE__)) . "\interfaces\inter_bienes_mysql.php");
require_once(dirname(dirname(__FILE__)) . '\connection\connFactory.php');

class get_bienes_mysql implements bienes_mysql
{

    private $conn;

    function __construct()
    {
        $this->conn = connFactory::getConn(connFactory::BIENES_MYSQL);
        $this->getAllBSave(1);
    }

    public function getAllBSave($idusr)
    {
        $sql = "select br.Direccion, ci.nombre as Ciudad, br.Telefono, br.Codigo_postal as Codigo_Postal, t.tipo as Tipo, br.Precio 
        from intelcost_bienes.bienes_guardados bg inner join intelcost_bienes.bien_raiz  br
        on bg.idbien = br.id_bien inner join intelcost_bienes.ciudad ci
        on br.id_Ciudad = ci.id inner join intelcost_bienes.tipos t
        on br.id_Tipo = t.id 
        where idusr = " . $idusr;

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $resultT = array();
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($resultT, $row);
            }
            return $resultT;
        } else {
            return -1;
        }
        $this->conn->close();
    }

    public function getBSaveId($idB, $idusr)
    {
        $sql = "select * from intelcost_bienes.bienes_guardados bg 
        where idusr = $idusr and idbien = $idB";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $resultT = array();
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($resultT, $row);
            }
            return $resultT;
        } else {
            return -1;
        }
        $this->conn->close();
    }

    public function getCiudad($nombreCiudad)
    {
        $sql = "select * from intelcost_bienes.ciudad c 
        where c.nombre  like '$nombreCiudad'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $resultT = array();
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($resultT, $row);
            }
            return $resultT;
        } else {
            return -1;
        }
        $this->conn->close();
    }

    public function getTipo($nombreTipo)
    {
        $sql = "select * from intelcost_bienes.tipos t 
        where t.tipo like '$nombreTipo'";

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $resultT = array();
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($resultT, $row);
            }
            return $resultT;
        } else {
            return -1;
        }
        $this->conn->close();
    }

    public function getBien($idBien)
    {
        $sql = "select * from intelcost_bienes.bien_raiz br 
        where br.id_bien =" . $idBien;

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $resultT = array();
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($resultT, $row);
            }
            return $resultT;
        } else {
            return -1;
        }
        $this->conn->close();
    }

    public function postBien($id_bien, $direccion, $telefono, $codigo_post, $precio, $tipo, $ciudad)
    {
        $idTipo = $this->getTipo($tipo);
        $idTipo = $idTipo[0]["id"];

        $idCity = $this->getCiudad($ciudad);
        $idCity = $idCity[0]["id"];

        $sql = "insert into intelcost_bienes.bien_raiz (id_Bien, Direccion, Telefono, Codigo_postal, Precio, id_Tipo, id_Ciudad)
        values ($id_bien, '$direccion', '$telefono', '$codigo_post', '$precio', $idTipo, $idCity);";

        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return -1;
        }

        $this->conn->close();
    }

    public function postTipo($nombreTipo)
    {
        $sql = "insert into intelcost_bienes.tipos (tipo) values ('$nombreTipo')";

        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return -1;
        }

        $this->conn->close();
    }

    public function postCiudad($nombreCiudad)
    {
        $sql = " insert into intelcost_bienes.ciudad (nombre) values ('$nombreCiudad')";

        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return -1;
        }

        $this->conn->close();
    }

    public function postBienGuardado($idBien, $idUsr)
    {
        $sql = "insert into intelcost_bienes.bienes_guardados (idbien ,idusr ) values ($idBien, $idUsr)";

        if ($this->conn->query($sql) === TRUE) {
            return 1;
        } else {
            return -1;
        }

        $this->conn->close();
    }
}
