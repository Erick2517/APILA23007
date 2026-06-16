<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Database;
use App\Models\VehiculoModel;
use App\Repositories\MarcaVehiculoModel;


class VehiculoRepository {
    private $conn;

    private $table = 'vehiculos';

    public function __construct() {
        $this->conn = new Database();
    }


    public function obtenerTodos(): array {
        $pdo = $this->conn->connection();
        $stmt = $pdo->query('SELECT * FROM '.$this->table);
        $data = $stmt->fetchAll();
        $vehiculos = [];
        foreach ($data as $row) {
            $item = new VehiculoModel(
                $row['Placa'],
                $row['ModeloVehiculo'],
                $row['Color'],
                $row['AnioFabricacion'],
                $row['Kilometraje'],
                $row['PrecioOriginal'],
                $row['IdMarca']
            );
            $vehiculos[] = $item;
        }
        return $vehiculos;
    }

    public function existeVehiculo(string $idVehiculo) {
        $pdo = $this->conn->connection();
        $sql = "SELECT * FROM {$this->table} WHERE IdVehiculo = :idVehiculo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'idVehiculo' => $idVehiculo
        ]);
        $data = $stmt->fetch();
        return ($data != null);
    }

    /*
    public function obtenerVehiculo(string $idVehiculo) {
        $pdo = $this->conn->connection();
        $sql = "SELECT * FROM {$this->table} WHERE IdVehiculo = :idVehiculo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'idVehiculo' => $idVehiculo
        ]);
        $data = $stmt->fetch();
        if ($data != null){
            $vehiculo = new VehiculoModel(
                $data['Placa'],
                $data['ModeloVehiculo'],
                $data['Color'],
                $data['AnioFabricacion'],
                $data['Kilometraje'],
                $data['PrecioOriginal'],
                $data['IdMarca']
            );
            return $vehiculo;
        }else{
            return null;
        };
    }*/
    
    public function agregar(VehiculoModel $vehiculo) {
        $pdo = $this->conn->connection();
        $sql = "INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES (:Placa, :ModeloVehiculo, :Color, :AnioFabricacion, :Kilometraje, :PrecioOriginal, :IdMarca);";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            "Placa" => $vehiculo->Placa,
            "ModeloVehiculo" => $vehiculo->ModeloVehiculo,
            "Color" => $vehiculo->Color,
            "AnioFabricacion" => $vehiculo->AnioFabricacion,
            "Kilometraje" => $vehiculo->Kilometraje,
            "PrecioOriginal" => $vehiculo->PrecioOriginal,
            "IdMarca" => $vehiculo->IdMarca
        ]);
        return $res;
    }
}