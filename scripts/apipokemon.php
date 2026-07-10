<?php

include("../includes/conexao.php");


// Quantidade de Pokémon que serão importados
$quantidade = 500;
$i = 0;


// Consulta a PokéAPI
$url = "https://pokeapi.co/api/v2/pokemon?limit=$quantidade";

$resposta = file_get_contents($url);

$dados = json_decode($resposta, true);


foreach($dados["results"] as $pokemon){


    // Nome do Pokémon
    $nome = ucfirst($pokemon["name"]);


    // Busca informações detalhadas
    $detalhes = file_get_contents($pokemon["url"]);

    $info = json_decode($detalhes, true);

    // Número da Pokédex
    $numero = $info["id"];


    // Imagem oficial
    $imagem = $info["sprites"]["front_default"];


    // Tipos
    $tipos = [];

    foreach($info["types"] as $tipo){

        $tipos[] = ucfirst($tipo["type"]["name"]);

    }

    $tipo = implode(", ", $tipos);

    // Descrição inicial
    $descricao = "Pokémon número $numero da Pokédex.";

    // Inserir no banco
    $sql = "

    INSERT INTO pokemon
    (
        id,
        nome,
        numero_pokedex,
        tipo,
        imagem_url,
        descricao
    )

    VALUES (?, ?, ?, ?, ?, ?)

    ";

    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param(

        $stmt,

        "isisss",

        $numero,
        $nome,
        $numero,
        $tipo,
        $imagem,
        $descricao

    );

    mysqli_stmt_execute($stmt);
    
    $i++;
    echo"$i ";
}

echo "Pokémon importados com sucesso!";

?>