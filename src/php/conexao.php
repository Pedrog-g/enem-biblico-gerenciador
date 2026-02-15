<?php
// definições de host, database, usuário e senha
$host = "localhost";
$db   = "enem_biblico";
$user = "root";
$pass = "";
// conecta ao banco de dados
$con = mysqli_connect( $host, $user, $pass, $db ) or die( ' Erro na conexão ' );
mysqli_set_charset($con,'utf8'); 
// seleciona a base de dados em que vamos trabalhar
// cria a instrução SQL que vai selecionar os dados
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, 'SET character_set_connection=utf8');
mysqli_query($con, 'SET character_set_client=utf8');
mysqli_query($con, 'SET character_set_results=utf8');
?>