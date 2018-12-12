<?php
    require_once('conexao.php');
    session_start();

    $logado = $_SESSION['login']; 

    $conexao = conexaoDB();

    $botao = "Enviar";
    

    if(isset($_POST["btnEnviar"])){
        
        /*Resgatar as varias da caixa*/
        $titulo =  $_POST["txttitulo"]; 
        $resumo =  $_POST["txtresumo"]; 
        $data  = $_POST["txtdata"]; 
        
        if($_POST["btnEnviar"] == "Enviar"){
            /*Fazer o insert do conteudo*/        
        
            /*Upload da imagem*/
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
                    
                    $sql = "INSERT INTO tbl_destaques
                    
                    (titulo, resumo, data, imagem) 
                    
                    VALUES ('".$titulo."','".$resumo."','".$data."','".$foto."')
                    
                    ";
                     
                     mysqli_query($conexao, $sql);
                     header('location:adm_destaques.php');                
            }else{
                echo("Não foi possivel");
            }
                 
            }else{
                 echo("Tamanho de arquivo inválido");
                 
            }
        
        } else{
            echo("Extensão inválida");            
        } 
    } else if($_POST["btnEnviar"] == "Editar"){
            
            /*Editar sem o upload ce imagem*/
            if($_FILES["fileimagem"]["name"] == ""){
                $sql = "UPDATE tbl_destaques SET
                titulo='".$titulo."',
                resumo='".$resumo."',
                data='".$data."'
            
                WHERE id=".$_SESSION['id'];
                 
                
            }else{
                /*Editar com o upload de imagem*/
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
                   
                            $sql = "UPDATE tbl_destaques SET

                            titulo='".$titulo."',
                            resumo='".$resumo."',
                            data='".$data."',
                            imagem='".$foto."'

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
            header('location:adm_destaques.php');       
    }
             
}
    
    /*Funcoes dos icones*/
    if(isset($_GET['modo'])){
        
        /*Excluir conteudo*/
         $modo = $_GET['modo'];
            if($modo == 'excluir'){
                $codigo = $_GET['id'];
                $sql = "DELETE FROM tbl_destaques WHERE id=".$codigo;
                     
                mysqli_query($conexao, $sql);
                header('location: adm_destaques.php');
        } else if($modo == 'buscar'){
                /*Editar conteudo*/
                $botao = "Editar";
                $codigo = $_GET['id'];
                
                $_SESSION['id'] = $codigo;
                
                $sql = "SELECT * FROM tbl_destaques WHERE id=".$codigo;
                
                $select = mysqli_query($conexao, $sql);
                    
                if($rsNoticias = mysqli_fetch_array($select)){
                        $titulo = $rsNoticias['titulo'];
                        $resumo = $rsNoticias['resumo'];
                        $data = $rsNoticias['data'];
                        $foto = $rsNoticias['imagem'];
            }
                
        }else if ($modo == 'ativar'){
            /*Ativar e desativar do conteudo*/
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_destaques SET
                status = 1 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
//            header('location:adm_destaques.php');
                
            echo($sql);
            

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_destaques SET
                status = 0 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
//            header('location:adm_destaques.php');
                
                 echo($sql);
 
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
                    
<!--                    Icones de navagacao-->
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
                    
<!--                    Tabela de registro-->
                    <div class="conteudos_niveis">
                         <div class="consulta_campo_nivel">
                                Titulo
                            </div>
                            
                            <div class="consulta_campo_nivel">
                                Data
                            </div>
                        
                        
                            <div class="consulta_campo_nivel">
                            
                            </div>
                        
                        <div class="campo_carregar_niveis">
                            <?php
                            $sql = "SELECT * FROM tbl_destaques";
                            $select = mysqli_query($conexao, $sql);
                        
                            while($rsNoticias = mysqli_fetch_array($select)){
                            ?>
                            <div class="info_niveis">
                                <?php echo($rsNoticias["titulo"])?>
                            </div>

                            <div class="info_niveis">
                               <?php echo($rsNoticias["data"])?>
                            </div>
                            
                            <div class="info_niveis">
                                  <a href="adm_destaques.php?modo=excluir&id=<?php echo($rsNoticias['id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                                
                                 <a href="adm_destaques.php?modo=buscar&id=<?php echo($rsNoticias['id'])?>">
                                  <img src="imagens/editar.png" >
                                </a>
                            
                               <?php
                                    if($rsNoticias['status'] == 1){?>
                                      
                                    <a href="adm_destaques.php?modo=desativar&id=<?php echo($rsNoticias['id'])?>">
                                        <img src="imagens/ativar.png">
                                    </a>
                                    <?php }else{ ?>
                                        <a href="adm_destaques.php?modo=ativar&id=<?php  echo($rsNoticias['id'])?>">
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
                    <form name="frmDestaques" method="post" action="adm_destaques.php" enctype="multipart/form-data">
                    
                    <div class="cadastrar_noticia">
                        
                         
                        <div class="conteudo"> 
                            <label> Titulo:</label>
                            <p> <textarea cols="34" rows="5" name="txttitulo" required><?php echo(@$titulo)?></textarea></p>
                            
                             <label> Resumo:</label>
                            <p> <textarea cols="34" rows="5" name="txtresumo" required><?php echo(@$resumo)?></textarea></p>
                            
                            <input class="btnDestaques" type="submit" name="btnEnviar" value="<?php echo($botao);?>">
                        </div>
                      
                        
                         <div class="conteudo"> 
                             <label> Data da noticia:</label>
                            <p> <input type="text" name="txtdata" value="<?php echo(@$data)?>" placeholder="01 de janeiro de 2018" required></p>
                             
                             <label> Imagem da noticia </label>
                              <input type="file" name="fileimagem" >
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>