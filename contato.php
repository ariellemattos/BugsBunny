<?php
     //Local do banco
    $host="localhost";
    
    //Nome do banco
    $database="dbbugsbunny";
  
    //Usuario
    $user="root";
     
    //Senha
    $password="bcd127";

   if(!$conexao = mysqli_connect($host, $user, $password, $database))
        echo("Erro na conexão com banco de dados");

    if(isset($_POST["btnEnviar"])){
        $nome = $_POST["txtnome"];
        $telefone = $_POST["txttelefone"];
        $celular = $_POST["txtcelular"];
        $email = $_POST["txtemail"];
        $homePage = $_POST["txthomepage"];
        $facebook = $_POST["txtfacebook"];
        $sugestao = $_POST["txtsugestao"];
        $infoProduto = $_POST["txtinfoproduto"];
        $sexo = $_POST["txtsexo"];
        $profissao = $_POST["txtprofissao"];
        
         $sql = "INSERT INTO tbl_faleconosco
            (nome, telefone, celular, email, homePage, facebook, sugestao, infoProduto, sexo, profissao) 
            
            VALUES 
          
          ('".$nome."','".$telefone."', '".$celular."', '".$email."', '".$homePage."', '".$facebook."','".$sugestao."', '".$infoProduto."', '".$sexo."', '".$profissao."')
    ";
    
        
        mysqli_query($conexao, $sql);
        header('location:contato.php');
   
    }
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
            <div class="caixa_form">
                <div class="title_form">
                    <div class="texto_title">
                        Envie sua mensagem
                        
                        <div class="texto_info">
                            Envie sua pergunta. Em breve entraremos em contato.
                        </div>
                    </div>
                </div>
                
                <div class="fomulario">
                    <form name="frmFaleConosco" method="post" action="contato.php" >
                        <div class="informacoes_campo"> 
                            <div class="caixa_central">
                                
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Nome completo:</label>
                                    <p> <input type="text" name="txtnome" required> </p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Email:</label>
                                    <p> <input type="email" name="txtemail" required> </p>
                                </div> 
                            </div>
                            
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Telefone:</label>
                                    <p> <input type="text" name="txttelefone" placeholder="Ex.: (011) 0000-0000" pattern="\d{(3)} \d{4}-\d{4}$"> </p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Celular:</label>
                                    <p> <input type="text" name="txtcelular" required  placeholder="Ex.: (011) 00000-0000" pattern="\d{(3)} \d{5}-\d{4}$"> </p>
                                </div> 
                            </div>
                            
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Home page:</label>
                                    <p> <input type="text" name="txthomepage"> </p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Link do facebook:</label>
                                    <p> <input type="text" name="txtfacebook"> </p>
                                </div> 
                            </div>
                            
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Informações de produto: </label>
                                    <p> <textarea  cols="34" rows="3" name="txtinfoproduto"> </textarea></p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Sexo:</label>
                                    <p>
                                        <select name="txtsexo">
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                    </p>
                                </div> 
                                
                                 <div class="inseridos"> 
                                    <label> Profissão:</label>
                                    <p> <input type="text" name="txtprofissao" required> </p>
                                </div> 
                                
                                
                            </div>
                            
                                
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Sugestão/Criticas:</label>
                                    <p> <textarea cols="34" rows="3" name="txtsugestao"></textarea> </p>
                                </div> 
                                 <div class="inseridos"> 
                                   <input type="submit" name= "btnEnviar" value="Enviar">
                                </div> 
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer>© 2018 Todos os direitos reservados. </footer>
    </body>
</html>