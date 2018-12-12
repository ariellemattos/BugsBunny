<?php
    require_once('conexao.php');

    session_start();

    $logado = $_SESSION['login']; 
    

    $conexao = conexaoDB();
    $botao = "Enviar";

    if(isset($_POST["btnEnviar"])){
        $nome = $_POST["txtnome"];  
        $idNivel = $_POST["selectNivel"];
        $email = $_POST["txtemail"];
        $telefone = $_POST["txttelefone"];
        $celular = $_POST["txtcelular"];
        $login = $_POST["txtlogin"];
        $senha = $_POST["txtsenha"];
        
        if($_POST["btnEnviar"] == "Enviar"){
            $sql = "INSERT INTO tbl_usuarios
                
                (nome, idNivel, email, telefone, celular, login, senha)
                VALUES ('".$nome."', ".$idNivel.", '".$email."', '".$telefone."', '".$celular."', '".$login."', '".$senha."')
        
        ";
            
        } else if ($_POST["btnEnviar"] == "Editar"){
            $sql = "UPDATE tbl_usuarios SET
                nome='".$nome."',
                idNivel='".$idNivel."',
                email='".$email."',
                telefone='".$telefone."',
                celular='".$celular."',
                login='".$login."',
                senha='".$senha."'
            
                WHERE idUsuario=".$_SESSION['idUsuario'];
        
        }
        
        
        mysqli_query($conexao, $sql);
        header('location:cadastro_usuario.php');
    }

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_usuarios WHERE idUsuario=".$codigo;
                
                mysqli_query($conexao, $sql);
                header('location:cadastro_usuario.php');
            
            } else if($modo == 'buscar'){
                $botao = "Editar";
                $codigo = $_GET['id'];
            
                $_SESSION['idUsuario'] = $codigo;
            
                
                $sql = "SELECT tbl_usuarios.*, tbl_niveis.nomeNivel FROM tbl_usuarios, tbl_niveis WHERE tbl_usuarios.idNivel = tbl_niveis.idNivel and  idUsuario=".$codigo;

                
                $select = mysqli_query($conexao,$sql);
                
                if($rsConsulta = mysqli_fetch_array($select)){
                    $nome = $rsConsulta['nome'];
                    $idNivel = $rsConsulta['idNivel'];
                    $email = $rsConsulta['email'];
                    $telefone = $rsConsulta['telefone'];
                    $celular = $rsConsulta['celular'];
                    $login = $rsConsulta['login'];
                    $senha = $rsConsulta['senha'];
                    $nomeNivel = $rsConsulta['nomeNivel'];
                }
                
            } 
        }

    if(isset($_GET['modo'])){
        
        /*Sair da pagina de cms*/
         $modo = $_GET['modo'];
            if($modo == 'sair'){
               
                //Limpa
               session_start();
                session_destroy();
                header("Location: ../home.php");
	
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
                        
<!--                         Area de bem vindop com o nome do usuario-->
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
                    
<!--                    Tabela com os registros-->
                        <div class="conteudos_niveis">
                            <div class="consulta_campo_nivel">
                                Nome
                            </div>
                            
                            <div class="consulta_campo_nivel">
                                Nivel
                            </div>
                        
                        
                            <div class="consulta_campo_nivel">
                                Mais
                            </div>
                        
                        <?php
                            $sql = "SELECT tbl_usuarios.nome, tbl_usuarios.idUsuario, tbl_niveis.nomeNivel FROM tbl_usuarios, tbl_niveis WHERE tbl_usuarios.idNivel = tbl_niveis.idNivel";
                        
                           
                        $select = mysqli_query($conexao, $sql);
                            
                            
                            while($rsUsuarios = mysqli_fetch_array($select))
                            {
                            
                        ?>
                            

                        <div class="campo_carregar_niveis">
                            <div class="info_niveis">
                                <?php echo($rsUsuarios["nome"])?>
                            </div>

                            <div class="info_niveis">
                               <?php echo($rsUsuarios["nomeNivel"])?>
                            </div>
                            
                            <!--  Icones da tabela-->
                            <div class="info_niveis">
                                <a href="cadastro_usuario.php?modo=excluir&id=<?php echo($rsUsuarios['idUsuario'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                                
                                <a href="cadastro_usuario.php?modo=buscar&id=<?php echo($rsUsuarios['idUsuario'])?>">
                                  <img src="imagens/editar.png" >
                                </a>
                            </div>

                        </div>
                        <?php
                            }
                        ?>
                         
                    </div>
                    
                    <div class="area_nivel">
                        <div class="title_nivel">
                            Faça aqui o cadastro de um novo usuario
                        </div>
                        
                        <div class="cadastro">
                            
<!--                            Formulario de cadastro-->
                            <form id="form_user" name="frmUsuarios" method="post" action="cadastro_usuario.php"> 
                                <div class="inseridos_usuarios"> 
                                
                                    <label> Nome: </label>
                                    <input type="text" name="txtnome" value="<?php echo(@$nome) ?>" required>
                                    
                                    <p> 
                                        <label> Telefone: </label>
                                        <input type="text" name="txttelefone" value="<?php echo(@$telefone) ?>" onkeyup="mascara( this, telefone );" maxlength="15" required>
                                    </p>
                                    
                                    <p> 
                                        <label> Login: </label>
                                        <input type="text" name="txtlogin" value="<?php echo(@$login) ?>" required>
                                    </p>
                                    
                                    <p> 
                                        <label> Nivel: </label>

                                        <select class="option" name="selectNivel" required> 
                                           <?php
                                            if($modo == "buscar"){
                                            ?>
                                                 <option value="<?php echo($idNivel)?>"> <?php echo($nomeNivel)?> </option>
                                            
                                            <?php
                                            }
                                            else{
                                            ?>
                                            
                                            <option> Selecione um nivel </option>
                                            
                                            <?php
                                                $idNivel = 0;
                                            }
                                            ?>
                                            
                                            
                                            <?php
                                            $sql = "select * from tbl_niveis where idNivel <>".$idNivel;
                                            
                                             $select = mysqli_query($conexao, $sql);
                            
                            
                                            while($rsNiveis = mysqli_fetch_array($select))
                                            {      
                                            ?>
                                            <option value="<?php echo($rsNiveis['idNivel'])?>"> <?php echo($rsNiveis['nomeNivel'])?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </p>
                                </div> 
                                
                                <div class="inseridos_usuarios"> 
                                
                                    <label> Email: </label>
                                    <input type="email" name="txtemail" value="<?php echo(@$email) ?>" required>
                                    
                                    <p> 
                                        <label> Celular: </label>
                                        <input name="txtcelular" value="<?php echo(@$celular) ?>" type="text" onkeyup="mascara( this, celular );" maxlength="15" required>
                                    </p>
                                    
                                    <p> 
                                        <label> Senha: </label>
                                        <input type="password" name="txtsenha" value="<?php echo(@$senha) ?>" required>
                                    </p>
                               <input class="btnUser" type="submit" value="<?php echo($botao);?>" name="btnEnviar">            
                                </div>         
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>