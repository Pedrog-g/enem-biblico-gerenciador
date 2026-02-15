<?php
require 'conexao.php';

$id = $_GET['id'];
$acertos = $_GET['acertos'];

$sql = "UPDATE participantes SET acertos='$acertos' WHERE id='$id'";
mysqli_query($con,$sql);

echo "Atualizado com sucesso";
