<?php
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

    // Rota para obter TODOS os quartos
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        // é criado o comando de SELECT para consultar o banco, que é armazenado dentro da instância $stmt de $conn
        $stmt = $conn->prepare("SELECT * FROM quartos");
        // o comando dentro do prepare() é executado
        $stmt->execute();

        // os dados recebidos do banco são atribuídos por meio do PDO à variável $quartos
        $quartos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // os dados da variável $quartos são transformados em um JSON válido
        echo(json_encode($quartos));
    }
    
      // rota para criar quartos
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $numero = $_POST['numero'];
        $tipo = $_POST['tipo'];


        $stmt = $conn->prepare("INSERT INTO quartos (numero, tipo) VALUES (:numero, :tipo)");
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':tipo', $tipo);


        if($stmt->execute()){
            echo("Quarto criado com sucesso!");
        } else{
            echo("Erro ao criar Quarto!");
        }
    }

        // rota para excluir um Quarto
        if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
            $id = $_GET['id'];
            $stmt = $conn->prepare("DELETE FROM quartos WHERE id = :id;");
            $stmt->bindParam(':id', $id);
    
            if($stmt->execute()){
                echo("Quarto excluído com sucesso");
            } else{
                echo("Erro ao excluir quarto.");
            }
        }
        
    // rota para atualizar um Quarto existente
    if($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])){
        parse_str(file_get_contents("php://input"), $_PUT);

        $id = $_GET['id'];
        $novonumeroQuarto = $_PUT['numeroQuarto'];
        $novotipoQuarto = $_PUT['tipoQuarto'];

        $stmt = $conn->prepare("UPDATE quartos SET numeroQuarto = :numeroQuarto, tipoQuarto = :tipoQuarto, WHERE id = :id;");
        $stmt->bindParam(':numeroQuarto', $novonumeroQuarto);
        $stmt->bindParam(':tipoQuarto', $novotipoQuarto);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()){
            echo("Quarto atualizado com sucesso!");
        } else{
            echo("Erro ao atualizar quarto.");
        }
    }
?>