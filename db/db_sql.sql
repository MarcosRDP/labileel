DROP DATABASE   IF     EXISTS dataset;
CREATE DATABASE IF NOT EXISTS dataset;
USE dataset;

CREATE TABLE IF NOT EXISTS dataset.tb_modulo  (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome   varchar(30),
    descricao varchar(250)
);
  
CREATE TABLE IF NOT EXISTS dataset.tb_usuario(
    id              INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nome            VARCHAR(120) NOT NULL,
    -- sobrenome       VARCHAR(45) NOT NULL,
    -- user_id         SERIAL,
    cpf             VARCHAR(14) NOT NULL,
    senha           VARCHAR(60) NOT NULL,
    email           VARCHAR(45) UNIQUE,
    dt_nascimento   DATE NOT NULL,
    sexo            VARCHAR(11) NOT NULL,
    nacionalidade   VARCHAR(15) NOT NULL,
    cidade          VARCHAR(45) NOT NULL,
    estado          VARCHAR(20) NOT NULL,   
    estrangeiro     BOOLEAN NOT NULL
);

CREATE TABLE IF NOT EXISTS dataset.tb_modulo_usuario  (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_modulo INT,
    id_usuario INT,
    `status` INT,
    
    CONSTRAINT fk_mu_modulo FOREIGN KEY(id_modulo)
        REFERENCES dataset.tb_modulo(id),
        
	CONSTRAINT fk_mu_usuario FOREIGN KEY(id_usuario)
        REFERENCES dataset.tb_usuario(id)
);

create table IF NOT EXISTS dataset.tb_video(
    id              INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_modulo       INT,
    num_video       INT,
    nome            VARCHAR(30),
    descricao       VARCHAR(250),
    caminho_video   VARCHAR(250),
    caminho_legenda VARCHAR(250),
    
    CONSTRAINT fk_video_modulo FOREIGN KEY(id_modulo)
        REFERENCES dataset.tb_modulo(id)
);

create table IF NOT EXISTS dataset.tb_envio(
    id              INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_usuario      INT,
    id_video        INT,
    caminho_envio   VARCHAR(250),
    `status` INT,
    
    CONSTRAINT fk_envio_video FOREIGN KEY(id_video)
        REFERENCES dataset.tb_video(id),
    
    CONSTRAINT fk_envio_usuario FOREIGN KEY(id_usuario)
        REFERENCES dataset.tb_usuario(id)
);


