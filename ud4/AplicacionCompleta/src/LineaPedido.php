<?php
    class LineaPedido{
        private $codPed;
        private $producto;
        private $unidades;

        public function __construct($codPed, $producto, $unidades){
            $this->codPed=$codPed;
            $this->producto=$producto;
            $this->unidades=$unidades;
        }

        public function guardar(\PDO $pdo){
            $sql = "INSERT INTO pedidosproductos VALuES (null, :codPed, :producto, :unidades)";
            $stmnt = $pdo->prepare($sql);
            $stmnt->bindParam(':codPed',$this->codPed);
            $stmnt->bindParam(':producto',$this->producto);
            $stmnt->bindParam(':unidades',$this->unidades);
            $stmnt->execute();
        }
    }

