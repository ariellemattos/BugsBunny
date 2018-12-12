<?php

    session_start();

    $logado = $_SESSION['login']; 

    require_once('conexao.php');

    $conexao = conexaoDB();
    $botao = "Enviar";

    if(isset($_POST["btnEnviar"])){
    
        /*Resgata o que esta na caixa*/
        $titulo = $_POST["txttitulo"];  
        $descricao = $_POST["txtdescricao"];
        
        /*Realiza o insert no banco*/
        if($_POST["btnEnviar"] == "Enviar"){
            $sql = "INSERT INTO tbl_valores
                
                (titulo, descricao)
                VALUES ('".$titulo."', '".$descricao."')
        
        ";
            
            mysqli_query($conexao, $sql);
            header('location:adm_banca_valores.php');
            
        } 
        
        /*Realiza o editar do conteudo*/
        else if($_POST["btnEnviar"]== "Editar") {
            $sql="UPDATE tbl_valores SET 
                    titulo='".$titulo."',
                    descricao = '".$descricao."'
                  
                  WHERE id=".$_SESSION['id'];
            
            mysqli_query($conexao, $sql);
            header('location:adm_banca_valores.php');  

        }
        
    }


       
       
    /*Funcao dos icones*/
    if(isset($_GET["modo"])){
        $modo = $_GET["modo"];
        
        /*Excluir o conteudo*/
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_valores WHERE id=".$codigo;
            
            mysqli_query($conexao, $sql);
            header('location:adm_banca_valores.php');
            
        }
         /*Editar o conteudo*/
        else if($modo =='buscar'){
            $botao = 'Editar';
            $codigo = $_GET['id'];
            
            $_SESSION['id'] = $codigo;
            
            $sql = "SELECT * FROM tbl_valores where id=".$codigo;
            
            $select = mysqli_query($conexao,$sql);
            
            
            if($rsValores = mysqli_fetch_array($select)){
                $titulo = $rsValores['titulo'];
                $descricao = $rsValores ['descricao'];
                
            }
            
        } 
        
         /*Ativar e desativar o conteudo*/
        else if ($modo == 'ativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_valores SET
                status = 1 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_banca_valores.php');
                
            echo($sql);
            

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['id'] = $codigo;
            
             $sql = "UPDATE tbl_valores SET
                status = 0 WHERE id=".$_SESSION['id'];
            mysqli_query($conexao, $sql);
            header('location:adm_banca_valores.php');
            

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
                        
                        
 <!--      Area de bem vindo com o nome do usuario-->                       
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
                
<!--                    Cadastro dos campos dee valores da banca-->
                <div class="admins"> 
                    
    <!--                    Formulario de cadastro-->
                    <form name="frmBanca" method="post" action="adm_banca_valores.php" enctype="multipart/form-data">
                    
                    <div class="cadastrar_noticia">
                        <div class="cadastrar_valores"> 
                            <div class="title_banca">
                                <h3> Valores Corporativos </h3>
                            </div>
                            
                            <div class="caixas_cadastro">
                                    <label> Titulo:</label>
                                <p> <input type="text" name="txttitulo" value="<?php echo(@$titulo)?>" required></p>
                                
                                  <label> Descrição:</label>
                                <p> <textarea cols="34" rows="13" name="txtdescricao" required><?php echo(@$descricao)?></textarea></p>
                                
                                 <input class="btnbanca" type="submit" value="<?php echo($botao)?>" name="btnEnviar">
                            </div> 
                        
                        </div>
                        
                        
 <!--                        Tabela para carregar os registrios-->                       
                        <div class="tabela_bancas"> 
                                <div class="consulta_campo_banca">
                                    Titulo
                                 </div>
                            
                                <div class="consulta_campo_banca">
                                    Descrição
                                </div>
                        
                        
                                <div class="consulta_campo_banca">
                                    Mais
                                </div>
                        
                                  <?php
                                        $sql = "SELECT * FROM tbl_valores";
                                        $select = mysqli_query($conexao, $sql); 

                                        while($rsBanca = mysqli_fetch_array($select)){
                                    ?>
                                 <div class="campo_carregar_banca">
                            
                                    <div class="info_banca">
                                        <?php echo($rsBanca["titulo"])?>
                                    </div>

                                    <div class="info_banca">
                                        <?php echo($rsBanca["descricao"])?>
                                     </div>
                                     
                                     <div class="info_banca">
                                        <a href="adm_banca_valores.php?modo=excluir&id=<?php echo($rsBanca['id'])?>">
                                            <img src="imagens/delete.png" >
                                        </a>
                                         
                                         <a href="adm_banca_valores.php?modo=buscar&id=<?php echo($rsBanca['id'])?>">
                                            <img src="imagens/editar.png" >
                                         </a>
                                         
                                         <?php
                                            if($rsBanca['status'] == 1){?>
                                      
                                                <a href="adm_banca_valores.php?modo=desativar&id=<?php echo($rsBanca['id'])?>">
                                                    <img src="imagens/ativar.png">
                                                </a>
                                         <?php }else{ ?>
                                                <a href="adm_banca_valores.php?modo=ativar&id=<?php  echo($rsBanca['id'])?>">
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