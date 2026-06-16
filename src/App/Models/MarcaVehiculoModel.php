<?php
namespace App\Models;

class MarcaVehiculoModel {
    public string $IdMarca;
    public string $DescripMarca;
    public string $PaisMarca;
    public string $SitioWebOficial;

    // El constructor facilita instanciar el objeto con datos
    public function __construct(string $idMarca, string $descripMarca, string $paisMarca, string $sitioWebOficial) {
        $this->IdMarca = $idMarca;
        $this->DescripMarca = $descripMarca;
        $this->PaisMarca = $paisMarca;
        $this->SitioWebOficial = $sitioWebOficial;
    }

    public function toArray(): array {
        return [
            "IdMarca" => $this->IdMarca,
            "DescripMarca" => $this->DescripMarca,
            "PaisMarca" => $this->PaisMarca,
            "SitioWebOficial" => $this->SitioWebOficial,
        ];
    }
}