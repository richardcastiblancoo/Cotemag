-- Users table with role
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('rector', 'empleado') NOT NULL DEFAULT 'empleado',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    imagen VARCHAR(255) DEFAULT NULL,
    UNIQUE INDEX unique_username (username),
    UNIQUE INDEX unique_email (email)
);

-- News table
CREATE TABLE noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    contenido TEXT NOT NULL,
    imagen VARCHAR(255),
    autor_id INT,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (autor_id) REFERENCES usuarios(id)
);

-- Insertar usuario rector predeterminado
INSERT INTO usuarios (username, email, password, rol) 
VALUES ('admin', 'angello@cotemag.com', 'admin', 'rector');

CREATE TABLE IF NOT EXISTS pqr_solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    documento VARCHAR(50) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    tipo_pqr VARCHAR(50) NOT NULL,
    asunto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);