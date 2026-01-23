<?php
namespace App\Librerias;

/*
Mapear URL desde el navegador
1- controlador
2- método
3- parámetro

formato de la url: BASE_DIR/controlador/metodo/parametro

*/

class Core{
    //controlador base o por defecto
    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];
    public $url = '';

    public function __construct(){
        //print_r($this->getUrl());
        $url = $this->getUrl();

        // Si no existe la sesión de correo y no estamos en el controlador de usuarios, redirigimos
        if (!isset($_SESSION['correo'])) {
            // Comprobamos si el controlador en la URL es 'usuarios' (insensible a mayúsculas)
            $controladorUrl = isset($url[0]) ? strtolower($url[0]) : '';
            if ($controladorUrl !== 'usuarios') {
                header('Location: ' . RUTA_URL . '/usuarios');
                exit;
            }
        }

        //buscar en controladores si el controlador exite
        //if (file_exists(__DIR__.'/../app/controladores/'.
        if (isset($url) && file_exists('../app/controladores/'.
        ucwords($url[0]).'.php')){
            //si existe se define/setea como controlador por defecto.
            $this->controladorActual = ucwords($url[0]);

            //unset indice
            unset($url[0]);
        }

        //requerir el controlador (opcional si usamos autoload, pero para el nombre de la clase es necesario el namespace)
        $nombreClase = 'App\\Controladores\\' . $this->controladorActual;
        $this->controladorActual = new $nombreClase;

        //comprobar la segunda parte de la url: el metodo
        if (isset($url[1])){
            if (method_exists($this->controladorActual, $url[1])){
                //Comprobar el método
                $this->metodoActual = $url[1];
                //unset indice
                unset($url[1]);
            }
        }


        //Probando el método
        //echo $this->metodoActual;

        //Obtener parámetros
        $this->parametros = $url ? array_values($url) : [];

        // Llamar callback con parametros array
        if (isset($this->controladorActual) && method_exists($this->controladorActual, $this->metodoActual)) {
            call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        }
    }

    public function getUrl(): ?array
    {
        //echo $_GET['url'];

        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode ('/', $url);
            return $url;
        }
        return null;
    }
}