USE [truckDB];
GO

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
GO

/*=========================================================
=            TABLAS MAESTRAS
=========================================================*/

CREATE TABLE dbo.categorias (
    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL,
    slug NVARCHAR(120) NOT NULL UNIQUE,
    descripcion NVARCHAR(MAX) NULL,
    visible BIT NOT NULL DEFAULT 1,
    orden INT NOT NULL DEFAULT 0,
    created_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),
    updated_at DATETIME2 NOT NULL DEFAULT SYSDATETIME()
);
GO

CREATE TABLE dbo.marcas (
    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL,
    slug NVARCHAR(120) NOT NULL UNIQUE,
    descripcion NVARCHAR(MAX) NULL,
    visible BIT NOT NULL DEFAULT 1,
    orden INT NOT NULL DEFAULT 0,
    created_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),
    updated_at DATETIME2 NOT NULL DEFAULT SYSDATETIME()
);
GO

CREATE TABLE dbo.modelos (
    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    marca_id BIGINT NOT NULL,
    nombre NVARCHAR(100) NOT NULL,
    slug NVARCHAR(120) NOT NULL,
    descripcion NVARCHAR(MAX) NULL,
    visible BIT NOT NULL DEFAULT 1,
    orden INT NOT NULL DEFAULT 0,
    created_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),
    updated_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),
    CONSTRAINT uq_modelo_marca_slug UNIQUE (marca_id, slug),
    CONSTRAINT fk_modelo_marca FOREIGN KEY (marca_id)
        REFERENCES dbo.marcas(id)
);
GO

/*=========================================================
=            CAMIONES
=========================================================*/

CREATE TABLE dbo.camiones (
    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    categoria_id BIGINT NOT NULL,
    marca_id BIGINT NOT NULL,
    modelo_id BIGINT NOT NULL,

    nombre NVARCHAR(150) NOT NULL,
    descripcion_corta NVARCHAR(255) NULL,
    descripcion NVARCHAR(MAX) NULL,

    medida NVARCHAR(10) NOT NULL,
    anio SMALLINT NULL,
    precio DECIMAL(14,2) NULL,
    kilometros INT NULL,
    ubicacion NVARCHAR(120) NULL,
    condicion NVARCHAR(10) NOT NULL DEFAULT 'usado',
    combustible NVARCHAR(20) NULL,
    transmision NVARCHAR(20) NULL,
    motor NVARCHAR(120) NULL,
    transmision_detalle NVARCHAR(120) NULL,
    ejes NVARCHAR(20) NULL,
    suspension NVARCHAR(120) NULL,
    cabina NVARCHAR(120) NULL,
    peso_bruto NVARCHAR(20) NULL,
    distancia_ejes NVARCHAR(20) NULL,
    capacidad_tanque NVARCHAR(20) NULL,
    equipamiento NVARCHAR(MAX) NULL,

    vendedor_id BIGINT NULL,
    imagen_principal NVARCHAR(255) NULL,
    estado NVARCHAR(15) NOT NULL DEFAULT 'publicado',

    created_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),
    updated_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),

    CONSTRAINT fk_camion_categoria FOREIGN KEY (categoria_id)
        REFERENCES dbo.categorias(id),
    CONSTRAINT fk_camion_marca FOREIGN KEY (marca_id)
        REFERENCES dbo.marcas(id),
    CONSTRAINT fk_camion_modelo FOREIGN KEY (modelo_id)
        REFERENCES dbo.modelos(id),

    CONSTRAINT chk_camion_condicion CHECK (condicion IN ('nuevo','usado')),
    CONSTRAINT chk_camion_estado CHECK (estado IN ('publicado','borrador','vendido'))
);
GO

/*=========================================================
=            IMÁGENES
=========================================================*/

CREATE TABLE dbo.camion_imagenes (
    id BIGINT IDENTITY(1,1) PRIMARY KEY,
    camion_id BIGINT NOT NULL,
    url NVARCHAR(255) NOT NULL,
    posicion INT NOT NULL DEFAULT 1,
    created_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),

    CONSTRAINT fk_imagen_camion FOREIGN KEY (camion_id)
        REFERENCES dbo.camiones(id)
        ON DELETE CASCADE
);
GO


INSERT INTO categorias (nombre, slug, descripcion)
VALUES 
('Camiones', 'camiones', 'Camiones de carga pesada'),
('Utilitarios', 'utilitarios', 'Vehículos utilitarios');

INSERT INTO marcas (nombre, slug)
VALUES
('Scania', 'scania'),
('Mercedes-Benz', 'mercedes-benz'),
('Volvo', 'volvo');

INSERT INTO modelos (marca_id, nombre, slug)
VALUES
(1, 'R 450', 'r-450'),
(2, 'Actros 2045', 'actros-2045'),
(3, 'FH 540', 'fh-540');


INSERT INTO camiones (
    categoria_id, marca_id, modelo_id,
    nombre, descripcion_corta, descripcion,
    medida, anio, precio, kilometros, ubicacion,
    combustible, transmision, motor,
    imagen_principal
)
VALUES (
    1, 1, 1,
    'Scania R 450 Highline',
    'Camión tractor 6x2 en excelente estado',
    'Unidad en óptimas condiciones, lista para trabajar.',
    '6x2',
    2021,
    125000000,
    320000,
    'Buenos Aires',
    'Diésel',
    'Automática',
    '450 HP',
    'https://cdn.tusitio.com/camiones/scania-r450.jpg'
);

INSERT INTO camion_imagenes (camion_id, url, posicion)
VALUES
(1, 'https://cdn.tusitio.com/camiones/scania-r450-1.jpg', 1),
(1, 'https://cdn.tusitio.com/camiones/scania-r450-2.jpg', 2);
