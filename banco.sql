CREATE DATABASE banco;

USE banco;

CREATE TABLE usuario (

    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
)

CREATE TABLE colecao(

    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
)