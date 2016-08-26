CREATE TABLE publicidad
(
	id_publicidad INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
	contenido BLOB NOT NULL,
	PRIMARY KEY(id_publicidad)
) ENGINE = InnoDB;