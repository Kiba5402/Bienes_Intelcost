<?php

interface bienes_json
{
    public function getAllCity();
    public function getAllTypes();
    public function getProperty();
    public function getPropertyB($type, $city);
}
