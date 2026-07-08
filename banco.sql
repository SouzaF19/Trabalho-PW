USE banco_pokemon;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE raridade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE pokemon (
    id INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    numero_pokedex INT NOT NULL,
    tipo VARCHAR(50),
    imagem_url VARCHAR(255),
    descricao TEXT
);

CREATE TABLE carta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pokemon INT NOT NULL,
    id_raridade INT NOT NULL,
    quantidade INT DEFAULT 1,

    FOREIGN KEY (id_pokemon) REFERENCES pokemon(id),
    FOREIGN KEY (id_raridade) REFERENCES raridade(id)
);