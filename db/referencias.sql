USE [truckDB];
GO

IF OBJECT_ID('dbo.referencias', 'U') IS NULL
BEGIN
    CREATE TABLE dbo.referencias (
        id BIGINT IDENTITY(1,1) PRIMARY KEY,
        publicacion NVARCHAR(255) NOT NULL,
        descripcion NVARCHAR(MAX) NULL,
        imagen1 NVARCHAR(255) NULL,
        imagen2 NVARCHAR(255) NULL,
        imagen3 NVARCHAR(255) NULL,
        imagen4 NVARCHAR(255) NULL,
        imagen5 NVARCHAR(255) NULL,
        created_at DATETIME2 NOT NULL DEFAULT SYSDATETIME(),
        updated_at DATETIME2 NOT NULL DEFAULT SYSDATETIME()
    );
END
GO

IF COL_LENGTH('dbo.referencias', 'descripcion') IS NULL
BEGIN
    ALTER TABLE dbo.referencias
        ADD descripcion NVARCHAR(MAX) NULL;
END
GO
