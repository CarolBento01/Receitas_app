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
    echo "---------- fase 6 -------------\n";
    echo "(10) -> Adicionar ingredientes\n";
    echo "(11) -> Listar ingredientes\n";
    echo "(12) -> Associar ingredientes a receitas com quantidade e unidade\n";
    echo "(13) -> Atualizar quantidade/unidade de ingredientes de uma receita \n";
    echo "(14) -> Remover ingredientes de uma receita \n";
    echo "(15) -> Mostrar os ingredientes e quantidades  de uma receita \n";
    echo "---------- fase 7 -------------\n";
    echo "(16) -> Dado um -NOME- ou -ID- de categoria, listar todas as receitas associadas\n";
    echo "(17) -> Listar todas as receitas que contenham um determinado ingrediente\n";
    echo "(18) -> Ver todos os detalhes de uma receita\n";
    echo "(19) -> Pesquisar receitas por parte do título \n";

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
    case 10: 
        adicionar_ingredientes($conexao);
        break;
    case 11: 
        listar_ingredientes($conexao);
        break;
    case 12: 
        associaringredientesareceitas($conexao);
        break;
    case 13: 
        atualizar_ingredientes($conexao);
        break;
    case 14: 
        removeringredientes($conexao);
        break;
    case 15: 
        mostrarreceitascomdetalhe($conexao);
        break;
    case 16: 
        DadoumnomeouID($conexao);
        break;
    case 17: 
        Listarreceitasporingrediente($conexao);
        break;
    case 18: 
        mostrarreceitascomtodoodetalhe($conexao);
        break;
    case 19: 
        pesquisarreceitas($conexao);
        break;    
    default:
        echo "Opção inválida!";
        exit;
    }
}

////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////// FASE 4.   ///////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

//--------------------------
//1. Criar receitas
//--------------------------
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

//--------------------------
// 2. Listar todas as receitas
//--------------------------
function listarreceitas($conexao){
    $sql = "SELECT id, nome, descricao, tempo_preparo, doses FROM Receita";
    $resultado = mysqli_query ($conexao,$sql);

    while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id"] . " | Nome: " . $linha["nome"] . " |". "\n| Descrição: " . $linha["descricao"] . "\n| Tempo de preparação: " . $linha["tempo_preparo"] . " | Doses: " . $linha["doses"] . "\n";
        echo "--------------------------------------------\n";
}
}
//--------------------------
//3. atualizar as receitas
//--------------------------

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
//--------------------------
//4. apagar as reeitas
//--------------------------
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

//--------------------------
// 1. Criar e listar categorias
//--------------------------
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
//--------------------------
// 2. Associar e desassociar receitas a categorias (relação muitos-para-muitos)
//--------------------------
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


    
//--------------------------
// desassociar
//--------------------------
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



//--------------------------
// 3. Consultar receitas filtradas por categoria
//--------------------------
// listar  categorias

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
    //receita
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

////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////// FASE 6.   ///////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

//--------------------------
// Adicionar INGREDIENTE
//--------------------------
function adicionar_ingredientes($conexao){   
    $nomeingrediente = readline("Nome do ingrediente: ");
    // inserir os dados
    $sql = "INSERT INTO ingrediente (nome) 
            VALUES ('$nomeingrediente') "; 
    
        if (mysqli_query($conexao, $sql)) {
        echo "ingrediente inserido com sucesso\n";
        } else {
        echo "Erro a inserir\n";
        }
    echo "\n\n";
}


//--------------------------
// listar INGREDIENTEs
//--------------------------

function listar_ingredientes($conexao){

 $sql = "SELECT id, nome FROM ingrediente";
    $resultado = mysqli_query ($conexao,$sql);
    while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id"] . " | Nome: ". $linha ["nome"] . "\n";   
    }
echo "\n\n";
}

//--------------------------
// assoiar INGREDIENTEs
//--------------------------
function associaringredientesareceitas($conexao){
      // receita
    $sql = "SELECT id, nome FROM receita";
    $resultado = mysqli_query($conexao, $sql);
    echo "----- lista de receita ------\n\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
    }
    echo "\n";

    $id_receita = readline("Insira o ID da receita : ");


     // ingrediente
    $sql = "SELECT id, nome FROM ingrediente";
    $resultado = mysqli_query($conexao, $sql);
    echo "----- lista de ingredientes ------\n\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
    }
    echo "\n";

    $id_ingrediente = readline("Insira 1 ou mais ID de ingrediente : ");
    $lista_ids_ings = explode(",", $id_ingrediente);


    foreach ($lista_ids_ings as $id_ingrediente) {
        $quantidade = readline ("quantidade : ");
        $unidade = readline ("unidade de medida: ");

        if ($id_ingrediente > 0){
        $sql = "INSERT INTO receita_ingrediente (id_receita, id_ingrediente, quantidade, unidade_medida) 
            VALUES ('$id_receita', '$id_ingrediente','$quantidade','$unidade')";
        if (mysqli_query($conexao, $sql)) {
        echo "Ingrediente associado à receita \n";
    } else {
        echo "Erro ao associar " ;
    }
    }
    }
      echo "\n";

}
//--------------------------
// atualizar INGREDIENTEs
//--------------------------

function atualizar_ingredientes($conexao){
    //listar as receitas para entender quais ingredientes de cada receita a alterar
      

$sql = "SELECT id, nome FROM Receita";
    $resultado = mysqli_query ($conexao,$sql);

    while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
}


$id_receita = readline("insira o ID da receita: ");
      $sql = "
         SELECT ingrediente.id AS id_ingrediente, 
               ingrediente.nome AS nome_ingrediente, 
            receita_ingrediente.quantidade, 
            receita_ingrediente.unidade_medida
            FROM receita_ingrediente receita_ingrediente
            JOIN ingrediente ingrediente ON receita_ingrediente.id_Ingrediente = ingrediente.id
            WHERE receita_ingrediente.id_receita = $id_receita";

$resultado = mysqli_query($conexao, $sql);

    echo "\n -------Ingredientes da receita:------\n";
    $tem_ingredientes = false;
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $tem_ingredientes = true;
        echo "ID: " . $linha["id_ingrediente"] .
             " | Nome: " . $linha["nome_ingrediente"] .
             " | Quantidade: " . $linha["quantidade"] .
             " | Unidade: " . $linha["unidade_medida"] . "\n";
    }

    if (!$tem_ingredientes) {
        echo " sem ingredientes associados.\n";

    }  
$id_ingredientes =readline ("ID ingrediente a alterar : ");

$novaquantidade = readline ("nova quantidade: ");
$novounidade = readline ("nova unidade de medida: ");

//atualizar a base de dados 
$sql = "UPDATE receita_ingrediente 
        SET quantidade = '$novaquantidade', unidade_medida = '$novounidade' 
        WHERE id_receita = $id_receita AND id_ingrediente = $id_ingredientes";
       
echo "\n\n";
if ( mysqli_query ($conexao,$sql)){
     echo "alterado\n";

    } else {
     echo "erro ao atualizar";
    }
    echo "\n\n";
}
//--------------------------
// remover INGREDIENTEs
//--------------------------

function removeringredientes($conexao){

$sql = "SELECT id, nome FROM Receita";
    $resultado = mysqli_query ($conexao,$sql);

    while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
}


$id_receita = readline("insira o ID da receita: ");
      $sql = "
        SELECT ingrediente.id AS id_ingrediente, 
               ingrediente.nome AS nome_ingrediente, 
            receita_ingrediente.quantidade, 
            receita_ingrediente.unidade_medida
            FROM receita_ingrediente receita_ingrediente
            JOIN ingrediente ingrediente ON receita_ingrediente.id_Ingrediente = ingrediente.id
            WHERE receita_ingrediente.id_receita = $id_receita";

$resultado = mysqli_query($conexao, $sql);

    echo "\n -------Ingredientes :------\n";
    $tem_ingredientes = false;
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $tem_ingredientes = true;
        echo "ID: " . $linha["id_ingrediente"] .
             " | Nome: " . $linha["nome_ingrediente"] .
             " | Quantidade: " . $linha["quantidade"] .
             " | Unidade: " . $linha["unidade_medida"] . "\n";
    }


 if (!$tem_ingredientes) {
        echo " sem ingredientes associados.\n";
        
    }

    $id_ingrediente = readline("ID do ingrediente a remover: ");
     echo"\n";
    $sql = "
        DELETE FROM receita_ingrediente 
        WHERE id_receita = $id_receita AND id_ingrediente = $id_ingrediente
    ";

    if (mysqli_query($conexao, $sql)) {
        echo " removido \n";
    } else {
        echo "Erro ao remover ";
    }
    echo"\n\n";
}
//--------------------------
// mostrarreceitascomdetalhe
//--------------------------

function mostrarreceitascomdetalhe($conexao){

    //receitas 
    $sql = "SELECT id, nome FROM Receita";
    $resultado = mysqli_query($conexao, $sql);

    echo "\n--- Receitas ---\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
    }

    // Escolher receita
    $id_receita = readline(" ID da receita a mostrar: ");

    
    //  ingredientes
    $sql_ingredientes = "
       SELECT ingrediente.nome as nome_ingrediente, receita_ingrediente.quantidade, receita_ingrediente.unidade_medida
       FROM receita_ingrediente
       JOIN ingrediente ON receita_ingrediente.id_ingrediente = ingrediente.id
       WHERE receita_ingrediente.id_receita = $id_receita";

    $resultado_ingredientes = mysqli_query($conexao, $sql_ingredientes);

    echo "\n--- Ingredientes ---\n";
    $tem_ingredientes = false;
    while ($ingrediente = mysqli_fetch_assoc($resultado_ingredientes)) {
        $tem_ingredientes = true;
        echo "- " . $ingrediente["nome_ingrediente"] . " -> " . $ingrediente["quantidade"] . " " . $ingrediente["unidade_medida"] . "\n";
    }

    if (!$tem_ingredientes) {
        echo "Sem ingredientes\n";
    }

    echo "---------------------------\n\n";

}





////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////// FASE 7.   ///////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

//--------------------------
//Listar todas as receitas de uma determinada categoria
//--------------------------

function  DadoumnomeouID($conexao){

 echo "\n\n---> escolher a Categoria : \n" ;
    echo "---------------------------------\n";

    $sql = "SELECT id_categoria, nome FROM Categoria";
    $resultado = mysqli_query ($conexao,$sql);

    if (!$resultado){
        echo "erro na consulta!\n";
    } while ($linha = mysqli_fetch_assoc($resultado)){
        echo "ID:" . $linha["id_categoria"] . " | Nome: " . $linha["nome"] . "\n";
    
    }

    //receita
    $categoria = readline ("-ID- OU -NOME- da categoria : ");
    echo "\n\n";
    
    if (is_numeric($categoria)) {
        $condicao = "categoria.id_categoria = $categoria";
    } else {
        $condicao = "categoria.nome LIKE '%$categoria%' " ;
    }
      $sql_receitas = "
        SELECT Receita.id AS id_receita, Receita.nome
        FROM Receita
        INNER JOIN receita_categoria ON Receita.id = receita_categoria.id_receita
        INNER JOIN Categoria ON receita_categoria.id_categoria = Categoria.id_categoria
        WHERE $condicao";

    $receitas = mysqli_query ($conexao,$sql_receitas);

    echo "---> receitas : \n" ;
   $tem = false;
    while ($linha = mysqli_fetch_assoc($receitas)) {
        echo "ID: " . $linha["id_receita"] . " | Nome: " . $linha["nome"] . "\n";
        $tem = true;
    }

    if (!$tem) {
        echo "Nenhuma receita encontrada";
        }
echo "--------------------------------------------\n";
echo "\n\n";
}







//--------------------------
//Listar todas as receitas que contenham um determinado ingrediente
//--------------------------

function Listarreceitasporingrediente($conexao) {
    // ingredientes 
    $sql = "SELECT id, nome FROM Ingrediente";

    $resultado = mysqli_query($conexao, $sql);

    echo "\n--- Ingredientes ---\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
    }

    $id_ingrediente = readline("ID do ingrediente: ");
    // puxar receita
    $sql = "
        SELECT receita.id, receita.nome, receita.descricao
        FROM Receita receita
        JOIN receita_ingrediente receita_ingrediente 
        ON receita.id = receita_ingrediente.id_receita
        WHERE receita_ingrediente.id_ingrediente = $id_ingrediente
    ";

    $resultado = mysqli_query($conexao, $sql);

    echo "\n--- receitas que estão associadas ao ingrediente ---\n";
    $tem_receitas = false;
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $tem_receitas = true;
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . " | Descrição: " . $linha["descricao"] . "\n";
    }

    if (!$tem_receitas) {
        echo "não tem receita com esse ingrediente.\n";
    }
}

//--------------------------
//mostrar as receitas com todos os detalhes
//--------------------------


function mostrarreceitascomtodoodetalhe($conexao){
    //receitas 
    $sql = "SELECT id, nome FROM Receita";
    $resultado = mysqli_query($conexao, $sql);

    echo "\n--- Receitas ---\n";
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
    }

    // Escolher receita
    $id_receita = readline(" ID da receita a mostrar: ");

    // ver detalhes
    $sql_receita = "
        SELECT nome, descricao, tempo_preparo, doses
        FROM Receita
        WHERE id = $id_receita
    ";

    $resultado_receita = mysqli_query($conexao, $sql_receita);
    $receita = mysqli_fetch_assoc($resultado_receita);

    if (!$receita) {
        echo "receita não encontrada.\n";
       
    }

    echo "\n--- Receita ---\n";
    echo "Nome: " . $receita["nome"] . "\n";
    echo "Descrição: " . $receita["descricao"] . "\n";  
    echo "Tempo de preparo: " . $receita["tempo_preparo"] . " minutos\n";
    echo "Doses: " . $receita["doses"] . "\n"; 

    //  ingredientes
    $sql_ingredientes = "
       SELECT ingrediente.nome as nome_ingrediente, receita_ingrediente.quantidade, receita_ingrediente.unidade_medida
       FROM receita_ingrediente
       JOIN ingrediente ON receita_ingrediente.id_ingrediente = ingrediente.id
       WHERE receita_ingrediente.id_receita = $id_receita";

    $resultado_ingredientes = mysqli_query($conexao, $sql_ingredientes);

    echo "\n--- Ingredientes ---\n";
    $tem_ingredientes = false;
    while ($ingrediente = mysqli_fetch_assoc($resultado_ingredientes)) {
        $tem_ingredientes = true;
        echo "- " . $ingrediente["nome_ingrediente"] . " -> " . $ingrediente["quantidade"] . " " . $ingrediente["unidade_medida"] . "\n";
    }

    if (!$tem_ingredientes) {
        echo "Sem ingredientes\n";
    }

    echo "---------------------------\n\n";

}

//--------------------------
//pesquisar receitas 
//--------------------------
function pesquisarreceitas($conexao){
    $quecontenha = readline("procurar receitas que contenha no nome : ");

    $sql = "SELECT id, nome FROM Receita WHERE nome LIKE '%$quecontenha%'";
    $resultado = mysqli_query($conexao, $sql);

    echo "\n--- Receitas Encontradas ---\n";
    $encontradas = false;

    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "ID: " . $linha["id"] . " | Nome: " . $linha["nome"] . "\n";
        $encontradas = true;
    }

    if (!$encontradas) {
        echo " não encontrou receita \n";
    }
echo "\n\n";
}








//fechar conexão
mysqli_close($conexao);