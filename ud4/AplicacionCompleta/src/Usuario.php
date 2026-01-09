<?php

class Usuario
{
    private $codRes;
    private $correo;
    private $clave;
    private $pais;
    private $cp;
    private $ciudad;
    private $direccion;
    public function __construct($codRes, $correo, $clave, $pais, $cp, $ciudad, $direccion){
        $this->codRes=$codRes;
        $this->correo=$correo;
        $this->clave=$clave;
        $this->pais=$pais;
        $this->cp=$cp;
        $this->ciudad=$ciudad;
        $this->direccion=$direccion;
    }

    public static function login($correo, $clave){

    }
}