<?php
namespace Jrm\Bbdd;
    interface Acciones {
        public function insertar(array $datos):int;
        public function eliminar(int $id);
        public function actualizar (int $id, array $datos);
        public function listar():array;
        public function getLibro(int $id);

    }