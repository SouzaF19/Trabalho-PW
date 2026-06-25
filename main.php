<?php
include("conexao.php");

$url = "https://pokeapi.co/api/v2/pokemon?limit=2000";

$json = file_get_contents($url);
$dados = json_decode($json, true);

foreach ($dados['results'] as $pokemon) {

    $detalhes = json_decode(file_get_contents($pokemon['url']), true);

     if ($detalhes['id'] <= 1351) {
        print "Passou";
        continue;
    }

    
    
    


    $id = $detalhes['id'];
    $nome = ucfirst($detalhes['name']);
    $imagem = $detalhes['sprites']['front_default'];
    $tipo = ucfirst($detalhes['types'][0]['type']['name']);

    $nome = mysqli_real_escape_string($conn, $nome);
    $imagem = mysqli_real_escape_string($conn, $imagem);
    $tipo = mysqli_real_escape_string($conn, $tipo);

    $sql = "
    INSERT IGNORE INTO pokemon
    (id, nome, numero_pokedex, tipo, imagem_url)
    VALUES
    ($id, '$nome', $id, '$tipo', '$imagem')
    ";

    if ($conn->query($sql)) {
        echo "Inserido: $nome <br>";
    } else {
        echo "Erro ao inserir $nome: " . $conn->error . "<br>";
    }
}

$conn->close();

echo "<h2>Importação concluída!</h2>";
?>