
USE banco_pokemon;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);


CREATE TABLE vitrine 
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id),
    nome VARCHAR(100) NOT NULL,
)

CREATE TABLE pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    numero_pokedex INT NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    imagem_url VARCHAR(255),
    descricao TEXT,
    id_raridade INT,
    FOREIGN KEY (id_raridade) REFERENCES raridade(id)
);

CREATE TABLE carta
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_vitrine INT,
    id_pokemon INT,
    id_raridade INT,
    FOREIGN KEY (id_vitrine) REFERENCES vitrine(id),
    FOREIGN KEY (id_pokemon) REFERENCES pokemon(id),
    FOREIGN KEY (id_raridade) REFERENCES raridade(id),
)
