CREATE TABLE IF NOT EXISTS movimientos_inventario
(
	movimiento_id INT NOT NULL AUTO_INCREMENT,
	usuario_id_salida INT NOT NULL,
	fecha_salida DATETIME NOT NULL,
	sucursal_id_salida INT NOT NULL, 
	estatus VARCHAR(30),
	usuario_id_entrega INT NOT NULL,	
	fecha_entrega DATETIME NOT NULL,
	sucursal_id_entrada INT NOT NULL,
	PRIMARY KEY (movimiento_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS movimientos_productos
(
	movimiento_id INT NOT NULL,
	producto_id INT NOT NULL,
	cantidad INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS inventario_productos
(
	inventario_id INT NOT NULL AUTO_INCREMENT,
	producto_id INT NOT NULL,
	sucursal_id INT NOT NULL,
	cantidad INT NOT NULL,
	PRIMARY KEY (inventario_id),
	FOREIGN KEY (producto_id) REFERENCES productos(producto_id)
#	FOREIGN KEY (sucursal_id) REFERENCES inv_sucursales(sucursal_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;