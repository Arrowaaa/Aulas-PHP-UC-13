<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiperflex</title>
    <style>
        * {
            margin: 0;
        }

        .button {
            display: flex;
            align-items: end;
            justify-content: end;
        }

        .checkbox {
            border-radius: 2px;
            border: 2px solid black;
            padding: 2px 6px;
            width: 200px;
            height: 260px;
        }

        .banner {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: cyan;
            height: 150px;
        }

        h1 {
            color: blueviolet;
        }

        h2 {
            display: flex;
            align-items: center;
            justify-content: center;
            color: antiquewhite;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>

<body style="background-color:grey">
    <div class="banner">
        <h1>Hiperflex</h1>
    </div>
    <h2>Exercício 4 Utilizando Checkbox (Deve trazer em formato de _TABELA_ os resultados referente as escolhas do usuário) </h2>
    <br>
    <a class="px" href="desafio5.php"> Proxímo Exercício </a>
    <br><br>
    
    <div class="checkbox">
        <label for="">Categória e Filtros de Genêros Com Checkbox</label>
        <div class="genero">
            <form action="#" method="post">
                <br>
                <div>
                    <input type="checkbox" name="text[]" id="acao" value="Ação">
                    <label for="acao">Ação</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="biografia" value="Biografia">
                    <label for="biografia">Biografia</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="aventura" value="Aventura">
                    <label for="aventura">Aventura</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="crime" value="Crime">
                    <label for="crime">Crime</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="drama" value="Drama">
                    <label for="drama">Drama</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="romance" value="Romance">
                    <label for="romance">Romance</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="fantasia" value="Fantasia">
                    <label for="fantasia">Fantasia</label>
                </div>
                <div>
                    <input type="checkbox" name="text[]" id="scifi" value="Ficção científica">
                    <label for="scifi">Ficção científica</label>
                </div>
                <br>
                <div class="button">
                    <input type="submit" value="Filtrar">
                </div>
            </form>
        </div>
    </div>
        <br>
    <?php
    if (!empty($_POST['text'])) {  // Verifica se o parâmetro 'text' não está vazio no array $_POST (indica que o formulário foi submetido com uma opção selecionada)
        $generos = $_POST['text']; // Armazena o valor do parâmetro 'text' (o gênero selecionado) na variável $generos
        echo 'Você escolheu os Gêneros: ' . implode(', ', $generos); // Exibe o gênero selecionado ao usuário
        echo '<br>';
        $conexao = new PDO('mysql:host=localhost;dbname=bd_filmes', 'root', ''); // Cria uma nova conexão PDO com o banco de dados

        $posicao = str_repeat('?,', count($generos) - 1) . '?'; // Cria posicao para uma consulta SQL preparada. 
        // Por exemplo, se houver 3 gêneros, ele criará uma string "?, ?, ?".
        $query = "SELECT * FROM tb_filme WHERE genero IN ($posicao)"; // Prepara a consulta SQL para selecionar todos os filmes onde o gênero está na lista de gêneros fornecida
        $preparo = $conexao->prepare($query);
        $preparo->execute($generos); // Executa a consulta preparada, passando os gêneros como parâmetros
        $resultado = $preparo->fetchAll(); // Busca todos os resultados da consulta e os armazena na vareavel $resultado
       echo '<br>';
       // Exibe os resultados ao usuário, mostrando o nome e o gênero de cada filme
       if (!empty($resultado)) {
        echo '<table>';
        echo '<tr><th>Nome</th><th>Gênero</th></tr>';
        foreach ($resultado as $filme) {
            echo '<tr>';
            echo '<td>' . implode($filme['nome']) . '</td>';
            echo '<td>' . implode($filme['genero']) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Nenhum filme encontrado para o gênero selecionado.';
    }
    }
    ?>
</body>

</html>
