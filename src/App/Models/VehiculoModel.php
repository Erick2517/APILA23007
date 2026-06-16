<?php
namespace App\Models;

class VehiculoModel {
    public string $Placa;
    public string $ModeloVehiculo;
    public string $Color;
    public int $AnioFabricacion;
    public int $Kilometraje;
    public float $PrecioOriginal;
    public string $IdMarca;

    // El constructor facilita instanciar el objeto con datos
    public function __construct(string $Placa, string $ModeloVehiculo, string $Color, int $AnioFabricacion, 
                                int $Kilometraje, float $PrecioOriginal, string $IdMarca)
    {
        $this->Placa = $Placa;
        $this->ModeloVehiculo = $ModeloVehiculo;
        $this->Color = $Color;
        $this->AnioFabricacion = $AnioFabricacion;
        $this->Kilometraje = $Kilometraje;
        $this->PrecioOriginal = $PrecioOriginal;
        $this->IdMarca = $IdMarca;
    }

    public function toArray(): array {
        return [
            "Placa" => $this->Placa,
            "ModeloVehiculo" => $this->ModeloVehiculo,
            "Color" => $this->Color,
            "AnioFabricacion" => $this->AnioFabricacion,
            "Kilometraje" => $this->Kilometraje,
            "PrecioOriginal" => $this->PrecioOriginal,
            "IdMarca" => $this->IdMarca
        ];
    }
}