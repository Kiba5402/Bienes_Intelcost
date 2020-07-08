<?php
require_once('../../../Model/objects/bienes_json.php');
require_once('../../../Model/objects/bienes_mysql.php');

//ruta Controller/bienes/get get
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //traer todas las ciudades
    if (isset($_GET['city'])) {
        getAllCity();
    } else if (isset($_GET['types'])) {
        getAllTypes();
    } else if (isset($_GET['cityv']) || isset($_GET['typev'])) {
        getFInfo(
            isset($_GET['typev']) ? $_GET['typev'] : "",
            isset($_GET['cityv']) ? $_GET['cityv'] : ""
        );
    } else if (isset($_GET['bienS'])) {
        getInfoSave($_GET['bienS']);
    } else {
        getAllInfo();
    }
}

function getInfoSave($idusr){
    $bienesS = new get_bienes_mysql();
    $info = $bienesS->getAllBSave($idusr);
    echo json_encode($info);
}

function getAllCity()
{
    $bienesJ = new get_bienes();
    $ciudades = $bienesJ->getAllCity();
    echo json_encode($ciudades);
}

function getAllTypes()
{
    $bienesJ = new get_bienes();
    $ciudades = $bienesJ->getAllTypes();
    echo json_encode($ciudades);
}

function getAllInfo()
{
    $bienesJ = new get_bienes();
    $bienes = $bienesJ->getProperty();
    echo json_encode($bienes);
}

function getFInfo($tipo, $ciudad)
{
    $bienesJ = new get_bienes();
    $bienes = $bienesJ->getPropertyB($tipo, $ciudad);
    echo json_encode($bienes);
}
