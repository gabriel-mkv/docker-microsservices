<?php 

session_start();

// Variáveis de conexão
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');  

// Criar conexão
$link = new mysqli($servername, $username, $password, $database);

// Checando a conexão
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "SELECT * FROM dados";
$result = $link->query($sql);

echo "<h2 style='text-align: center;'>Dados da Tabela</h2>";

if ($result -> num_rows > 0) {
    // Saída de dados de cada linha
    echo "
    <div style='text-align: center;'>
        <table border='2' cellpadding='5' cellspacing='5' style='margin: 0 auto; text-align: center;'>
                <tr>
                <th>AlunoID</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Endereco</th>
                <th>Cidade</th>
                <th>Host</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["AlunoID"]. "</td>
                <td>" . $row["Nome"]. "</td>
                <td>" . $row["Sobrenome"]. "</td>
                <td>" . $row["Endereco"]. "</td>
                <td>" . $row["Cidade"]. "</td>
                <td>" . $row["Host"]. "</td>
              </tr>";
    }
    echo "</table></div>";
    echo "<h3 style='text-align: center;'>Total de registros: " . $result->num_rows . "</h3>";
    
   // Apagar dados se o botão for clicado
   $apagar_executado = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apagar_tudo'])) {
        $delete_sql = "DELETE FROM dados";
        if ($link->query($delete_sql) === TRUE) {
            $_SESSION['apagar-executado'] = true;
            $apagar_executado = true;

            // Redirecionamento por JavaScript APÓS a execução
            echo "<script>window.location.href = '?apagado=1';</script>";
            exit;
        } else {
            echo "<h3 style='text-align: center;'>Erro ao apagar os registros: " . $link->error . "</h3>";
        }
    }

    // Retira a flag e redireciona a url para tabela.php
    if (isset($_GET['apagado']) && $_GET['apagado'] == 1 && !empty($_SESSION['apagar-executado'])) {
        unset($_SESSION['apagar-executado']);
        echo "<script>
            setTimeout(function() {
                window.location.href = 'tabela.php';
            }, 0);
          </script>";
    }

    // Exibe o botão
    echo '<form method="post" onsubmit="return confirm(\'Tem certeza que deseja apagar todos os registros?\');">
            <div style="text-align: center;">
                <button type="submit" name="apagar_tudo">Apagar Todos</button>
            </div>
         </form>';


} else {
    echo "<h1 style='text-align: center;'>Nenhum resultado encontrado</h1>";
}

?>