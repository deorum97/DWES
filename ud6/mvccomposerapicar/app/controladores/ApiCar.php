<?php

namespace Jrm\Mvc2app;

use Jrm\Mvc2app\Controlador;

class ApiCar extends Controlador
{

    public function __construct(){
        $this->vista = '';
        $this->datos = ['titulo' => 'API CAR'];
        $this->modelo = $this->modelo('car');
    }

    private function jsonResponse($data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    public function index(){
        $this->jsonResponse($this->modelo->getAll());
    }

    public function cars(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->jsonResponse(["error" => "Method Not Allowed"], 405);
            exit;
        }

        $cars = $this->modelo->getAll();
        $this->jsonResponse($cars, 200);
    }

    public function car(int $id): void {

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET';
                $car = $this->modelo->getById($id);

                if (!$car) {
                    $this->jsonResponse(["error" => "Car not found"], 404);
                    exit;
                }

                $this->jsonResponse($car, 200);
                return;
            case 'DELETE';
                $car = $this->modelo->deleteById($id);
                if(!$car){
                    $this->jsonResponse(["error" => "Car not found"], 404);
                    exit;
                }
                $cardel = $this->modelo->deleteById($id);
                $this->jsonResponse(["message" => "Car deleted"], 200);
            default;
                $this->jsonResponse(["error" => "Method Not Allowed"], 405);
                return;
        }


    }
}

