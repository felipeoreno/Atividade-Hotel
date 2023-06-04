<?php
    $host = 'localhost';
    $dbname = 'hotelzerotwo';
    $username = 'root';
    // $password = 'sucesso'; // senha do cauê
    $password = ''; // senha do fefe

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
        echo("Erro na conexão: ".$error->getMessage());
        die();
    }
?>