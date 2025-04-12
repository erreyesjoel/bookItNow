CREATE DATABASE IF NOT EXISTS itnow;
USE itnow;


CREATE TABLE clientes (
    DNI VARCHAR(50) PRIMARY KEY,  -- Documento de identificación como clave primaria
    tipo_documento ENUM('DNI', 'NIE', 'Pasaporte') DEFAULT 'DNI',  -- Tipo de documento
    nombre_usuario VARCHAR(255),
    correo_electronico VARCHAR(255),
    telefono VARCHAR(15),  -- Número de teléfono (opcional)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Marca de tiempo de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Marca de tiempo de actualización
);


-- Eliminar las tablas que dependen de restaurantes
DROP TABLE IF EXISTS reservas;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS mesas;

-- Eliminar la tabla restaurantes
DROP TABLE IF EXISTS restaurantes;

-- Crear la tabla restaurantes
CREATE TABLE restaurantes (
    nombre_restaurante VARCHAR(255) PRIMARY KEY,  -- Nombre del restaurante como clave primaria
    direccion VARCHAR(255),  -- Dirección del restaurante
    telefono VARCHAR(255),  -- Teléfono de contacto del restaurante
    foto VARCHAR(255),  -- Foto del restaurante
    estado ENUM('Disponible', 'No disponible', 'En obras') DEFAULT 'Disponible'  -- Estado del restaurante
);


-- Crear tabla mesas
CREATE TABLE mesas (
    numero_mesa INT PRIMARY KEY,  -- Usa el número de mesa como clave primaria
    capacidad INT NOT NULL,  -- Capacidad de la mesa (número de personas)
    ubicacion VARCHAR(255),  -- Ubicación de la mesa dentro del restaurante (opcional)
    nombre_restaurante VARCHAR(255),  -- Referencia al restaurante
    FOREIGN KEY (nombre_restaurante) REFERENCES restaurantes(nombre_restaurante)
);

CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,  -- Clave primaria de la reserva
    tipo_documento ENUM('DNI', 'NIE', 'Pasaporte') DEFAULT 'DNI',  -- Tipo de documento
    DNI_cliente VARCHAR(50),  -- Referencia al documento del cliente
    numero_mesa INT,  -- Referencia al numero_mesa
    fecha_hora_reserva DATETIME NOT NULL,  -- Combina fecha y hora
    nombre_restaurante VARCHAR(100),  -- Referencia al restaurante
    estado_reserva ENUM('confirmada', 'pendiente', 'cancelada') DEFAULT 'pendiente',  -- Estado de la reserva
    comentarios TEXT,  -- Comentarios adicionales sobre la reserva
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Marca de tiempo de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Marca de tiempo de actualización
    FOREIGN KEY (DNI_cliente) REFERENCES clientes(DNI),  -- Relación entre reservas y clientes
    FOREIGN KEY (numero_mesa) REFERENCES mesas(numero_mesa),  -- Relación entre reservas y mesas
    FOREIGN KEY (nombre_restaurante) REFERENCES restaurantes(nombre_restaurante)  -- Relación entre reservas y restaurantes
);

DROP TABLE IF EXISTS reservas;
-- por si hace falta borrar algun registro 
 DELETE FROM restaurantes;

-- primera insercion, en restaurantes, pizzeria carlos, terrassa

INSERT INTO restaurantes (nombre_restaurante, direccion, telefono, foto) 
VALUES 
    ('Pizzeria Carlos', 'Plaça de la Creu, 15, 08226, Terrassa, Barcelona', '935379379', '../../views/images/pizzeriacarlos.jpeg'),
    ('La Tagliatella', 'Carrer Navarra, Plaza, 10, 08227 Terrassa, Barcelona', '938091267', '../../views/images/tagliTerrPlaca.jpg'),
    ('La Santa', 'Carretera de Montcada, 740, 08227 Terrassa, Barcelona', '937 85 88 15', '../../views/images/santaTerr.jpg'),
    ('Kyoka', 'Av. del Tèxtil, s/n, 08223 Terrassa, Barcelona', '937 12 87 99', '../../views/images/kyokaParcValles.jpg'),
    ('Talaiot', 'Carrer de Arquímedes, 132, 08224 Terrassa, Barcelona', '629 81 24 88', '../../views/images/talaiot.jpeg');

SELECT * FROM restaurantes;

-- Crear el usuario administrador
CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'administrador';

-- Conceder todos los privilegios al usuario sobre la base de datos itnow
GRANT ALL PRIVILEGES ON itnow.* TO 'administrador'@'localhost';

-- Refrescar los privilegios para que se apliquen inmediatamente
FLUSH PRIVILEGES;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Identificador único de usuario
    nombre VARCHAR(255) NOT NULL,  -- Nombre completo del usuario
    correo VARCHAR(255) NOT NULL UNIQUE,  -- Correo electrónico único
    password VARCHAR(255) DEFAULT NULL,  -- Contraseña (solo en registro clásico)
    google_id VARCHAR(255) UNIQUE DEFAULT NULL,  -- ID de Google (solo en registro con Google)
    tipo_registro ENUM('tradicional', 'google') NOT NULL DEFAULT 'tradicional',  -- Método de registro
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',  -- Estado del usuario
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de registro
    email_verificado BOOLEAN DEFAULT FALSE  -- Indica si el correo está verificado
);

DELETE FROM usuarios;

