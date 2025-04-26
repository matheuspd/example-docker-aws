CREATE DATABASE IF NOT EXISTS meubanco;
USE meubanco;

CREATE TABLE IF NOT EXISTS dados (
    AlunoID INT PRIMARY KEY,
    Nome VARCHAR(50),
    Sobrenome VARCHAR(50),
    Endereco VARCHAR(150),
    Cidade VARCHAR(50),
    Host VARCHAR(50)
);

