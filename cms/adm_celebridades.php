<?php
    require_once('conexao.php');

    session_start();

    $logado = $_SESSION['login']; 

    $conexao = conexaoDB();

    $botao = "Enviar";

    if(isset($_POST["btnEnviar"])){
        
//Inserindo o conteudo no banco
        $resumo =  $_POST["txtresumo"]; 
        
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
                if($tamanho_arquivo <= 2000){
                 
                 $arquivo_tmp = $_FILES['fileimagem']['tmp_name'];
                 
                 $foto = $diretorio_arquivo.$nome_arquivo.$ext_arquivo;
                
                if(move_uploaded_file($arquivo_tmp, $foto)){
                    $sql = "INSERT INTO tbl_celebridades
                    
                    (resumo, foto) 
                    
                    VALUES ('".$resumo."','".$foto."')
                    
                    ";
                     
                     mysqli_query($conexao, $sql);

                     header('location:adm_celebridades.php');
                
                
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
                $sql = "UPDATE tbl_celebridades SET
                resumo='".$resumo."'
    
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
                    if($tamanho_arquivo <= 2000){
                 
                        $arquivo_tmp = $_FILES['fileimagem']['tmp_name'];
                 
                        $foto = $diretorio_arquivo.$nome_arquivo.$ext_arquivo;
                         
                
                        if(move_uploaded_file($arquivo_tmp, $foto)){
                   
                            $sql = "UPDATE tbl_celebridades SET

                            resumo='".$resumo."',
                            foto='".$foto."'

                             WHERE id=".$_SESSION['id'];
                                 
                        }else{
                            echo("Não foi possivel");
                        }
                 
                    }else{
                        echo("Tamanho de arquivo inválido");
                 
                    }
        
            } else{
                echo("Extensão inválida");            
            }     
        }
            mysqli_query($conexao, $sql);
            header('location:adm_celebridades.php');        
    }
          
}


//Ação dos icones da tabela
    if(isset($_GET['modo'])){
        //Excluir
         $modo = $_GET['modo'];
            if($modo == 'excluir'){
                $codigo = $_GET['id'];
                $sql = "DELETE FROM tbl_celebridades WHERE id=".$codigo;
                     
                mysqli_query($conexao, $sql);
                header('location: adm_celebridades.php');
        }else if($modo == 'buscar'){
                //Editar
                $botao = "Editar";
                $codigo = $_GET['id'];
                
                $_SESSION['id'] = $codigo;
                
                $sql = "SELECT * FROM tbl_celebridades WHERE id=".$codigo;
                
                $select = mysqli_query($conexao, $sql);
                    
                if($rsBanca = mysqli_fetch_array($select)){
                        $resumo = $rsBanca['resumo'];
                       
                        
            
                   
            }
                
        }
        
        //Icones de ativar e desativar conteudo do site
        else if ($modo == 'ativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_celebridades SET
                status = 1 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_celebridades.php');
                
            echo($sql);
            

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_celebridades SET
                status = 0 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_celebridades.php');
            

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
                        
<!--                            Area de bem vindo com o nome do usuario-->
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
                    
<!--                   Tabela de registros-->
                    <div class="conteudos_niveis">
                         <div class="consulta_campo_banca_historia">
                                Titulo
                            </div>
                            
                
                            <div class="consulta_campo_banca_historia">
                            
                            </div>
                        
                        <div class="campo_carregar_niveis">
                            <?php
                            $sql = "SELECT * FROM tbl_celebridades";
                            $select = mysqli_query($conexao, $sql);
                        
                            while($rsCelebridade = mysqli_fetch_array($select)){
                            ?>
                            <div class="info_historia">
                                <?php echo($rsCelebridade["resumo"])?>
                            </div>

        
                            <div class="info_historia">
                                 <a href="adm_celebridades.php?modo=excluir&id=<?php echo($rsCelebridade['id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                                
                                 <a href="adm_celebridades.php?modo=buscar&id=<?php echo($rsCelebridade['id'])?>">
                                  <img src="imagens/editar.png" >
                                </a>
                                
                                <?php
                                    if($rsCelebridade['status'] == 1){?>
                                      
                                    <a href="adm_celebridades.php?modo=desativar&id=<?php echo($rsCelebridade['id'])?>">
                                        <img src="imagens/ativar.png">
                                    </a>
                                    <?php }else{ ?>
                                        <a href="adm_celebridades.php?modo=ativar&id=<?php  echo($rsCelebridade['id'])?>">
                                            <img src="imagens/desativar.png">
                                        </a>
                                    
                                   <?php } ?>
                            </div>
                            <?php
                            }
                            ?>    
                        </div>
                    </div>
                    
<!--                    Formularios de cadastro-->
                    <form name="frmCelebridades" method="post" action="adm_celebridades.php" enctype="multipart/form-data">
                    
                    <div class="cadastrar_noticia">
                        
                         
                        <div class="conteudo">                             
                             <label> Resumo:</label>
                            <p> <textarea cols="34" rows="5" name="txtresumo" required><?php echo(@$resumo)?></textarea></p>
                            
                            <label> Imagem da celebridade </label>
                              <input type="file" name="fileimagem" >
                        </div>
                      
                        
                         <div class="conteudo">  
                            <input class="btnDestaques" type="submit" name="btnEnviar" value="<?php echo($botao)?>">
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>