<?php
namespace App\Controllers;

use App\Models\MarcaVehiculoModel;
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

    public function obtenerMarca(Request $request, Response $response, array $params): Response {
        $idMarca = $params['idMarca'];
        $marca = $this->repo->obtenerMarca($idMarca);
        if ($marca == null) {
            $res = json_encode(['msg' => 'Marca no encontrada']);
            $response->getBody()->write($res);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $data = json_encode($marca);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function agregar(Request $request, Response $response): Response {

        $data = $request->getParsedBody();
        if ( empty( $data['IdMarca']) || empty($data['DescripMarca']) || empty($data['PaisMarca']) || empty($data['SitioWebOficial']))
        {
            $payload = json_encode(['msg' => 'Los campos Marca, Descripcion, Pais y Sitio Web son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }

        if($this->repo->existeMarca($data['IdMarca']))
        {
            $payload = json_encode(['msg' => 'La marca ya existe']);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400); // Bad Request
        }

        $marca = new MarcaVehiculoModel($data['IdMarca'], $data['DescripMarca'],$data['PaisMarca'], $data['SitioWebOficial']);

        $exito = $this->repo->agregar($marca);

        if (!$exito) {
            $res = json_encode(['msg' => 'No se pudo guardar la marca']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }

        // Respuesta exitosa
        $res = json_encode([
            'msg' => 'Marca guardada correctamente',
            'Marca' => [
                'IdMarca' => $data['IdMarca'],
                'DescripMarca' => $data['DescripMarca'],
                'PaisMarca' => $data['PaisMarca'] ?? '',
                'SitioWebOficial' => $data['SitioWebOficial']
            ]
        ]);
        $response->getBody()->write($res);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 significa "Creado"
    }
}
