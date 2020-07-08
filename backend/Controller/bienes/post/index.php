<?php
require_once('../../../Model/objects/bienes_mysql.php');

//ruta Controller/bienes/get get
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //traer todas las ciudades
    if (isset($_GET['guarda'])) {
        $idUsr = $_POST['idUsr'];
        $idB = $_POST['idB'];
        $dir = $_POST['dir'];
        $city = $_POST['city'];
        $tel = $_POST['tel'];
        $codigo = $_POST['cod'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        insertbSaved($idB, $dir, $city, $tel, $codigo, $tipo, $precio, $idUsr);
    }
}

function insertbSaved($idB, $dir, $city, $tel, $cod, $tipo, $pre, $idUser)
{
    //verificamos si la ciudad existe
    if (getCiudad($city) == 1) {
        //verificamos si Existe el tipo 
        if (getTipo($tipo) == 1) {
            //verificamos si Existe el bien
            if (getBienId($idB, $dir, $tel, $cod, $pre, $tipo, $city) == 1) {
                //verificamos si el bien ya esta viculado con el ususario
                if (postBienS($idB, $idUser) == 1) {
                    echo json_encode(['Bien guardado Correctamente']);
                } else {
                    echo json_encode(['no se puedo guardar el bien']);
                }
            } else {
                echo json_encode(['Error al crear bien']);
            }
        } else {
            echo json_encode(['Error al crear tipo']);
        }
    } else {
        echo json_encode(['Error al crear ciudad']);
    }
    /*     $bienesJ = new get_bienes();
    $ciudades = $bienesJ->getAllCity();
    echo json_encode($ciudades); */
}

function getCiudad($ciudad)
{
    $bienesMsql = new get_bienes_mysql();
    $ciudadA = $bienesMsql->getCiudad($ciudad);
    if ($ciudadA != -1) {
        return 1;
    } else {
        return $bienesMsql->postCiudad($ciudad);
    }
}

function getTipo($tipo)
{
    $bienesMsql = new get_bienes_mysql();
    $tipoA = $bienesMsql->getTipo($tipo);

    if ($tipoA != -1) {
        return 1;
    } else {
        return $bienesMsql->postTipo($tipo);
    }
}

function getBienId($id, $dir, $tel, $cod, $pre, $ti, $ci)
{
    $bienesMsql = new get_bienes_mysql();
    $bienA = $bienesMsql->getBien($id);

    if ($bienA != -1) {
        return 1;
    } else {
        return $bienesMsql->postBien($id, $dir, $tel, $cod, $pre, $ti, $ci);
    }
}

function postBienS($idBien, $idUsr)
{
    $bienesMsql = new get_bienes_mysql();
    $bienA = $bienesMsql->getBSaveId($idBien, $idUsr);

    if ($bienA != -1) {
        return 1;
    } else {
        return $bienesMsql->postBienGuardado($idBien, $idUsr);
    }
}
