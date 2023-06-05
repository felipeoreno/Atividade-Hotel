<?php
    require_once("helpers.php");
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    // GET recebe/pega informações
    // POST envia informações
    // PUT edita informações: "update"
    // DELETE deleta informações
    // OPTIONS é a relação de métodos disponíveis para uso
    header('Access-Control-Allow-Headers: Content-Type');

    if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
        exit;
    } else{

    }

    include 'conexao.php';

    // Rota para obter todas as reservas
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // é criado o comando de SELECT para consultar o banco, que é armazenado dentro da instância $stmt de $conn
        $stmt = $conn->prepare("SELECT * FROM reservas");
        // o comando dentro do prepare() é executado
        $stmt->execute();

        // os dados recebidos do banco são atribuídos por meio do PDO à variável $quartos
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // os dados da variável $quartos são transformados em um JSON válido
        echo(json_encode($reservas));
    }

    // rota para criar reservas
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $quarto = $_POST['quarto'];
        $cliente = $_POST['cliente'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $disponivel = 0;

        $stmt = $conn->prepare("INSERT INTO reservas (quarto, cliente, check_in, check_out) VALUES (:quarto, :cliente, :check_in, :check_out); UPDATE quartos SET disponivel = :disponivel WHERE numero = :quarto;");
        $stmt->bindParam(':quarto', $quarto);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':check_in', $check_in);
        $stmt->bindParam(':check_out', $check_out);
        $stmt->bindParam(':disponivel', $disponivel);

        if($stmt->execute()){
            echo("Reserva criada com sucesso!");
        } else{
            echo("Erro ao criar reserva!");
        }
    }