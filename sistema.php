<?php
// Iniciar a sessão
session_start();
// Incluir o arquivo de configuração
include_once('config.php');

// Verifica se o usuário está logado
$logado = $_SESSION['email'];

// Verifica se há filtros na URL
if (!empty($_GET['Disciplina']) || !empty($_GET['Ano']) || !empty($_GET['Bimestre'])) {
    // Obter os valores dos filtros da URL
    $disciplina = isset($_GET['Disciplina']) ? $_GET['Disciplina'] : '';
    $ano = isset($_GET['Ano']) ? $_GET['Ano'] : '';
    $bimestre = isset($_GET['Bimestre']) ? $_GET['Bimestre'] : '';

    // Construir o nome da tabela a partir dos filtros
    $tabela = strtolower($disciplina) . '_' . strtolower($ano) . '_' . strtolower($bimestre);

    // Utilize as variáveis $disciplina, $ano e $bimestre para construir a consulta SQL
    // Aqui você pode fazer as adaptações necessárias para obter o banco de dados desejado

    $data1 = isset($_GET['campoBusca1']) ? $_GET['campoBusca1'] : '';
    $data2 = isset($_GET['campoBusca2']) ? $_GET['campoBusca2'] : '';
    $data4 = isset($_GET['campoBusca4']) ? $_GET['campoBusca4'] : '';

    // Usando prepared statements para evitar SQL Injection
    $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id LIKE ? or UNIDADES_TEMÁTICAS LIKE ? or HABILIDADES LIKE ? or OBJETOS_DE_CONHECIMENTOS LIKE ? ORDER BY id ASC");
    $searchTerm = "%{$data1}%";
    $stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    } 

if(!empty($_GET['search']))
{
    $data = $_GET['search'];
    $sql = "SELECT * FROM ciências_3_ano_1_bimestre WHERE id LIKE '%$data%' or UNIDADES_TEMÁTICAS LIKE '%$data%' or HABILIDADES LIKE '%$data%' or 'OBJETOS_DE_CONHECIMENTOS' LIKE '%$data%'ORDER BY id ASC";
}
else
{
    $sql = "SELECT * FROM ciências_3_ano_1_bimestre ORDER BY id ASC";
}
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SISTEMA | BNCC</title>
    <style>
        .container-fluid {
            text-align: center;
        }
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
        }
        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid text-center"> <!-- Adicionando a classe text-center -->
            <a class="navbar-brand mx-auto" href="#">SISTEMA BNCC PAULISTA</a> <!-- Adicionando a classe mx-auto -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <!-- Botão de voltar -->
    <a href="sistema_filtro.php" class="btn btn-secondary btn-sm" style="position: absolute; top: 15px; left: 15px;">
        Voltar
    </a>
    <br>
    <?php
        echo "<h1>Bem vindo <u>$logado</u></h1>";
    ?>
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">UNIDADES_TEMÁTICAS</th>
                    <th scope="col">HABILIDADES</th>
                    <th scope="col">OBJETOS_DE_CONHECIMENTOS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['UNIDADES_TEMÁTICAS']."</td>";
                        echo "<td>".$user_data['HABILIDADES']."</td>";
                        echo "<td>".$user_data['OBJETOS_DE_CONHECIMENTOS']."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'sistema.php?search='+search.value;
    }
</script>
</html>
