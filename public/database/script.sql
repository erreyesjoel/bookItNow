CREATE DATABASE IF NOT EXISTS itnow;
USE itnow;

-- Crear tabla clientes
CREATE TABLE clientes (
    DNI VARCHAR(255) PRIMARY KEY,  -- DNI como clave primaria
    nombre_usuario VARCHAR(255),
    correo_electronico VARCHAR(255)
);

-- Crear tabla restaurantes
CREATE TABLE restaurantes (
    nombre_restaurante VARCHAR(255) PRIMARY KEY,  -- Nombre del restaurante como clave primaria
    direccion VARCHAR(255),  -- Dirección del restaurante
    telefono VARCHAR(255),  -- Teléfono de contacto del restaurante
    foto VARCHAR(255)
);

-- Crear tabla mesas
CREATE TABLE mesas (
    numero_mesa INT PRIMARY KEY,  -- Usa el número de mesa como clave primaria
    capacidad INT NOT NULL,  -- Capacidad de la mesa (número de personas)
    ubicacion VARCHAR(255),  -- Ubicación de la mesa dentro del restaurante (opcional)
    nombre_restaurante VARCHAR(255),  -- Referencia al restaurante
    FOREIGN KEY (nombre_restaurante) REFERENCES restaurantes(nombre_restaurante)
);

-- Crear tabla reservas
CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,  -- Clave primaria de la reserva
    DNI_cliente VARCHAR(255),  -- Referencia al DNI del cliente
    numero_mesa INT,  -- Referencia al numero_mesa
    fecha_reserva DATE,  -- Fecha de la reserva
    hora_reserva TIME,  -- Hora de la reserva (opcional)
    nombre_restaurante VARCHAR(255),  -- Referencia al restaurante
    FOREIGN KEY (DNI_cliente) REFERENCES clientes(DNI),  -- Relación entre reservas y clientes
    FOREIGN KEY (numero_mesa) REFERENCES mesas(numero_mesa),  -- Relación entre reservas y mesas
    FOREIGN KEY (nombre_restaurante) REFERENCES restaurantes(nombre_restaurante)  -- Relación entre reservas y restaurantes
);

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



-- Crear el usuario administrador
CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'administrador';

-- Conceder todos los privilegios al usuario sobre la base de datos itnow
GRANT ALL PRIVILEGES ON itnow.* TO 'administrador'@'localhost';

-- Refrescar los privilegios para que se apliquen inmediatamente
FLUSH PRIVILEGES;
