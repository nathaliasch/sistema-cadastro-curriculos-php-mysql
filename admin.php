<!DOCTYPE html>
<html>
<head>
    <title>Lista de Currículos</title>
    <style>
        .below-average {
            color: green;
        }

        .above-average {
            color: blue;
        }
    </style>
</head>
<body>
    <h1>Lista de Currículos</h1>

    <a href="logout.php" class="btn btn-danger ml-3">Clique aqui para sair</a>
    

<?php

// Incluir arquivo de conexao
require_once "config.php";

try {
  // Consulta para buscar os currículos cadastrados
  $query = "SELECT id, username, salary_claim FROM users";

  // Executa a consulta
  $stmt = $pdo->query($query);

  // Exibe a lista de currículos
  echo "<ul>";
  $total_salary = 0;
  $num_users = 0;
  $median_salary = 0;
  $median_calc = false; // variável de controle

  
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $username = $row['username'];
    $salary_claim = $row['salary_claim'];
    echo "<li>";
    echo "<b>ID:</b> $id<br>";
    echo "<b>Nome:</b> $username<br>";
    echo "<b>Salário:</b> R$ $salary_claim<br>";
    if ($salary_claim < $median_salary) {
      echo "<span style='color: green;'>Abaixo da média salarial</span>";
    } elseif ($salary_claim > $median_salary) {
      echo "<span style='color: blue;'>Acima da média salarial</span>";
    }
    echo "</li>";
    $total_salary += $salary_claim;
    $num_users++;
    $median_salary = $total_salary / $num_users;
    $median_calc = true; // define a variável de controle como verdadeira

  }
  echo "</ul>";

  // Exibe o relatório com a soma total e a média salarial
  $median_salary = $total_salary / $num_users;
  echo "<p><b>Soma total dos salários:</b> R$ $total_salary</p>";
  echo "<p><b>Média salarial:</b> R$ " . number_format($median_salary, 2, ',', '.') . "</p>";
} catch(PDOException $e) {
  echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

?>
