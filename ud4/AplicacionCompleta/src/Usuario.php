<?php

class Usuario
{
    private $CodRes;
    private $Correo;
    private $Clave;
    private $Pais;
    private $CP;
    private $Ciudad;
    private $Direccion;
    public function __construct($CodRes, $Correo, $Clave, $Pais, $CP, $Ciudad, $Direccion){
        $this->CodRes=$CodRes;
        $this->Correo=$Correo;
        $this->Clave=$Clave;
        $this->Pais=$Pais;
        $this->CP=$CP;
        $this->Ciudad=$Ciudad;
        $this->Direccion=$Direccion;
    }

    public static function login($Correo, $Clave){

    }
}