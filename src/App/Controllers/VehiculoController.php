<?php
namespace App\Controllers;

use App\Models\VehiculoModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Repositories\MarcaVehiculoRepository;
use App\Repositories\VehiculoRepository;


class VehiculoController {
    private VehiculoRepository $repo;
    private MarcaVehiculoRepository $marcaRepo;


    public function __construct() {
        $this->repo = new VehiculoRepository();
        $this->marcaRepo = new MarcaVehiculoRepository();
    }

    public function obtenerTodos(Request $request, Response $response): Response {
        $vehiculos = $this->repo->obtenerTodos();
        $data = json_encode($vehiculos);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json');
    }

    /*
    public function obtenerVehiculo(Request $request, Response $response, array $params): Response {
        $Placa = $params['Placa'];
        $vehiculo = $this->repo->obtenerVehiculo($Placa);
        if ($vehiculo == null) {
            $res = json_encode(['msg' => 'Vehiculo no encontrado']);
            $response->getBody()->write($res);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
        $data = json_encode($vehiculo);
        $response->getBody()->write($data);
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }*/

    public function agregar(Request $request, Response $response): Response {

        $data = $request->getParsedBody();
        if ( empty( $data['Placa']) || empty($data['ModeloVehiculo']) || empty($data['Color']) || empty($data['Kilometraje'])
            || empty($data['AnioFabricacion']) || empty($data['PrecioOriginal']) || empty($data['IdMarca']))
        {
            $payload = json_encode(['msg' => 'Los campos Placa, Modelo, Color, Kilometraje, Anio, Precio, y Marca son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }

        if(!$this->marcaRepo->existeMarca($data['IdMarca']))
        {
            $payload = json_encode(['msg' => 'La marca Seleccionada no existe']);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404); // Bad Request
        }

        $vehiculo = new VehiculoModel(
            $data['Placa'],
            $data['ModeloVehiculo'],
            $data['Color'],
            $data['AnioFabricacion'],
            $data['Kilometraje'],
            $data['PrecioOriginal'],
            $data['IdMarca']
        );

        $exito = $this->repo->agregar($vehiculo);

        if (!$exito) {
            $res = json_encode(['msg' => 'No se pudo guardar el Vehiculo']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }

        // Respuesta exitosa
        $res = json_encode([
            'msg' => 'Vehiculo guardado correctamente',
            'Vehiculo' => $vehiculo->toArray()
        ]);
        $response->getBody()->write($res);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 significa "Creado"
    }
}
