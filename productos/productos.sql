CREATE TABLE IF NOT EXISTS colores
(
	id_color int(11) NOT NULL AUTO_INCREMENT,
	color varchar(100) NOT NULL,
	PRIMARY KEY (id_color)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS categorias
(
	id_categoria int(11) NOT NULL AUTO_INCREMENT,
	categoria varchar(100) NOT NULL,
	PRIMARY KEY (id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS materiales
(
	id_material int(11) NOT NULL AUTO_INCREMENT,
	material varchar(100) NOT NULL,
	PRIMARY KEY (id_material)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS productos
(
	id_producto INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL,
	sku VARCHAR(30) NOT NULL,
	descripcion TEXT NOT NULL,
	precio_utilitario FLOAT,
	precio_publico FLOAT,
	PRIMARY KEY (id_producto)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS producto_colores
(
	id_producto INT NOT NULL,
	id_color INT NOT NULL,
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
	FOREIGN KEY (id_color) REFERENCES colores(id_color)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS producto_materiales
(
	id_producto INT NOT NULL,
	id_material INT NOT NULL,
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
	FOREIGN KEY (id_material) REFERENCES materiales(id_material)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS producto_categorias
(
	id_producto INT NOT NULL,
	id_categoria INT NOT NULL,
	FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
	FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


