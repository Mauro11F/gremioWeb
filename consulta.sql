CREATE TABLE `detalle_factura` ( 
   `id_detalle_factura` INT NOT NULL AUTO_INCREMENT, 
   `producto` VARCHAR(20) NOT NULL , 
   `cantidad` INT NOT NULL , 
   `precio_unitario` DECIMAL(7,2) NOT NULL , 
   `precio_total` DECIMAL(7,2) NOT NULL , 
   `fk_pedido_cabecera` INT NOT NULL , 
   PRIMARY KEY (`id_detalle_factura`)
) ENGINE = InnoDB;

CREATE TABLE `impre_color` (
  `id_impre_color` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` VARCHAR(20) NOT NULL,
  `simpleFazA4` DECIMAL(9,3) NOT NULL,
  `dobleFazA4` DECIMAL(9,3) NOT NULL,
  `simpleFazA3` DECIMAL(9,3) NOT NULL,
  `dobleFazA3` DECIMAL(9,3) NOT NULL,
  PRIMARY KEY ('id_impre_color')
) ENGINE=InnoDB;

CREATE TABLE `impre_negro` (
  `id_impre_negro` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` VARCHAR(20) NOT NULL,
  `simpleFazA4` DECIMAL(9,3) NOT NULL,
  `dobleFazA4` DECIMAL(9,3) NOT NULL,
  `simpleFazA3` DECIMAL(9,3) NOT NULL,
  `dobleFazA3` DECIMAL(9,3) NOT NULL,
  PRIMARY KEY ('id_impre_negro')
) ENGINE=InnoDB;

CREATE TABLE `papel` (
  `id_papel` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(20) NOT NULL,
  `precio` DECIMAL(20) NOT NULL,
  PRIMARY KEY ('id_papel')
)ENGINE=InnoDB;

CREATE TABLE `tarjetas_210gr` (
  `id_tarjeta_210gr` int(11) NOT NULL,
  `medida` varchar(20) NOT NULL,
  `papel` varchar(100) NOT NULL,
  `lado_color` varchar(100) NOT NULL,
  `lados` varchar(20) NOT NULL,
  `x100` decimal(9,3) NOT NULL,
  `x200` decimal(9,3) NOT NULL,
  `x500` decimal(9,3) NOT NULL,
  `x1000` decimal(9,3) NOT NULL
) ENGINE=InnoDB