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
            
            <div class ="menu">
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
            
            <?php
                $sql = "SELECT * FROM tbl_celebridades where status = 1";
                $select = mysqli_query($conexao, $sql);
            
                while($rsCelebridade = mysqli_fetch_array($select)){
            ?>
            <div class="caixa_celebridade">
                <div class="foto_celebridade">
                    <img src="cms/<?php echo($rsCelebridade["foto"])?>">
                </div>
                
                <div class="fofoca">
                     <?php echo($rsCelebridade["resumo"])?>
                </div>
            </div>
            <?php
            }
            ?>
            
        </div>
       <footer>© 2018 Todos os direitos reservados. </footer>
    </body>
</html>
