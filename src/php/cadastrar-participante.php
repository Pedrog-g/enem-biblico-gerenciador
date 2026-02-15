<?php

require 'conexao.php';
$nome = $_GET['nome'];
$nivel = $_GET['nivel'];


$sql = "INSERT INTO participantes VALUES ";
$sql .= "(NULL, '$nome', '$nivel', NULL)"; 

$result = mysqli_query($con,$sql)or die( mysqli_error($con));
mysqli_close($con);

if($result){
  echo "Participante adicionado com sucesso!";
}else{
  echo "Ops, ocorreu um erro ao inserir o participante, tente novamente!";
}
