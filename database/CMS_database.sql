/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

DROP DATABASE IF EXISTS CMS;

CREATE DATABASE CMS CHARACTER SET utf8 COLLATE utf8_general_ci;

use CMS;

CREATE TABLE cms_company (
  id_company int(30) NOT NULL,
  email varchar(100) DEFAULT NULL,
  name varchar(50) NOT NULL,
  telephon int(100) DEFAULT NULL,
  logo varchar(100) DEFAULT NULL,
  header_picture varchar(100) DEFAULT NULL,
  background_picture varchar(100) DEFAULT NULL,
  address varchar(100) DEFAULT NULL,
  PRIMARY KEY (id_company)
);

CREATE TABLE cms_category (
  id_category_father int(30) DEFAULT NULL,
  id_category int(30) NOT NULL,
  name varchar(50) DEFAULT NULL,
  id_company int(30) NOT NULL,
  PRIMARY KEY (id_category),
  FOREIGN KEY (id_company) References cms_company(id_company)
);

CREATE TABLE cms_article (
  id_article int(30) NOT NULL,
  name varchar(100) DEFAULT NULL,
  description text(600) DEFAULT NULL,
  picture varchar(100) DEFAULT NULL,
  id_category int(30) NOT NULL,
  PRIMARY KEY (id_article),
  FOREIGN KEY (id_category) References cms_category(id_category)
);

CREATE TABLE cms_picture (
  id_picture int(30) NOT NULL,
  picture varchar(600) DEFAULT NULL,
  description varchar(600) DEFAULT NULL,
  id_article int(30) NOT NULL,
  PRIMARY KEY (id_picture),
  FOREIGN KEY (id_article) References cms_article(id_article)
);

CREATE TABLE cms_links (
  id_link int(30) NOT NULL,
  name varchar(100) DEFAULT NULL,
  link varchar(600) DEFAULT NULL,
  id_article int(30) NOT NULL,
  PRIMARY KEY (id_link),
  FOREIGN KEY (id_article) References cms_article(id_article)
); 

CREATE TABLE cms_type_user (
id_type int(30) NOT NULL,
type_user varchar(50) DEFAULT NULL,
PRIMARY KEY (id_type)
);

CREATE TABLE cms_users (
  id_user varchar(30) NOT NULL,
  name varchar(50) NOT NULL,
  surname varchar(100) DEFAULT NULL,
  email varchar(100) DEFAULT NULL,
  telephon int(100) DEFAULT NULL,
  address varchar(100) DEFAULT NULL,
  password varchar(100) NOT NULL,
  id_type int(30) DEFAULT 2,
  id_company int(30) NOT NULL,
  PRIMARY KEY (id_user),
  FOREIGN KEY (id_type) References cms_type_user(id_type),
  FOREIGN KEY (id_company) References cms_company(id_company) 
);