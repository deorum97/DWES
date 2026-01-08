<?php
    class LineaPedido{
        private $CodPed;
        private $CodProd;
        private $Unidades;

        public function __construct($CodPed, $CodProd, $Unidades){
            $this->CodPed=$CodPed;
            $this->CodProd=$CodProd;
            $this->Unidades=$Unidades;
        }

        public function guardar(\PDO $pdo){
            $sql = "INSERT INTO pedidosproductos VALUES (null, :CodPed, :CodProd, :Unidades)";
            $stmnt = $pdo->prepare($sql);
            $stmnt->bindParam(':CodPed',$this->CodPed);
            $stmnt->bindParam(':CodProd',$this->CodProd);
            $stmnt->bindParam(':Unidades',$this->Unidades);
            $stmnt->execute();
        }
    }

