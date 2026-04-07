CREATE DATABASE IF NOT EXISTS sancion_digital_php_v2;
USE sancion_digital_php_v2;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(255) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricula VARCHAR(20) NOT NULL UNIQUE, 
    nombre VARCHAR(255) NOT NULL,
    apellido_paterno VARCHAR(255) NOT NULL,
    apellido_materno VARCHAR(255) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE codigo_faltas (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre_falta VARCHAR(255) NOT NULL UNIQUE,
    descripcion TEXT,
    horas_sancion INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE sanciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alumno_id INT NOT NULL,
    vigilante_id INT NOT NULL,
    codigo_falta_id INT NOT NULL,
    status ENUM('pendiente', 'en_progreso', 'cumplida', 'cancelada') DEFAULT 'pendiente',
    fecha_reporte DATE NOT NULL,
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    FOREIGN KEY (alumno_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (vigilante_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (codigo_falta_id) REFERENCES codigo_faltas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO roles (nombre_rol) VALUES 
('Administrador'), 
('Vigilante'), 
('Alumno');

INSERT INTO usuarios (matricula, nombre, apellido_paterno, apellido_materno, correo_electronico, password, rol_id) VALUES 
('ADM001', 'Ethan', 'Millan', 'Admin', 'admin@escuela.edu.mx', '12345', 1), -- Admin
('VIG001', 'Juan', 'Perez', 'Guardia', 'vigilante@escuela.edu.mx', '12345', 2), -- Vigilante
('ALU001', 'Diego', 'Hernandez', 'Lopez', 'alumno@escuela.edu.mx', '12345', 3); -- Alumno

INSERT INTO codigo_faltas (nombre_falta, descripcion, horas_sancion) VALUES 
('Basura', 'Tirar desechos fuera de los contenedores', 2),
('Grafiti', 'Rayar paredes o mobiliario', 4),
('Fumar', 'Fumar dentro de las instalaciones', 10);

