<?php

interface bienes_mysql
{
    public function getAllBSave($idusr);
    public function getCiudad($nombreCiudad);
    public function getTipo($nombreTipo);
    public function getBien($idBien);
    public function postBien($id, $direccion, $telefono, $codigo_post, $precio, $tipo, $ciudad);
    public function postTipo($nombreTipo);
    public function postCiudad($nombreCiudad);
    public function postBienGuardado($idBien, $idUsr);
}
