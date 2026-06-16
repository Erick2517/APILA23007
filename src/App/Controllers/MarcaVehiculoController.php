<?php
namespace App\Controllers;

use App\Models\Local;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Repositories\MarcaVehiculoRepository;

class MarcaVehiculoController {
    private MarcaVehiculoRepository $repo;

    public function __construct() {
        $this->repo = new MarcaVehiculoRepository();
    }

    public function obtenerTodas(Request $request, Response $response): Response {
        $marcas = $this->repo->obtenerTodas();
        $data = json_encode($marcas);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }
    /*
    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();
        if (empty($data['nombre_local']) || empty($data['ubicacion']) || empty($data['estado'])) 
        {
            $payload = json_encode(['error' => 'Los campos nombre_local, ubicacion y estado son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }
        $local = new Local($data['nombre_local'], $data['ubicacion'],$data['estado'], $data['descripcion']??null);

        $exito = $this->repo->create($local);

        if (!$exito) {
            $res = json_encode(['error' => 'No se pudo guardar el Local']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }

        // Respuesta exitosa
        $res = json_encode([
            'msg' => 'Local creado con éxito',
            'Local' => [
                'nombre_local' => $data['nombre_local'],
                'ubicacion' => $data['ubicacion'],
                'descripcion' => $data['descripcion'] ?? '',
                'estado' => $data['estado']
            ]
        ]);
        
        $response->getBody()->write($res);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 significa "Creado"

    }*/
    
}
