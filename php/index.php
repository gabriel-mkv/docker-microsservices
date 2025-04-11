<html>

<head>
<title>Exemplo PHP</title>
</head>
<body>

<?php

echo 'Versao Atual do PHP: ' . phpversion() . '<br>';

// Variáveis de conexão
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');

// Criar conexão
$link = new mysqli($servername, $username, $password, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Gera dados aleatórios
$valor_rand1 =  rand(1, 999);
$valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
$host_name = gethostname();

// Gera a query para insert
$query = "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) 
          VALUES ('$valor_rand1' , '$valor_rand2', '$valor_rand2', '$valor_rand2', '$valor_rand2','$host_name')";

// Insere os dados
if ($link->query($query) === TRUE) {
  echo "<h1 style='text-align: center;'>Dados inseridos com sucesso!</h1>";
} else {
  echo "Error: " . $link->error;
}

?>
</body>
</html>
