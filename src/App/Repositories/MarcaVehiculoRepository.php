<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Database;
use App\Models\MarcaVehiculoModel;

class MarcaVehiculoRepository {
    private $conn;
    public function __construct() {
        $this->conn = new Database();
    }

    public function obtenerTodas(): array {
        $pdo = $this->conn->connection();
        $stmt = $pdo->query('SELECT * FROM MarcasVehiculos');
        $data = $stmt->fetchAll();
        $marcas = [];
        foreach ($data as $row) {
            $item = new MarcaVehiculoModel(
                $row['IdMarca'], 
                $row['DescripMarca'], 
                $row['PaisMarca'],
                $row['SitioWebOficial']
            );
            $marcas[] = $item;
        }
        return $marcas;
    }
    /*
    public function create(Local $data) {
        $pdo = $this->conn->connection();
        $sql = "insert into locales (nombre_local, ubicacion, estado, descripcion) values (:nombre_local, :ubicacion, :estado, :descripcion)";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'nombre_local' => $data->nombre_local, 
            'descripcion' => $data->descripcion, 
            'estado' => $data->estado,
            'ubicacion' => $data->ubicacion
        ]);
        return $res;
    }*/
}