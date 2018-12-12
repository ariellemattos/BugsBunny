<?php
    require_once('conexao.php');

    session_start();

    $logado = $_SESSION['login']; 
        
    $conexao = conexaoDB();
    $botao = "Enviar";

    if(isset($_POST["btnEnviar"])){
        $desconto = $_POST["txtdesconto"]; 
        $idProduto = $_POST["selectProduto"];
        
        
        if($_POST["btnEnviar"] == "Enviar"){
            $sql = "INSERT INTO tbl_promocoes
                
                (percentual_desconto, idProduto)
                VALUES ('".$desconto."', '".$idProduto."')
        
        ";
                 
            mysqli_query($conexao, $sql);
            header('location:adm_promo.php');
        
        }else if ($_POST["btnEnviar"] == "Editar"){
              $sql = "UPDATE tbl_promocoes SET
                percentual_desconto='".$desconto."',
                idProduto='".$idProduto."'
                
                WHERE idPromocao=".$_SESSION['idPromocao'];
            

            
        }
          mysqli_query($conexao, $sql);
            header('location:adm_promo.php');
    }


    if(isset($_GET['modo'])){
         $modo = $_GET['modo'];
            if($modo == 'excluir'){
                $codigo = $_GET['id'];
                $sql = "DELETE FROM tbl_promocoes WHERE idPromocao=".$codigo;
                     
                mysqli_query($conexao, $sql);
                header('location: adm_promo.php');
            }else if($modo == 'buscar'){
                $botao = "Editar";
                $codigo = $_GET['id'];
            
                $_SESSION['idPromocao'] = $codigo;
            
                
                $sql = "SELECT tbl_promocoes.*, tbl_produtos.titulo FROM tbl_promocoes, tbl_produtos WHERE tbl_promocoes.idProduto = tbl_produtos.id and  idPromocao=".$codigo;

                
                $select = mysqli_query($conexao,$sql);
                
                if($rsProduto = mysqli_fetch_array($select)){
                    $titulo = $rsProduto['titulo'];
                    $idProduto = $rsProduto['idProduto'];
                    $desconto = $rsProduto['percentual_desconto'];
                    
                    
                }
            }
        
        else if ($modo == 'ativar'){
            /*Ativar e desativar do conteudo*/
            $codigo = $_GET['id'];
           
	       $_SESSION['idPromocao'] = $codigo;
            
             $sql = "UPDATE tbl_promocoes SET
                status = 1 WHERE idPromocao=".$_SESSION['idPromocao'];
           
            mysqli_query($conexao, $sql);
            header('location:adm_promo.php');
            
            

        }else if ($modo == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['idPromocao'] = $codigo;
            
             $sql = "UPDATE tbl_promocoes SET
                status = 0 WHERE idPromocao=".$_SESSION['idPromocao'];
           
            mysqli_query($conexao, $sql);
            header('location:adm_promo.php');
 
        }
                
        
    }

    if(isset($_GET['modo'])){
        
        /*Sair da pagina de cms*/
         $modo = $_GET['modo'];
            if($modo == 'sair'){
               
                //Limpa
                unset ($_SESSION['login']);
                unset ($_SESSION['senha']);

                //Redireciona para a página de autenticação
                header('location:../home.php');
                
                session_destroy();

	
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
                    <form name="frmBanca" method="post" action="adm_promo.php" enctype="multipart/form-data">
                    
                    <div class="cadastrar_noticia">
                        <div class="cadastrar_valores"> 
                            <div class="title_banca">
                                <h3> Promoções </h3>
                            </div>
                            
                            <div class="caixas_cadastro">
                                    
                                <label> Percentual de desconto:</label>
                                <p> <input type="text" name="txtdesconto" value="<?php echo(@$desconto)?>" required></p>
                                
                                <p> 
                                        <label> Produto: </label>

                                        <select class="option" name="selectProduto" required>
                                            
                                            <?php
                                            if($modo == "buscar"){
                                            ?>
                                                 <option value="<?php echo($idProduto)?>"> <?php echo($titulo)?> </option>
                                            
                                            <?php
                                            }
                                            else{
                                            ?>
                                            
                                            <option> Selecione o produto </option>
                                            
                                            <?php
                                                $idProduto = 0;
                                            }
                                            ?>
                                            
                                            
                                                                                
                                            <?php
                                            $sql = "select * from tbl_produtos where id <>" .$idProduto;
                                            
                                             $select = mysqli_query($conexao, $sql);
                            
                            
                                            while($rsProduto = mysqli_fetch_array($select))
                                            {      
                                            ?>
                                            <option value="<?php echo($rsProduto['id'])?>"> <?php echo($rsProduto['titulo'])?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </p>
                                
        
                                 <input class="btnbanca" type="submit" value="<?php echo($botao)?>" name="btnEnviar">
                            </div> 
                        
                        </div>
                        
                        
   
<!--                        Tabela para carregar os registrios-->                     
                        <div class="tabela_bancas"> 
                                <div class="consulta_campo_banca">
                                    Produto
                                 </div>
                            
                                <div class="consulta_campo_banca">
                                    Desconto
                                </div>
                        
                        
                                <div class="consulta_campo_banca">
                                    Mais
                                </div>
                        
                                  <?php
                                         $sql = "SELECT tbl_promocoes.percentual_desconto,tbl_promocoes.status, tbl_produtos.titulo, tbl_promocoes.idPromocao FROM tbl_promocoes, tbl_produtos where tbl_promocoes.idProduto = tbl_produtos.id";
                                        $select = mysqli_query($conexao, $sql); 

                                        while($rsProduto = mysqli_fetch_array($select)){
                                    ?>
                                 <div class="campo_carregar_banca">
                            
                                    <div class="info_banca">
                                       <?php echo($rsProduto["titulo"])?>
                                    </div>

                                    <div class="info_banca">
                                         <?php echo($rsProduto["percentual_desconto"])?>
                                     </div>
                                     
                                     
<!--                                     Icones da tabela-->
                                     <div class="info_banca">
                                        <a href="adm_promo.php?modo=excluir&id=<?php echo($rsProduto['idPromocao'])?>">
                                            <img src="imagens/delete.png" >
                                        </a>
                                         
                                         <a href="adm_promo.php?modo=buscar&id=<?php echo($rsProduto['idPromocao'])?>">
                                            <img src="imagens/editar.png" >
                                         </a>
                                         
                                           <?php
                                                if($rsProduto['status'] == 1){?>
                                      
                                                    <a href="adm_promo.php?modo=desativar&id=<?php echo($rsProduto['idPromocao'])?>">
                                                        <img src="imagens/ativar.png">
                                                    </a>
                                          <?php }else{ ?>
                                                    <a href="adm_promo.php?modo=ativar&id=<?php echo($rsProduto['idPromocao'])?>">
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