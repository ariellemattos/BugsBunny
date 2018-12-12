<?php
    require_once('conexao.php');
    
    session_start();

    $logado = $_SESSION['login'];

    $conexao = conexaoDB();

    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_faleconosco WHERE id=".$codigo;
            
            mysqli_query($conexao, $sql);
            header('location: cmsfale_conosco.php');
            
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
         <script src="js/jquery.js"></script>
        <title> CMS - Sistema de gerenciamento do site </title>
        
        <script>
                $(document).ready(function(){
                    //Function para abrir a janela Modal
                    $(".visualizar").click(function(){
                        //toogle, slideToogle, slideDown, slideUp, fadeIn, fadeOut
                        $(".container").fadeIn(1100);

                    });

                });
            
            function modal(idItem){
            //Somente o ajax consegue forçar um POST ou GET
            //para uma página sem precisar atualizar a página
            
            /*
                type: - serve para especificar se é GET ou POST
                
                url: - serve para especificar a página que será requisitada
                
                data: serve para criar váriaveis que serão submetidas (GET/POST) 
                para a página requisitada
                
                success: caso toda a requisição seja realizada com exito, então 
                a function do success será chamada e através do parametro dados, 
                iremos descarregar na div (modal) o conteudo de dados
            */
            
            $.ajax({
                type: "POST",
                url: "modal.php",
                data:{idRegistro:idItem},
                success: function(dados){
                   
                    $('.modal').html(dados);
                }
                
            })
        }
        </script>
    </head>
    
    <body>
        <div class="container">
            <div class="modal">
                
            </div>
        </div>
       
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
                    <div class="conteudos">
                        
<!--                        Tabela que carrega os registros-->
                            <div class="consulta_campo">
                                Nome
                            </div>
                            
                            <div class="consulta_campo">
                                Email
                            </div>
                            
                            <div class="consulta_campo">
                                Profissão
                            </div>
                            
                            <div class="consulta_campo">
                                Mais
                            </div>
                        
                        
                        <?php
                            $sql= "select * from tbl_faleconosco order by id desc";
                            $select =  mysqli_query($conexao, $sql);
                       
                        while($rsContatos = mysqli_fetch_array($select))
                        {

                        ?>
                        <div class="campo_carregar">
                            <div class="info">
                               <?php echo($rsContatos['nome'])?>
                            </div>

                            <div class="info">
                                <?php echo($rsContatos['email'])?>
                            </div>

                            <div class="info">
                               <?php echo($rsContatos['profissao'])?>
                            </div>

                            
<!--                            Icones da tabelas-->
                            <div class="info">
                                <a href="cmsfale_conosco.php?modo=excluir&id=<?php echo($rsContatos['id'])?>">
                                  <img src="imagens/delete.png" >
                                </a>

                                <a href="#" class="visualizar" onclick="modal(<?php echo($rsContatos['id'])?>)">
                                    <img class="visualizar" src="imagens/lupa.jpg">
                                </a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                         
                    </div>
                </div
            </div>
        </div>
    </body>
</html>