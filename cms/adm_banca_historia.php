<?php
    session_start();

    $logado = $_SESSION['login'];  

    require_once('conexao.php');

    $conexao = conexaoDB();

    $botao = "Enviar";
    

    if(isset($_POST["btnEnviar"])){
       $historia = $_POST["txthistoria"];

        
        //Inserindo o conteudo no banco
        if($_POST["btnEnviar"] == "Enviar"){
            
            //Upload de imagem
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
                    $sql = "INSERT INTO tbl_historia_banca
                    
                    (historia, foto_banca) 
                    
                    VALUES ('".$historia."','".$foto."')
                    
                    ";
                     
                     mysqli_query($conexao, $sql);
                     header('location:adm_banca_historia.php');
                
                
            }else{
                echo("Não foi possivel meu bb, tente novamente nesse codigo seu merda");
            }
                 
                }else{
                 echo("Tamanho de arquivo inválido meu consagrado");
                 
                }
            } else{
                 echo("Extensão inválida");            
             }
        
        } else if($_POST["btnEnviar"] == "Editar"){
            
            //Editando os conteudo já cadastrados
            if($_FILES["fileimagem"]["name"] == ""){
                
                //Editando sem a imagem
                $sql = "UPDATE tbl_historia_banca SET
                    historia = '".$historia."'
            
                WHERE id=".$_SESSION['id'];
                 
                
            }else{
                
                //Editando com a imagem
                            
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
                   
                            $sql = "UPDATE tbl_historia_banca SET

                            historia='".$historia."',
                            foto_banca='".$foto."'

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
            header('location:adm_banca_historia.php');          
        
        }
        
    }
            


//Ação dos icones da tabela

    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];
        
        //Excluir
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_historia_banca WHERE id=".$codigo;
            
            mysqli_query($conexao, $sql);
            header('location:adm_banca_historia.php');
            
        } else if($modo =='buscar'){
            
            //Editar
            $botao = 'Editar';
            $codigo = $_GET['id'];
            
            $_SESSION['id'] = $codigo;
            
            $sql = "SELECT * FROM tbl_historia_banca where id=".$codigo;
            
            $select = mysqli_query($conexao,$sql);
            
            
            if($rsBanca = mysqli_fetch_array($select)){
                $historia = $rsBanca['historia'];
               
            }
            
            
            //Icones de ativar e desativar conteudo do site
        }else if ($modo == 'ativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_historia_banca SET
                status = 1 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_banca_historia.php');
                
            echo($sql);
            

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_historia_banca SET
                status = 0 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_banca_historia.php');
                

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
                            <img src="imagens/produtos.png" alt="Adm Conteudo">
                        </div>

                        <div class="adm_conteudo">
                            <a href="adm_usuarios.php">
                                <img src="imagens/usuarios.jpg" alt="Adm usuarios">
                            </a>
                        </div>
                        
                        
<!--                        Area de bem vindo com o nome do usuario-->
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
                    
<!--                    Cadastro sobre a historia da banca-->
                    <div class="title_banca">
                        <h3> Informações sobre a banca </h3>
                    </div>
                            
                    
                    <div class="conteudos_niveis">
<!--                        Tabela para carregar os registrios-->
                         <div class="consulta_campo_banca_historia">
                                Historia
                            </div>
                                        
                        
                            <div class="consulta_campo_banca_historia">
                            
                            </div>
                        
                        <div class="campo_carregar_historia">
                            <?php
                            $sql = "SELECT * FROM tbl_historia_banca";
                            $select = mysqli_query($conexao, $sql);
                        
                            while($rsBanca = mysqli_fetch_array($select)){
                            ?>
                            <div class="info_historia">
                                <?php echo($rsBanca["historia"])?>
                            </div>
                            
                            <div class="info_historia">
<!--                                Icones da tabela-->
                                  <a href="adm_banca_historia.php?modo=excluir&id=<?php echo($rsBanca['id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                                
                                 <a href="adm_banca_historia.php?modo=buscar&id=<?php echo($rsBanca['id'])?>">
                                  <img src="imagens/editar.png" >
                                </a>
                                
                                <?php
                                    if($rsBanca['status'] == 1){?>
                                      
                                    <a href="adm_banca_historia.php?modo=desativar&id=<?php echo($rsBanca['id'])?>">
                                        <img src="imagens/ativar.png">
                                    </a>
                                    <?php }else{ ?>
                                        <a href="adm_banca_historia.php?modo=ativar&id=<?php  echo($rsBanca['id'])?>">
                                            <img src="imagens/desativar.png">
                                        </a>
                                    
                                   <?php } ?>
                                   

                            </div>
                            <?php
                            }
                            ?>    
                        </div>
                    </div>
                    
                    
<!--                    Formulario de cadastro-->
                    <form name="frmBanca" method="post" action="adm_banca_historia.php" enctype="multipart/form-data">
                    
                    <div class="cadastrar_noticia">
                        <div class="cadastrar_noticia"> 
                            
                            <div class="caixas_cadastro">
                                    <label> Historia:</label>
                                <p> <textarea cols="34" rows="13" name="txthistoria"  required><?php echo(@$historia)?></textarea></p>
                            </div> 
                            
                            <div class="caixa_foto">
                                 <label> Foto da banca: </label>
                                <p>
                                    <input type="file" name="fileimagem">
                                </p>
                            </div>
                          
                        </div>
                        
                        
                        <div class="caixa_botao">
                              <input class="btnbanca_historia" type="submit" value="<?php echo($botao);?>" name="btnEnviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>