# 🃏 Vitrine Pokémon

Sistema web desenvolvido para gerenciamento e exposição de cartas Pokémon.

O projeto consiste em uma vitrine onde visitantes podem visualizar cartas cadastradas, enquanto um administrador possui acesso a um painel para gerenciar as cartas disponíveis.

A aplicação utiliza PHP puro, MySQL e HTML/CSS, sem utilização de frameworks, com o objetivo de aplicar conceitos de desenvolvimento web, banco de dados e organização de sistemas.

---

## 📌 Funcionalidades

### Visitante

* Visualização da vitrine de cartas Pokémon;
* Pesquisa de Pokémon pelo nome;
* Visualização de imagem, raridade e quantidade disponível.

### Administrador

* Login administrativo;
* Cadastro de cartas;
* Edição de cartas;
* Exclusão de cartas;
* Gerenciamento dos Pokémon cadastrados.

---

## 🗂️ Estrutura do projeto

```
Trabalho-PW/

├── admin/
│   ├── Painel administrativo
│   └── Gerenciamento de cartas
│
├── auth/
│   └── Sistema de autenticação
│
├── api/
│   ├── Busca de Pokémon
│   └── Importação inicial da PokéAPI
│
├── includes/
│   └── Conexão com banco de dados
│
├── pages/
│   └── Vitrine pública
│
├── css/
│   └── Arquivos de estilização
│
├── banco.sql
└── index.php
```

---

## 🗄️ Banco de dados

O sistema utiliza as seguintes tabelas:

* `usuario`
* `pokemon`
* `raridade`
* `carta`

Relacionamentos:

```
Pokemon 1 ─── N Carta N ─── 1 Raridade
```

---

## 🚀 Como executar o projeto

### 1. Instalar o ambiente

Instale o XAMPP ou outro ambiente com:

* Apache
* MySQL
* PHP

---

### 2. Clonar o projeto

```
git clone https://github.com/seu-usuario/Trabalho-PW.git
```

---

### 3. Configurar o banco

Abra o phpMyAdmin:

```
http://localhost/phpmyadmin
```

Crie o banco:

```
banco_pokemon
```

Depois importe o arquivo:

```
banco.sql
```

---

### 4. Configurar conexão

Verifique o arquivo:

```
includes/conexao.php
```

Configure usuário, senha e nome do banco conforme seu ambiente.

---

### 5. Executar

Coloque o projeto dentro da pasta:

```
C:\xampp\htdocs\
```

Acesse:

```
http://localhost/Trabalho-PW/
```

---

## 🔑 Acesso administrativo

O sistema utiliza um único administrador cadastrado no banco de dados.

Exemplo:

```
Usuário: admin
Senha: admin
```

## 📚 Objetivo acadêmico

Projeto desenvolvido para aplicar conceitos de:

* Desenvolvimento Web;
* Banco de Dados;
* CRUD;
* Autenticação;
* Integração entre PHP e MySQL.
