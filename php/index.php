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

// Cria a tabela se ela não existir
$create_table_sql = "
CREATE TABLE IF NOT EXISTS dados (
    AlunoID INT PRIMARY KEY,
    Nome VARCHAR(100),
    Sobrenome VARCHAR(100),
    Endereco VARCHAR(100),
    Cidade VARCHAR(100),
    Host VARCHAR(100),
    CriadoEm TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$link->query($create_table_sql)) {
    echo "Erro ao criar a tabela: " . $link->error;
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
  echo "New record created successfully";
} else {
  echo "Error: " . $link->error;
}

?>
</body>
</html>
