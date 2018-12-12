<?php
    require_once('conexao.php');
    
    session_start();

    $logado = $_SESSION['login']; 

    $conexao = conexaoDB();

    $botao = "Enviar";

    if(isset($_POST["btnEnviar"])){
        //Inserindo o conteudo no banco
        $endereco = $_POST["txtendereco"];
        $telefone = $_POST["txttelefone"];
        $cep = $_POST["txtcep"];
        
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
                        if($_POST["btnEnviar"] == "Enviar"){
                        $sql = "INSERT INTO tbl_nossasbancas

                        (endereco, telefone, cep, imagem) 

                        VALUES ('".$endereco."','".$telefone."','".$cep."','".$foto."')

                        ";
                
                }else{
                    echo("Não foi possivel meu bb, tente novamente nesse codigo seu merda");
                }
                }else{
                    echo("Tamanho de arquivo inválido meu consagrado");
                }
            }else{
                echo("Extensão inválida");            
            }
        }
    } else if($_POST["btnEnviar"] == "Editar"){
            //Editando os conteudo já cadastrados
            if($_FILES["fileimagem"]["name"] == ""){
                //Editando sem a imagem
                $sql = "UPDATE tbl_nossasbancas SET
                endereco='".$endereco."',
                telefone='".$telefone."',
                cep='".$cep."'
            
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
                   
                            $sql = "UPDATE tbl_nossasbancas SET
                                endereco='".$endereco."',
                                telefone='".$telefone."',
                                cep='".$cep."',
                                imagem = '".$foto."'
            
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
                 
    }
        mysqli_query($conexao, $sql);
        header('location:adm_lojas.php');       
}

//Ação dos icones da tabela
    if(isset($_GET['modo'])){
        //Excluir
         $modo = $_GET['modo'];
            if($modo == 'excluir'){
                $codigo = $_GET['id'];
                $sql = "DELETE FROM tbl_nossasbancas WHERE id=".$codigo;
                     
                mysqli_query($conexao, $sql);
                header('location: adm_lojas.php');
        }else if($modo == 'buscar'){
                 //Editar
                $botao = "Editar";
                $codigo = $_GET['id'];
                
                $_SESSION['id'] = $codigo;
                
                $sql = "SELECT * FROM tbl_nossasbancas WHERE id=".$codigo;
                
                $select = mysqli_query($conexao, $sql);
                    
                if($rsBanca = mysqli_fetch_array($select)){
                        $endereco = $rsBanca['endereco'];
                        $telefone = $rsBanca['telefone'];
                        $cep = $rsBanca['cep'];
                        
            
                   
            }
                
        }else if ($modo == 'ativar'){
            /*Ativar e desativar do conteudo*/
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_nossasbancas SET
                status = 1 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_lojas.php');
                
            echo($sql);
            

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_nossasbancas SET
                status = 0 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_lojas.php');
 
        }
    }


?>

<!DOCTYPE html>
<html>
    <head>
       <link rel = "stylesheet" type="text/css" href="css/style.css">
       <script type="text/javascript" src="js/mascara.js"></script>
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
                    
                    
<!--                    Formulario de cadastro-->
                    <form name="frmNossasBancas" method="post" action="adm_lojas.php" enctype="multipart/form-data">
                    
                    <div class="cadastrar_noticia">
                        <div class="cadastro_banca"> 
                            <div class="title_banca">
                                <h3> Cadastro de uma nova banca </h3>
                            </div>
                            
                             <div class="inseridos_usuarios"> 
                                
                                    <label> Endereço: </label>
                                    <input type="text" name="txtendereco" value="<?php echo(@$endereco)?>" required>
                                 
                                    <p> 
                                        <label> Telefone: </label>
                                       <input type=number name="txttelefone" value="<?php echo(@$telefone)?>" required>
                                    </p>
                                
                                    
                                    <p> 
                                        <label> Cep: </label>
                                      <input type="text" name="txtcep" value="<?php echo(@$cep)?>" onkeypress="mascara(this,cep)" maxlength="9" required >

                                    </p>
                                    
                                 <p>
                                    <label> Foto da banca:</label>
                                     <input type="file" name="fileimagem" >
                                 </p>
                                    
                                <p>
                                   <input class="btnbanca" type="submit" name="btnEnviar" value="<?php echo($botao)?>">
                                 </p>
                                
                          
                            </div>    
                            
     <!--                        Tabela para carregar os registrios-->
                             <div class="tabela_bancas"> 
                                <div class="consulta_campo_banca">
                                    Endereço
                                 </div>
                            
                                <div class="consulta_campo_banca">
                                    Telefone
                                </div>
                        
                        
                                <div class="consulta_campo_banca">
                                    Mais
                                </div>
                            
                        
                                  <?php
                                        $sql = "SELECT * FROM tbl_nossasbancas";
                                        $select = mysqli_query($conexao, $sql); 

                                        while($rsBanca = mysqli_fetch_array($select)){
                                    ?>
                                 <div class="campo_carregar_banca">
                            
                                    <div class="info_banca">
                                        <?php echo($rsBanca["endereco"])?>
                                    </div>

                                    <div class="info_banca">
                                        <?php echo($rsBanca["telefone"])?>
                                    </div>

<!--                                Icones da tabela-->    
                                    <div class="info_banca">
                                        <a href="adm_lojas.php?modo=excluir&id=<?php echo($rsBanca['id'])?>">
                                            <img src="imagens/delete.png" >
                                        </a>
                                
                                        <a href="adm_lojas.php?modo=buscar&id=<?php echo($rsBanca['id'])?>">
                                            <img src="imagens/editar.png" >
                                        </a>
                                        
                                         <?php
                                                if($rsBanca['status'] == 1){?>
                                      
                                                    <a href="adm_lojas.php?modo=desativar&id=<?php echo($rsBanca['id'])?>">
                                                        <img src="imagens/ativar.png">
                                                    </a>
                                          <?php }else{ ?>
                                                    <a href="adm_lojas.php?modo=ativar&id=<?php echo($rsBanca['id'])?>">
                                                        <img src="imagens/desativar.png">
                                                    </a>
                                    
                                        <?php } ?>
                                     </div>
                                    
                                </div> 
                                  
                                <?php
                                    }
                                ?>
                                 
                            </div>
                           
                        
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>