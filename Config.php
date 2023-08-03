<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = 'Kp6qvsu75d@';
    $dbName = 'formulario-ueder';
    
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    //if($conexao->connect_errno){
     //   echo "Falha ao se conectar";
    //}
    //else{
     //   echo "conectado ao bando de dadados com sucesso";
    //}

    // Obter os valores dos filtros enviados via GET

?>