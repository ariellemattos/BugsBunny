<?php 
    session_start();


    $logado = $_SESSION['login']; 

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
                    <div class="paginas">
                       
                        <div class="icone_conteudos">
                            <a href="adm_destaques.php">
                                <img src="imagens/destaques.png">
                            </a>
                        </div>
                        
                          <div class="icone_conteudos">
                            <a href="adm_banca.php">
                                <img src="imagens/banca.PNG">
                            </a>
                        </div>
                        
                         <div class="icone_conteudos">
                            <a href="adm_lojas.php">
                                <img src="imagens/lojas.jpg">
                            </a>
                        </div>
                    
                    </div>
                    
                    <div class="paginas_segunda">
                         <div class="icone_conteudos">
                            <a href="adm_celebridades.php">
                                <img src="imagens/celebridades.png">
                            </a>
                        </div>
                        
                        <div class="icone_conteudos">
                            <a href="adm_promo.php">
                                <img src="imagens/promocoes.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>