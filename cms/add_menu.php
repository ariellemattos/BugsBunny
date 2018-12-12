<?php 
    require_once('conexao.php');    
    
    session_start();
        
    $conexao = conexaoDB();
    $logado = $_SESSION['login']; 
    $menu = "Adicionar";
    $submenu = "Adicionar";
//Gerenciar a area do menu
    if(isset($_POST['adicionar_menu'])){
        $menu_name = $_POST['txtnome_menu'];
       
        
        if($_POST['adicionar_menu'] == "Adicionar"){
            $sql = "INSERT INTO tbl_categoria (categoria_name) VALUES ('".$menu_name."')";
        
            mysqli_query($conexao, $sql);
            header('location:add_menu.php');
            
        } else  if ($_POST['adicionar_menu'] == "Editar"){
            
            $sql = "UPDATE tbl_categoria SET
                categoria_name = '".$menu_name."'
                
                WHERE categoria_id =".$_SESSION['categoria_id'];
            
            mysqli_query($conexao, $sql);
      
            header('location:add_menu.php');
        }
    }
    
     if(isset($_GET['menu'])){
        $menu = $_GET['menu'];
        
        if($menu == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_categoria WHERE categoria_id=".$codigo;
            
                mysqli_query($conexao, $sql);
                header('location:add_menu.php');
            } else if($menu == 'buscar'){
                $menu = "Editar";
                $codigo = $_GET['id'];
            
                $_SESSION['categoria_id'] = $codigo;
            
                
                $sql = "SELECT * from tbl_categoria where categoria_id =".$codigo;  
            
                $select = mysqli_query($conexao,$sql);
            
            
                if($rsMenu = mysqli_fetch_array($select)){
                $menu_name = $rsMenu['categoria_name'];
            
                
            }
        } else if($menu == 'ativar'){
            $codigo = $_GET['id'];
           
            $_SESSION['categoria_id'] = $codigo;
            
             $sql = "UPDATE tbl_categoria SET
                status = 1 WHERE categoria_id=".$_SESSION['categoria_id'];
            mysqli_query($conexao, $sql);
            
            header('location:add_menu.php');
                
        }else if ($menu == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['categoria_id'] = $codigo;
            
             $sql = "UPDATE tbl_categoria SET
                status = 0 WHERE categoria_id=".$_SESSION['categoria_id'];
            mysqli_query($conexao, $sql);
            header('location:add_menu.php');
                
        }  
     }
//Gerenciar a area do submenu
    if(isset($_POST['adicionar_sub'])){
        $idMenu = $_POST["selectMenu"];
        $sub_name = $_POST['txtnome_sub'];
       
        $sql = "INSERT INTO tbl_categoria_sub (categoria_id, sub_name) VALUES ('".$idMenu."', '".$sub_name."')";
        
        mysqli_query($conexao, $sql);
    
        echo($sql);
//        header('location:add_menu.php');
    }
    if(isset($_GET['submenu'])){
        $submenu = $_GET['submenu'];
        
        if($submenu == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_categoria_sub WHERE sub_id=".$codigo;
            
                mysqli_query($conexao, $sql);
                header('location:add_menu.php');
        }
        
        else if($submenu == 'ativar'){
            $codigo = $_GET['id'];
           
            $_SESSION['sub_id'] = $codigo;
            
             $sql = "UPDATE tbl_categoria_sub SET
                status = 1 WHERE sub_id=".$_SESSION['sub_id'];
            mysqli_query($conexao, $sql);
            
            
            header('location:add_menu.php');
                
        }else if ($submenu == 'desativar'){
            $codigo = $_GET['id'];
           
	       $_SESSION['sub_id'] = $codigo;
            
             $sql = "UPDATE tbl_categoria_sub SET
                status = 0 WHERE sub_id=".$_SESSION['sub_id'];
            mysqli_query($conexao, $sql);
        
            header('location:add_menu.php');
                
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
    
<!--                    Espeço de cadastro do menu-->
                    <div class="cadastro_menu">
                        <!--   Tabela com os registros-->
                        <div class="conteudos_menu">
                            <div class="consulta_campo_menu">
                                Menu
                            </div>
                            
                            <div class="consulta_campo_menu">
                                Mais
                            </div>
                            
                            <?php
                            $sql = "SELECT * from tbl_categoria";
                        
                           
                            $select = mysqli_query($conexao, $sql);
                            
                            
                            while($rsMenu = mysqli_fetch_array($select))
                            {
                            
                        ?>
                            

                        <div class="campo_carregar_menu">
                            <div class="info_menu">
                                <?php echo($rsMenu["categoria_name"])?>
                            </div>

                            
<!--                              Icones da tabela-->
                            <div class="info_menu">
                                <a href="add_menu.php?menu=excluir&id=<?php echo($rsMenu['categoria_id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                                
                                <a href="add_menu.php?menu=buscar&id=<?php echo($rsMenu['categoria_id'])?>">
                                  <img src="imagens/editar.png" >
                                </a>
                                
                                <?php
                                    if($rsMenu['status'] == 1){?>
                                      
                                    <a href="add_menu.php?menu=desativar&id=<?php echo($rsMenu['categoria_id'])?>">
                                        <img src="imagens/ativar.png">
                                    </a>
                                    <?php }else{ ?>
                                        <a href="add_menu.php?menu=ativar&id=<?php  echo($rsMenu['categoria_id'])?>">
                                            <img src="imagens/desativar.png">
                                        </a>
                                    
                                   <?php } ?>
                            </div>

                        </div>
                        <?php
                            }
                        ?>
                         
                    </div>
                       
                        <form name= "frmMenu"  method="post" action="add_menu.php">
                            <input type="text" name="txtnome_menu" value="<?php echo(@$menu_name) ?>"/> <br>
                            <input type="submit" name="adicionar_menu" value="<?php echo($menu)?>">
                        </form>

                        <br>
                       
                    </div>
                        
                     <div class="cadastro_menu">
                         
                         <!--    Tabela com os registros-->
                        <div class="conteudos_niveis">
                            <div class="consulta_campo_nivel">
                                Menu
                            </div>
                            
                            <div class="consulta_campo_nivel">
                                Submenu
                            </div>
                        
                        
                            <div class="consulta_campo_nivel">
                                Mais
                            </div>
                        
                        <?php
                            $sql = "SELECT tbl_categoria.categoria_name, tbl_categoria_sub.sub_id, tbl_categoria_sub.sub_name, tbl_categoria_sub.status FROM tbl_categoria, tbl_categoria_sub WHERE tbl_categoria.categoria_id = tbl_categoria_sub.categoria_id";
                        
                           
                        $select = mysqli_query($conexao, $sql);
                            
                            
                            while($rsSub = mysqli_fetch_array($select))
                            {
                            
                        ?>
                            

                        <div class="campo_carregar_niveis">
                            <div class="info_niveis">
                                <?php echo($rsSub["categoria_name"])?>
                            </div>

                            <div class="info_niveis">
                               <?php echo($rsSub["sub_name"])?>
                            </div>
                            
                            <!--  Icones da tabela-->
                            <div class="info_niveis">
                                <a href="add_menu.php?submenu=excluir&id=<?php echo($rsSub['sub_id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>
                                
                                <a href="add_menu.php?submenu=buscar&id=<?php echo($rsSub['sub_id'])?>">
                                  <img src="imagens/editar.png" >
                                </a>
                                
                                <?php
                                    if($rsSub['status'] == 1){?>
                                      
                                    <a href="add_menu.php?submenu=desativar&id=<?php echo($rsSub['sub_id'])?>">
                                        <img src="imagens/ativar.png">
                                    </a>
                                    <?php }else{ ?>
                                        <a href="add_menu.php?submenu=ativar&id=<?php  echo($rsSub['sub_id'])?>">
                                            <img src="imagens/desativar.png">
                                        </a>
                                    
                                   <?php } ?>
                                
                            </div>

                        </div>
                        <?php
                            }
                        ?>
                         
                    </div>
                
                        <form name="frmSubmenu" method="post" action="add_menu.php">
                        
                            <select class="option" name="selectMenu" required>         
                                <option> Selecione a categoria </option>
                                    <?php
                                            $sql = "select * from tbl_categoria";
                                            $select = mysqli_query($conexao, $sql);
                                            while($rsMenu = mysqli_fetch_array($select))
                                            {      
                                            ?>
                                            <option value="<?php echo($rsMenu['categoria_id'])?>"> <?php echo($rsMenu['categoria_name'])?></option>
                                            <?php
                                            }
                                            ?>
                             </select>
                      
                        <p>
                            <input type="text" name="txtnome_sub" /> <br>

                            <input type="submit" name="adicionar_sub" value="<?php echo($submenu)?>">
                            </button>
                        </p>
                        
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>