<?php
    require_once('conexao.php');

    $conexao = conexaoDB();
    
    session_start();
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
 
        <div class="sessao_promo">
           <section>
              <div class="titulo"> Livros </div>
               
                   
                <?php
                    $sql = "SELECT tbl_promocoes.*, tbl_produtos.* FROM tbl_promocoes, tbl_produtos where tbl_promocoes.idProduto = tbl_produtos.id and status = 1";
                    $select = mysqli_query($conexao, $sql);
                
                    while($rsPromocao = mysqli_fetch_array($select)){
                
                ?>
                <div class="produtos">
                    <div class="foto">
                        <img class= "livros" src="livros/amostruario4.jpg" alt="Livro">
                    </div>
                        
                    
                    <div class="informacoes">
                        <div class="texto">
                            Nome: <?php echo($rsPromocao["titulo"])?>
                        </div>
                        <div class="texto">
                            Descrição:<?php echo($rsPromocao["descricao"])?>
                        </div>
                        
                        <div class="precos" style="color:red">
                            De:<strike>R$<?php echo($rsPromocao["preco"])?> </strike>
                        </div>
                        
                        <div class="precos">
                            Por: R$<?php echo($rsPromocao["percentual_desconto" - "preco"])?>
                        </div>
                    </div>
                </div>
               
                <?php
                }
                ?>
            </section>
        </div>
    </body>
</html>