/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
/*--Este codigo es propiedad intelectual de Iván Córdoba Donet ivancordoba77@gmail.com--*/
/*--------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------*/
DROP DATABASE IF EXISTS CMS;

CREATE DATABASE CMS;

use CMS;

CREATE TABLE cms_empresa (
  id_empresa int(30) NOT NULL,
  email varchar(100) DEFAULT NULL,
  nombre varchar(50) NOT NULL,
  telefono int(100) DEFAULT NULL,
  logo varchar(100) DEFAULT NULL,
  foto_cabecera varchar(100) DEFAULT NULL,
  foto_fondo varchar(100) DEFAULT NULL,
  direccion varchar(100) DEFAULT NULL,
  PRIMARY KEY (id_empresa)
);

CREATE TABLE cms_categoria (
  id_categoria_padre int(30) DEFAULT NULL,
  id_categoria int(30) NOT NULL,
  nombre varchar(50) DEFAULT NULL,
  id_empresa int(30) NOT NULL,
  PRIMARY KEY (id_categoria),
  FOREIGN KEY (id_empresa) References cms_empresa(id_empresa)
);

CREATE TABLE cms_articulo (
  id_articulo int(30) NOT NULL,
  nombre varchar(100) DEFAULT NULL,
  descripcion varchar(600) DEFAULT NULL,
  foto varchar(100) DEFAULT NULL,
  id_categoria int(30) NOT NULL,
  PRIMARY KEY (id_articulo),
  FOREIGN KEY (id_categoria) References cms_categoria(id_categoria)
);

CREATE TABLE cms_foto (
  id_foto int(30) NOT NULL,
  foto varchar(600) DEFAULT NULL,
  descripcion varchar(600) DEFAULT NULL,
  id_articulo int(30) NOT NULL,
  PRIMARY KEY (id_foto),
  FOREIGN KEY (id_articulo) References cms_articulo(id_articulo)
);

CREATE TABLE cms_links (
  id_link int(30) NOT NULL,
  texto varchar(100) DEFAULT NULL,
  vinculo varchar(600) DEFAULT NULL,
  id_articulo int(30) NOT NULL,
  PRIMARY KEY (id_link),
  FOREIGN KEY (id_articulo) References cms_articulo(id_articulo)
); 

CREATE TABLE cms_tipo_usuario (
id_tipo int(30) NOT NULL,
tipo_usuario varchar(50) DEFAULT NULL,
PRIMARY KEY (id_tipo)
);

CREATE TABLE cms_usuarios (
  id_usuario varchar(30) NOT NULL,
  nombre varchar(50) NOT NULL,
  apellido varchar(100) DEFAULT NULL,
  email varchar(100) DEFAULT NULL,
  telefono int(100) DEFAULT NULL,
  direccion varchar(100) DEFAULT NULL,
  contraseña varchar(100) NOT NULL,
  id_tipo int(30) DEFAULT 2,
  id_empresa int(30) NOT NULL,
  PRIMARY KEY (id_usuario),
  FOREIGN KEY (id_tipo) References cms_tipo_usuario(id_tipo),
  FOREIGN KEY (id_empresa) References cms_empresa(id_empresa) 
);