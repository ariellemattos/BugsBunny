<?php
    require_once('conexao.php');

    session_start();

    $logado = $_SESSION['login']; 

    $conexao = conexaoDB();    


    if(isset($_POST["btnEnviar"])){
        $nivel = $_POST["txtnivel"];  
        $descricao = $_POST["txtdescricao"];
        
        $sql = "INSERT INTO tbl_niveis
                
                (nomeNivel, descricao)
                VALUES ('".$nivel."', '".$descricao."')
        
        ";
        
        mysqli_query($conexao, $sql);
        header('location:cadastro_nivel.php');
        
        }

        if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_niveis WHERE idNivel=".$codigo;
            
                mysqli_query($conexao, $sql);
                echo($sql);
//                header('location:cadastro_nivel.php');
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
                    
<!--                    Tabela de registros-->
                    <div class="conteudos_niveis">
                            <div class="consulta_campo_nivel">
                                Nivel
                            </div>
                            
                            <div class="consulta_campo_nivel">
                                Descrição
                            </div>
                        
                        
                            <div class="consulta_campo_nivel">
                                Mais
                            </div>
                        
                        <?php
                            $sql = "SELECT * FROM tbl_niveis order by idNivel desc";
                        
                            $select = mysqli_query($conexao, $sql);
                            
                            
                            while($rsNivel = mysqli_fetch_array($select))
                            {
                            
                        ?>
                        
<!--                        Icones da tabela-->
                        <div class="campo_carregar_niveis">
                            <div class="info_niveis">
                                <?php echo($rsNivel["nomeNivel"])?>
                            </div>

                            <div class="info_niveis">
                               <?php echo($rsNivel["descricao"])?>
                            </div>
                            
                            <div class="info_niveis">
                               
                                <a href="cadastro_nivel.php?modo=excluir&id=<?php echo($rsNivel['idNivel'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                            </div>

                        </div>
                        <?php
                            }
                        ?>
                         
                    </div>
                    
                    
<!--                    Formulario de cadastro-->
                    <div class="area_nivel">
                        <div class="title_nivel">
                            Faça aqui o cadastro de um novo nivel
                        </div>
                        
                        <div class="cadastro">
                             <div class="inseridos"> 
                                <form id="form_nivel" name="frmNivel" method="post" action="cadastro_nivel.php"> 
                                    <label> Nivel: </label>
                                    <input type="text" name="txtnivel" required>
                                    
                                  
                                    <p> 
                                        <label> Descrição: </label>
                                        <textarea cols="34" rows="5" name="txtdescricao" required></textarea>
                                        
                                        <input type="submit" name= "btnEnviar" value="Enviar">
                                    </p>
                                
                                 </form>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>