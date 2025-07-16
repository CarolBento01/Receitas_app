<?php
$conectar = readline ("conetar com a base de dados? (s/n)");

if ($conectar=="s"){
$conexao = mysqli_connect("127.0.0.1", "root", "", "Receitas");

if ($conexao) {
    echo "Conexão com a base de dados concluída\n";
} else {
    echo "Erro na conexão com a base de dados\n";
}
}
else {
    echo "conexão com a base de dados desligada!";
}