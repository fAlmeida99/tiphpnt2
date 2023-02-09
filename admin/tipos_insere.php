<?php 
    include 'acesso_com.php';
    include '../conn/connect.php';

    if($_POST){
        
        $id_tipo = $_POST['id_tipo'];
        $rotulo_tipo = $_POST['rotulo_tipo'];
        $sigla_tipo = $_POST['sigla_tipo'];
               $insereProd = "INSERT INTO tbprodutos
                        (id_tipo_produto, destaque_produto, descri_produto, resumo_produto, valor_produto, imagem_produto)
                        VALUES
                        ('$id_tipo','$rotulo_tipo','',' $sigla_tipo');
                        ";
        $resultado = $conn->query($insereProd);
       
    } 
    // após a gravação bem sucedida do produto, volta (atualiza) lista
        if(mysqli_insert_id($conn)){
            header('location: produtos_lista.php');
        }
        // selecionar os dados de chave estrangeira (lista de tipos de produtos)
        $consulta_fk = "select * from tbtipos order by rotulo_tipo asc";
        $lista_fk = $conn->query($consulta_fk);
        $row_fk = $lista_fk->fetch_assoc();
        $nlinhas = $lista_fk->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Document</title>
</head>
<body>
    <?php include "menu_adm.php"?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6 col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="tipos_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo tipos
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="produtos_insere.php" method="post" name="form_produto_insere" enctype="multipart/form-data" id="form_produto_insere">
                        <label for="descri_produto">Rótulo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="descri_produto" id="descri_produto" class="form-control" placeholder="Digite o rótulo do Produto" maxlength="100" required>
                            
                               
                            </div>
                            <label for="descri_produto">Tipo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="descri_produto" id="descri_produto" class="form-control" placeholder="Digite o rótulo do Produto" maxlength="100" required>
                            
                               
                            </div>
                            <hr>
                            <input type="submit" id="enviar" name="enviar" value="Cadastrar" class="btn btn-danger btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main> -->

<!-- script para imagem -->
<script>
    document.getElementById("imagem_produto").onchange = function(){
        var reader = new FileReader();
        if(this.files[0].size>1024000){
            alert("A imagem deve ter no maximo 1MB");
            $("#imagem").attr("src","blank");
            $("#imagem").hide();
            $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
            $("#imagem_produto").unwrap();
            return false
        }
        if(this.files[0].type.indexOf("image")==-1){
            alert("formato inválido, escolha uma imagem");
            $("#imagem").attr("src","blank");
            $("#imagem").hide();
            $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
            $("#imagem_produto").unwrap();
            return false
        }
        reader.onload = function(e){
            document.getElementById("imagem").src = e.target.result
            $("#imagem").show();
        }
        reader.readAsDataURL(this.files[0]);
    }
</script>

</body>
</html>
