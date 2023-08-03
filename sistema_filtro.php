<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Currículo | Paulista</title>
    <style>
        /* Estilos CSS ... */
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            border-radius: 15px 15px 0 0;
            margin: 0;
        }

        .box-search {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            padding: 20px;
        }

        /* Adicionar margem inferior para separar os elementos */
        label,
        input[type="text"],
        button[type="submit"] {
            margin-bottom: 1px;
        }

        .pesquisar{
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-button {
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .logout-button a {
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
        }

        .logout-button a:hover {
            background-color: #c82333;
        }


        label {
            display: block;
            font-size: 18px;
        }

        input[type="text"] {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }

        input[type="text"]::placeholder {
            color: #bbb;
        }

        button[type="submit"] {
            padding: 10px 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1> Filtro de Busca Currículo Paulista </h1>
    <form class="box-search" method="GET">
        <!-- Campo e lista de opções para a disciplina -->
        <label for="campoBusca1">Disciplina:</label>
        <input type="text" id="campoBusca1" list="itens1" placeholder="Digite ou selecione um item">
        <datalist id="itens1">
            <option value="matemática">
            <option value="língua Portuguesa">
            <option value="história">
            <option value="geografia">
            <option value="ciências">
        </datalist>

        <!-- Campo e lista de opções para o ano -->
        <label for="campoBusca2">Ano:</label>
        <input type="text" id="campoBusca2" list="itens2" placeholder="Digite ou selecione um item">
        <datalist id="itens2">
            <option value="1_ano">
            <option value="2_ano">
            <option value="3_ano">
            <option value="4_ano">
            <option value="5_ano">
        </datalist>

        <!-- Campo e lista de opções para o bimestre -->
        <label for="campoBusca4">Bimestre:</label>
        <input type="text" id="campoBusca4" list="itens4" placeholder="Digite ou selecione um item">
        <datalist id="itens4">
            <option value="1_bimestre">
            <option value="2_bimestre">
            <option value="3_bimestre">
            <option value="4_bimestre">
        </datalist>
        
        <!-- Botão de busca dentro do formulário -->
        <button class= "pesquisar" type="button" onclick="searchData()">Pesquisar</button>
    </form>
    <div class="logout-button">
    <a href="login.php">Sair</a>
    </div>

    <!-- Script para manipulação do filtro de busca -->
    <script>
        var disciplinaInput = document.getElementById('campoBusca1');
        var anoInput = document.getElementById('campoBusca2');
        var bimestreInput = document.getElementById('campoBusca4');

        disciplinaInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });

        anoInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });

        bimestreInput.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });

        function searchData() {
            var disciplina = document.getElementById('campoBusca1').value;
            var ano = document.getElementById('campoBusca2').value;
            var bimestre = document.getElementById('campoBusca4').value;

            // Construir a URL com os parâmetros de filtro
            var queryString = '';
            if (disciplina !== '') {
                queryString += 'Disciplina=' + encodeURIComponent(disciplina) + '&';
            }
            if (ano !== '') {
                queryString += 'Ano=' + encodeURIComponent(ano) + '&';
            }
            if (bimestre !== '') {
                queryString += 'Bimestre=' + encodeURIComponent(bimestre) + '&';
            }

            // Remover o último '&' da queryString, se houver
            if (queryString.endsWith('&')) {
                queryString = queryString.slice(0, -1);
            }

            // Redirecionar para a página sistema.php com os filtros na URL
            window.location = 'sistema.php?' + queryString;
        }
    </script>

</body>
</html>
