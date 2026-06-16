--tabla marcas
CREATE TABLE `marcasvehiculos` (
	`IdMarca` VARCHAR(20) NOT NULL COLLATE 'utf8mb4_general_ci',
	`DescripMarca` VARCHAR(60) NOT NULL COLLATE 'utf8mb4_general_ci',
	`PaisMarca` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`SitioWebOficial` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`IdMarca`) USING BTREE
)
COMMENT='Marcas de los vehiculos que se venden en Casa Top'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;
--tabla vehiculos
CREATE TABLE `Vehiculos` (
	`Placa` VARCHAR(15) NOT NULL,
	`ModeloVehiculo` VARCHAR(20) NOT NULL,
	`Color` VARCHAR(20) NOT NULL,
	`AnioFabricacion` INT(4) UNSIGNED NOT NULL,
	`Kilometraje` INT(10) UNSIGNED NOT NULL,
	`PrecioOriginal` DOUBLE(10,2) UNSIGNED NOT NULL,
	`IdMarca` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`Placa`),
	CONSTRAINT `FK_marcas_vehiculos` FOREIGN KEY (`IdMarca`) REFERENCES `marcasvehiculos` (`IdMarca`) ON UPDATE CASCADE ON DELETE RESTRICT
)
COMMENT='Lista de Vehiculos Vendidos por Casa Top'
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

--marcas base
INSERT INTO `marcasvehiculos` (`IdMarca`, `DescripMarca`, `PaisMarca`, `SitioWebOficial`) VALUES ('Toyota', 'Marca de autos', 'Japon', 'https://www.toyota.com.sv/');
INSERT INTO `marcasvehiculos` (`IdMarca`, `DescripMarca`, `PaisMarca`, `SitioWebOficial`) VALUES ('Nissan', 'Marca de vehiculos automotores ', 'Japon', 'https://www.nissanelsalvador.com/');
INSERT INTO `marcasvehiculos` (`IdMarca`, `DescripMarca`, `PaisMarca`, `SitioWebOficial`) VALUES ('Honda', 'Marca Global de automoviles', 'Japon', 'https://www.honda.sv/');
--vehiculos base
INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES ('P123-123', 'Corolla', 'Negro', 2025, 0, 30000.00, 'Toyota');
INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES ('P956-874', 'Hilux', 'Rojo', 2018, 90000, 32000.00, 'Toyota');
INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES ('P852-987', 'Frontier', 'Gris', 2020, 75000, 28000.00, 'Nissan');
INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES ('P741-321', 'Sentra', 'Blanco', 2023, 50000, 17000.00, 'Nissan');
INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES ('P963-159', 'Civic', 'Azul', 2021, 100000, 18000.00, 'Honda');
INSERT INTO `vehiculos` (`Placa`, `ModeloVehiculo`, `Color`, `AnioFabricacion`, `Kilometraje`, `PrecioOriginal`, `IdMarca`) VALUES ('P456-753', 'Fit', 'Azul', 2026, 0, 15000.00, 'Honda');