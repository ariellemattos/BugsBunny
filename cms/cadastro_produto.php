<?php
    require_once('conexao.php');

    session_start();

    $conexao = conexaoDB();


    $logado = $_SESSION['login'];

    $botao = "Enviar";


    if(isset($_POST['btnEnviar'])){
        $titulo = $_POST["txttitulo"];
        $descricao = $_POST["txtdescricao"];
        $preco = $_POST["txtpreco"];
        $sub_id = $_POST["selectSUB"];
        $categoria_id = $_POST["selectCAT"];

        if($_POST['btnEnviar'] == "Enviar"){
            $arquivo = $_FILES["fileimagem"]["name"];
            $tamanho_arquivo = $_FILES["fileimagem"]["size"];
            $tamanho_arquivo = round($tamanho_arquivo/1024);
            $ext_arquivo = strrchr($arquivo, ".");

            $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
            $nome_arquivo = md5(uniqid(time().$nome_arquivo));
            $diretorio_arquivo = "upload_imagens/";
            $arquivos_permitidos = array(".jpg", ".png", ".jpeg");

            if(in_array($ext_arquivo, $arquivos_permitidos)){
                if($tamanho_arquivo <= 4000){

                 $arquivo_tmp = $_FILES['fileimagem']['tmp_name'];

                 $foto = $diretorio_arquivo.$nome_arquivo.$ext_arquivo;

                if(move_uploaded_file($arquivo_tmp, $foto)){
                    $sql = "INSERT INTO tbl_produtos
                        (titulo, descricao, preco, imagem, sub_id)

                        VALUES ('".$titulo."', '".$descricao."', '".$preco."', '".$foto."',".$sub_id." )

                    ";

                     mysqli_query($conexao, $sql);
//                    echo($sql);

                     header('location:cadastro_produto.php');

                    }else{
                        echo("Não foi possivel meu bb, tente novamente nesse codigo seu merda");
                    }

                    }else{
                        echo("Tamanho de arquivo inválido meu consagrado");

                    }

                } else{
                 echo("Extensão inválida");
                }
            }else if($_POST['btnEnviar'] == "Editar"){
                 //Editando os conteudo já cadastrados
                 if($_FILES["fileimagem"]["name"] == ""){
                     //Editando sem a imagem
                    $sql = "UPDATE tbl_produtos SET
                        titulo = '".$titulo."',
                        descricao = '".$descricao."',
                        preco = '".$preco."',
                        sub_id = '".$sub_id."'

                        WHERE id=".$_SESSION['id'];

                     } else {
                        $arquivo = $_FILES["fileimagem"]["name"];
                        $tamanho_arquivo = $_FILES["fileimagem"]["size"];
                        $tamanho_arquivo = round($tamanho_arquivo/1024);
                        $ext_arquivo = strrchr($arquivo, ".");

                        $nome_arquivo = pathinfo($arquivo, PATHINFO_FILENAME);
                        $nome_arquivo = md5(uniqid(time().$nome_arquivo));
                        $diretorio_arquivo = "upload_imagens/";
                        $arquivos_permitidos = array(".jpg", ".png", ".jpeg");

                        if(in_array($ext_arquivo, $arquivos_permitidos)){
                            if($tamanho_arquivo <= 4000){

                             $arquivo_tmp = $_FILES['fileimagem']['tmp_name'];

                             $foto = $diretorio_arquivo.$nome_arquivo.$ext_arquivo;

                            if(move_uploaded_file($arquivo_tmp, $foto)){
                                $sql = "UPDATE tbl_produtos SET
                                        titulo = '".$titulo."',
                                        descricao = '".$descricao."',
                                        preco = '".$preco."',
                                        imagem = '".$foto."',
                                        sub_id = '".$sub_id."'

                                        WHERE id=".$_SESSION['id'];

                             }else{
                            echo("Não foi possivel");
                        }

                    }else{
                        echo("Tamanho de arquivo inválido ");

                    }

                } else{
                echo("Extensão inválida");
                }
            }

            mysqli_query($conexao, $sql);
            header('location:cadastro_produto.php');


            }
        }

    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];

        //Excluir
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_produtos WHERE id=".$codigo;

            mysqli_query($conexao, $sql);
            header('location:cadastro_produto.php');

        } else if($modo == 'buscar'){
            $botao = 'Editar';
            $codigo = $_GET['id'];

             $_SESSION['id'] = $codigo;

            $sql = "SELECT tbl_produtos.*, tbl_categoria_sub.sub_name FROM tbl_produtos, tbl_categoria_sub WHERE tbl_produtos.sub_id = tbl_categoria_sub.sub_id and id=".$codigo;

            $select = mysqli_query($conexao,$sql);

            if($rsProduto = mysqli_fetch_array($select)){
                $titulo = $rsProduto['titulo'];
                $descricao = $rsProduto['descricao'];
                $preco = $rsProduto['preco'];
                $sub_id = $rsProduto['sub_id'];
                $subname = $rsProduto['sub_name'];



            }

        }else  if($modo == 'ativar'){
            $codigo = $_GET['id'];

            $_SESSION['id'] = $codigo;

             $sql = "UPDATE tbl_produtos SET
                status = 1 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);

            header('location:cadastro_produto.php');

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];

	       $_SESSION['id'] = $codigo;

             $sql = "UPDATE tbl_produtos SET
                status = 0 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:cadastro_produto.php');

        }
    }






?>

<!DOCTYPE html>
<html>
    <head>
       <link rel = "stylesheet" type="text/css" href="css/style.css">
        <title> CMS - Sistema de gerenciamento do site </title>
    </head>

    <body>

<!--        Caixa principal-->
        <div class="principal">
            <div class="cms">
                <header>
                    <div class="cabecalho">
                        <div class="title">
                            <strong> CMS - Sistema de Gerenciamento do Site</strong>
                        </div>

                        <div class="logo"> </div>
                    </div>
                </header>

                <nav>
<!--                    Icones de navegacao-->
                    <div class="icones">
                        <div class="adm_conteudo">
                            <a href="adm_conteudo.php">
                                <img src="imagens/conteudo.png" alt="Adm conteudo">
                            </a>
                        </div>


                        <div class="adm_conteudo">
                            <a href="cmsfale_conosco.php">
                                <img src="imagens/fale_conosco.png" alt="Adm Fale Conosco" >
                            </a>
                        </div>

                        <div class="adm_conteudo">
                            <a href="adm_produtos.php">
                                <img src="imagens/produtos.png" alt="Adm Conteudo">
                            </a>
                        </div>

                        <div class="adm_conteudo">
                            <a href="adm_usuarios.php">
                                <img src="imagens/usuarios.jpg" alt="Adm usuarios">
                            </a>
                        </div>

<!--                        Caixa de bem vindo com o nome do usuario-->
                        <div class="usuarios">
                          <?php
                            echo" Bem vindo $logado";
                           ?>
                        </div>
                    </div>

                    <div class="adm_titulo">
                        <div class="esp_conteudo">
                            Adm Conteudo
                        </div>


                        <div class="esp_conteudo">
                            Adm Fale Conosco
                        </div>

                        <div class="esp_conteudo">
                            Adm Produtos
                        </div>

                        <div class="esp_conteudo">
                            Adm Usuarios
                        </div>

                        <div class="sair">

                            <?php
                                echo '<a href="logout.php?token='.md5(session_id()).'">Logout</a>';
                            ?>
                        </div>
                    </div>
                </nav>

                <div class="admins">
                     <div class="cadastro_produtos">
                            <form name="frmProdutos" method="post" action="cadastro_produto.php" enctype="multipart/form-data">
                                <div class="area_cadastro_produto">
                                   <label> Titulo: </label>
                                    <p> <input type="text" name="txttitulo" value="<?php echo(@$titulo)?>"></p>

                                    <label> Descrição: </label>
                                    <p> <textarea cols="40" rows="5" name="txtdescricao" required><?php echo(@$descricao)?></textarea></p>

                                     <label> Preço: </label>
                                    <p> <input type="text" name="txtpreco" value="<?php echo(@$preco)?>"></p>

                                     <label> Subcategoria: </label>

                                        <select class="option" name="selectSUB" required>
                                           <?php
                                            if($modo == "buscar"){
                                            ?>
                                                 <option value="<?php echo($sub_id)?>"> <?php echo($subname)?> </option>

                                            <?php
                                            }
                                            else{
                                            ?>

                                            <option> Selecione um nivel </option>

                                            <?php
                                                $sub_id = 0;
                                            }
                                            ?>


                                            <?php
                                            $sql = "select * from tbl_categoria_sub where sub_id <>".$sub_id;

                                             $select = mysqli_query($conexao, $sql);


                                            while($rsProduto = mysqli_fetch_array($select))
                                            {
                                            ?>
                                            <option value="<?php echo($rsProduto['sub_id'])?>"> <?php echo($rsProduto['sub_name'])?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    <br>

                                    <label> Imagem do produto: </label>
                                    <p>
                                        <input type="file" name="fileimagem">
                                    </p>

                                <!-- <input type="submit" name="btnEnviar" value="<?php echo($botao)?>"> -->
                                </div>
                        </div>

                        <div class="cadastro_produtos">
                        <!--   Tabela com os registros-->
                        <div class="conteudos_menu">
                            <div class="consulta_campo_menu">
                                Menu
                            </div>

                            <div class="consulta_campo_menu">
                                Mais
                            </div>

                            <?php
                            $sql = "SELECT * from tbl_produtos";


                            $select = mysqli_query($conexao, $sql);


                            while($rsProduto = mysqli_fetch_array($select))
                            {

                        ?>


                        <div class="campo_carregar_menu">
                            <div class="info_menu">
                                <?php echo($rsProduto["titulo"])?>
                            </div>


<!--                              Icones da tabela-->
                            <div class="info_menu">
                                <a href="cadastro_produto.php?modo=excluir&id=<?php echo($rsProduto['id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>

                                <a href="cadastro_produto.php?modo=buscar&id=<?php echo($rsProduto['id'])?>">
                                  <img src="imagens/editar.png" >
                                </a>

                                <?php
                                    if($rsProduto['status'] == 1){?>

                                    <a href="cadastro_produto.php?modo=desativar&id=<?php echo($rsProduto['id'])?>">
                                        <img src="imagens/ativar.png">
                                    </a>
                                    <?php }else{ ?>
                                        <a href="cadastro_produto.php?modo=ativar&id=<?php  echo($rsProduto['id'])?>">
                                            <img src="imagens/desativar.png">
                                        </a>

                                   <?php } ?>
                            </div>

                        </div>
                        <?php
                            }
                        ?>
                            <input type="submit" name="btnEnviar" value="<?php echo($botao)?>">
                        </form>

                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
