<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Database;
use App\Models\MarcaVehiculoModel;

class MarcaVehiculoRepository {
    private $conn;

    private $table = 'marcasvehiculos';

    public function __construct() {
        $this->conn = new Database();
    }


    public function obtenerTodas(): array {
        $pdo = $this->conn->connection();
        $stmt = $pdo->query('SELECT * FROM '.$this->table);
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

    public function existeMarca(string $idMarca) {
        $pdo = $this->conn->connection();
        $sql = "SELECT * FROM {$this->table} WHERE IdMarca = :idMarca";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'idMarca' => $idMarca
        ]);
        $data = $stmt->fetch();
        return ($data != null);
    }

    public function obtenerMarca(string $idMarca) {
        $pdo = $this->conn->connection();
        $sql = "SELECT * FROM {$this->table} WHERE IdMarca = :idMarca";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'idMarca' => $idMarca
        ]);
        $data = $stmt->fetch();
        if ($data != null){
            $marca = new MarcaVehiculoModel(
                $data['IdMarca'], 
                $data['DescripMarca'], 
                $data['PaisMarca'],
                $data['SitioWebOficial']
            );
            return $marca;
        }else{
            return null;
        };
    }
    
    public function agregar(MarcaVehiculoModel $marca) {
        $pdo = $this->conn->connection();
        $sql = "INSERT INTO `marcasvehiculos` (`IdMarca`, `DescripMarca`, `PaisMarca`, `SitioWebOficial`) VALUES (:idMarca, :descripMarca, :paisMarca, :sitioWebOficial)";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'idMarca' => $marca->IdMarca, 
            'descripMarca' => $marca->DescripMarca, 
            'paisMarca' => $marca->PaisMarca,
            'sitioWebOficial' => $marca->SitioWebOficial
        ]);
        return $res;
    }
}