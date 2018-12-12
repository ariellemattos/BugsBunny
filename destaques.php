<?php
     require_once('conexao.php');
    
    session_start();

    $conexao = conexaoDB();
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
		<link rel = "stylesheet" type="text/css" href="css/style.css">
        <script src="Jq/jquery.js"></script>
        <script src="jc/jcycle.js"></script>
        <script src="js/slider.js"></script>
		
        <title> 
			Bugs Bunny SA
		</title>
	</head>
    <body>
        <div class="cabecalho"> 
        <header>
            <div class="logo"></div>
            
            <div class="menu">
                <nav>
                  
		<div class="submenu">
                     <a href="index.php">             
                         Home
                    </a>
                </div>
                <div  class="submenu">
                    <a href="destaques.php">             
                         Destaques
                    </a>
                </div>
                <div  class="submenu" >
                   <a href="sobre.php">             
                         Sobre
                    </a>
                </div>
              
                <div  class="submenu">
                    <a href="promocoes.php">
                        Promoções
                    </a>
                </div>
                 
                <div  class="submenu">
                    <a href="franquias.php"> 
                        Nossas Lojas
                    </a>
                </div>
                
               <div  class="submenu">
                    <a href=celebridades.php>
                        Celebridades
                    </a>
                </div>
                
                
                <div  class="submenu">
                    <a href="contato.php">             
                        Fale Conosco
                    </a>
                </div>
                </nav>
                
                <div class="login">
                <form method="post" action="index.php">
                    <div class="form">
                        <label> Usuario </label>
                        <p> <input class="input" type="text" name="login" id="login"> </p>
                        
                    </div>
                
                    <div class="form">  
                        <label> Senha:</label>
                        <p> <input class="input" type="password" name="senha" id="senha"> </p>
                        
                    </div>
                   
                    <input class="btn" type="submit" name="btnOk" value="Ok">
                </form>
                </div>
            </div>
   
            <div class="redes">
                <div class="social">
                    <img class="rede_social" src="img/icone_face.ico" alt="Facebook" title="">
                </div>
                 
                <div class="social">
                    <img class="rede_social" src="img/icone_insta.jpg" alt="Instagram" title="">                
                </div>
                 
                <div class="social">
                    <img class="rede_social" src="img/icone_twitter.png" alt="Twitter" title="">
                </div>
            </div>
        </header>
        </div>
        
        <div id="principal">           
            <div class="noticias_semana"> 
                
                <?php
                    $sql= "SELECT * FROM tbl_destaques where status = 1";
                    $select = mysqli_query($conexao, $sql);
                
                    while($rsNoticias = mysqli_fetch_array($select)){
                
                ?>
                <div class="noticias">
                     <div class="img_noticia">
                        <img src="cms/<?php echo($rsNoticias["imagem"])?>">
                     </div>     
                    
                    <div class="info_noticias">
                        <div class="titulo_noticia">
                            <?php echo($rsNoticias["titulo"])?>
                        </div>
                        
                        <div class="resumo_noticia">
                            <?php echo($rsNoticias["resumo"])?>
                        </div>
                        
                        <div class="data">  
                            <?php echo($rsNoticias["data"])?>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <footer>© 2018 Todos os direitos reservados. </footer>
    </body>
</html>
