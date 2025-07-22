<?php
// conexão
$conectar = readline ( "conetar com a base de dados? (s/n):" );

if ( $conectar == "s") {
$conexao = mysqli_connect("127.0.0.1", "root", "", "Receitas");

    if ($conexao) {
       echo "Conexão com a base de dados concluída\n";
    } else {
        echo "Erro na conexão com a base de dados\n";
    }
} else {
    echo "conexão com a base de dados desligada!\n";
}



$fim = false;
while (!$fim){
    //menu
    echo "Escolha uma opção:\n";
    echo "(1) -> Inserir receitas \n";
    echo "(2) -> Listar  receitas \n";
    echo "(3) -> Atualizar receitas existentes \n";
    echo "(4) -> Apagar receitas \n";
    echo "(0) -> Sair do programa \n";

    $menu = readline("opção :");

switch ($menu) {
    case 0:
        echo "FIM!";
        $fim = true;
        break;
    case 1:
        Criarreceitas($conexao);
        break;
    case 2:
        listarreceitas($conexao);
        break;
    case 3: 
        atualizareceitas($conexao);
        break;
    case 4: 
        apagareceitas($conexao);
        break;
    default:
        echo "Opção inválida!";
        exit;
    }
}

//1. Criar receitas
function Criarreceitas($conexao){    
    $nomereceita = readline("Nome da receita: ");
    $descricao = readline("Descrição: ");
    $tempo_preparo = readline("Tempo de preparação: ");
    $doses = readline("Doses: ");
    // inserir os dados na tabela
    $sql = "INSERT INTO Receita (nome, descricao,tempo_preparo,doses) 
            VALUES ('$nomereceita', '$descricao', '$tempo_preparo', '$doses') "; 
    
        if (mysqli_query($conexao, $sql)) {
        echo "Receita inserida com sucesso\n";
        } else {
        echo "Erro a inserir\n";
        }

}


// 2. Listar todas as receitas
function listarreceitas($conexao){
    $sql = "SELECT id, nome, descricao, tempo_preparo, doses FROM Receita";
    $resultado = mysqli_query ($conexao,$sql);

    while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id"] . " | Nome: " . $linha["nome"] . " |". "\n| Descrição: " . $linha["descricao"] . "\n| Tempo de preparação: " . $linha["tempo_preparo"] . " | Doses: " . $linha["doses"] . "\n";
        echo "--------------------------------------------\n";
}
}
//3. atualizar as receitas
function atualizareceitas($conexao){;
//pedir as infos para as alterações 
$id =readline ("ID da receita a alterar : ");

$novonome = readline ("novo nome : ");
$novadescricao = readline ("nova descricao: ");
$novotempopreparo = readline ("novo tempo de preparo : ");
$novasdoses = readline ("novas doses : ");
//atualizar a base de dados 
$sql = "UPDATE Receita
        SET nome = '$novonome', descricao = '$novadescricao', tempo_preparo = '$novotempopreparo', doses = '$novasdoses'
        WHERE id=$id";
       

if ( mysqli_query ($conexao,$sql)){
     echo "Receita alterada\n";

    } else {
     echo "erro ao atualizar";
    }
}
//4. apagar as reeitas
function apagareceitas($conexao){
    $id = readline ("ID da receita a eliminar : ");
    $sql = "DELETE FROM receita WHERE id = $id " ;

    if ( mysqli_query ($conexao,$sql)){
     echo "Receita apagada\n";

    } else {
     echo "erro ao eliminar";
    }
}

//fechar conexão
mysqli_close($conexao);