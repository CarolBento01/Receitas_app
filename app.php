<?php
// conexão
$conectar = readline ( "conetar com a base de dados? (s/n): " );

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
    echo "---------- fase 4 -------------\n";
    echo "(1) -> Inserir receitas \n";
    echo "(2) -> Listar  receitas \n";
    echo "(3) -> Atualizar receitas existentes \n";
    echo "(4) -> Apagar receitas \n";
    echo "---------- fase 5 -------------\n";
    echo "(5) -> Criar categorias\n";
    echo "(6) -> Listar categorias\n";
    echo "(7) -> Associar Receita a Categorias\n";
    echo "(8) -> Desassociar Receita a Categorias\n";
    echo "(9) -> Consultar receitas filtradas por categoria\n";
    echo "-------------------------------\n";
    echo "(0) -> Sair do programa \n";
    echo "-------------------------------\n";


    $menu = readline("opção : ");
    echo "\n\n";

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
    case 5: 
        Criarcategoria($conexao);
        break;
    case 6: 
        listarcategoria($conexao);
        break;
    case 7: 
        associarReceitaCategorias($conexao);
        break;
    case 8: 
        desassociarReceitaCategorias($conexao);
        break;
    case 9: 
        Consultar_receitas($conexao);
        break;
    default:
        echo "Opção inválida!";
        exit;
    }
}

////////////////////// FASE 4.   ///////////////////////////////

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
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////// FASE 5.   ///////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////


// 1. Criar e listar categorias
function Criarcategoria($conexao){    
    $nomecategoria = readline("criar categoria: ");
// inserir
    $sql = "INSERT INTO categoria (nome) 
            VALUES ('$nomecategoria') "; 
    
    if (mysqli_query($conexao, $sql)) {
        echo "categoria inserida com sucesso\n";
     } else {
        echo "Erro a inserir\n";
    }
    echo "\n";
}
//listar
function listarcategoria($conexao){  
    $sql = "SELECT * FROM categoria";
    $resultado = mysqli_query($conexao, $sql);
    echo "mostrar categorias :\n" ; 
    echo "\n Categorias \n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo $linha['id_categoria'] . " <---> " . $linha['nome'] . "\n";
    }
    echo "\n";  
}

/// 2. Associar e desassociar receitas a categorias (relação muitos-para-muitos)
//////////////////////////////////////////////////////////////////////////////////////////////

   function associarReceitaCategorias($conexao) {
    // Listar receitas
    $sql = "SELECT id, nome, tempo_preparo FROM Receita";
    $resultado = mysqli_query($conexao, $sql);
    echo "----- Receitas ------\n\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . " | Tempo de preparação: " . $linha["tempo_preparo"] . "\n";
    }
    echo "\n";
    $idreceita = readline("insira o ID da receita: \n");
    // Mostrar categorias já associadas à receita escolhida
    
    echo "----- categorias associadas à ID ------\n";
    $sql = "SELECT Categoria.id_categoria, Categoria.nome 
            FROM Categoria
            INNER JOIN receita_categoria 
            ON receita_categoria.id_categoria = Categoria.id_categoria
            WHERE receita_categoria.id_receita = $idreceita";
    $resultado = mysqli_query($conexao, $sql);

if ($linha = mysqli_fetch_assoc($resultado)) {
    do {
        echo "ID: " . $linha["id_categoria"] . " | Nome: " . $linha["nome"] . "\n";
    } while ($linha = mysqli_fetch_assoc($resultado));
} else {
    echo "semcategoria associada \n";
}
echo "\n";

    // Listar as categorias
    $sql = "SELECT id_categoria, nome FROM Categoria";
    $resultado = mysqli_query($conexao, $sql);
    echo "----- Todas as categorias ------\n\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id_categoria"] . " | Nome: " . $linha["nome"] . "\n";
    }
    echo "\n";

    
    // Inserir novas associações
    $idcategoria = readline(" ID da categoria para associar (se for mais que uma, separar por vírgula): ");
    $categorias = explode(",", $idcategoria);


  foreach ($categorias as $associarRaC) {
    
            if ($associarRaC > 0) {
                $sql_assoc = "INSERT INTO receita_categoria (id_receita, id_categoria) VALUES ($idreceita, $associarRaC)";
                if (mysqli_query($conexao, $sql_assoc)) {
                    echo "receita associado a categoria com sucesso\n";
                }  else {
                echo "Erro a associar\n";
             }
            
            }
        }
       echo "\n\n"; 
    }


    

    // desassociar
function desassociarReceitaCategorias($conexao){
    // receitas
    $sql = "SELECT id, nome, tempo_preparo FROM Receita";
    $resultado = mysqli_query($conexao, $sql);
    echo "----- receitas ------\n\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . " | Tempo de preparo: " . $linha["tempo_preparo"] . "\n";
    }
    echo "\n";

    $id_receita = readline("Insira o ID da receita: ");

    //  categorias associadas a receita
    $sql = "SELECT Categoria.id_categoria, Categoria.nome 
            FROM Categoria
            INNER JOIN receita_categoria 
            ON receita_categoria.id_categoria = Categoria.id_categoria
            WHERE receita_categoria.id_receita = $id_receita";
    $resultado = mysqli_query($conexao, $sql);

    echo "----- Categorias associadas ------\n\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id_categoria"] . " | Nome: " . $linha["nome"] . "\n";
    }
    echo "\n";


    // categorias para desassociar
    $categoria = readline(" ID da categoria ou categorias para desassociar (separados por vírgula): ");
    $categorias = explode(",", $categoria);


    foreach ($categorias as $categoriaId) {
        if ($categoriaId > 0) {
            $sql_desassoc = "DELETE FROM receita_categoria 
                             WHERE id_receita = $id_receita 
                             AND id_categoria = $categoriaId";
            if (mysqli_query($conexao, $sql_desassoc)) {
                echo "receita desassociada da categoria \n";
            } else {
                echo "erro ao desassociar receita : \n";
            }
        } else {
            echo "erro no ID da categoria \n";
        }
    }
}




// 3. Consultar receitas filtradas por categoria
// listar as categorias
function Consultar_receitas ($conexao){
    echo "\n\n---> escolher a Categoria : \n" ;
    echo "---------------------------------\n";

    $sql = "SELECT id_categoria, nome FROM Categoria";
    $resultado = mysqli_query ($conexao,$sql);

    if (!$resultado){
        echo "erro na consulta!\n";
    }

    while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id_categoria"] . " | Nome: " . $linha["nome"] . "\n";
        
}
    $id_categoria = readline ("ID categoria : ");
    echo "\n\n";
    $sql_receitas = "SELECT id_receita, nome
                     FROM Receita 
                     INNER JOIN receita_categoria
                     ON Receita.id = receita_categoria.id_receita
                     WHERE receita_categoria.id_categoria = $id_categoria" ;
    $receitas = mysqli_query ($conexao,$sql_receitas);

    echo "---> receitas : \n" ;
    while ($linha =mysqli_fetch_assoc ($receitas)){
        echo "ID:" . $linha["id_receita"] . " | Nome: " . $linha["nome"] . "\n";
       
    }
echo "--------------------------------------------\n";
echo "\n\n";

}


//fechar conexão
mysqli_close($conexao);