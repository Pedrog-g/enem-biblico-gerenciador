<?php
require 'conexao.php';

header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT * FROM participantes ORDER BY acertos DESC";

$result = mysqli_query($con,$sql);

$dados = [];

while($row = mysqli_fetch_assoc($result)){
  $dados[] = $row;
}

echo json_encode($dados);
exit;
