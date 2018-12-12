<?php

session_start();
 require_once('conexao.php');
    $conexao = conexaoDB();

    $codigo = $_POST['idRegistro'];
   
    $sql = "select * from tbl_faleconosco where id=".$codigo;

    $select = mysqli_query($conexao, $sql);

    
    if($rsContatos = mysqli_fetch_array($select)){
        
        //Resgatando as variaveis
        $nome = $rsContatos['nome'];
        $telefone = $rsContatos['telefone'];
        $celular = $rsContatos['celular'];
        $email = $rsContatos['email'];
        $homePage = $rsContatos['homePage'];
        $facebook = $rsContatos['facebook'];
        $sugestao = $rsContatos['sugestao'];
        $infoProduto = $rsContatos['infoProduto'];
        $sexo = $rsContatos['sexo'];
        $profissao = $rsContatos['profissao'];
    }

?>


<html>
    <head>
        <title>
            Modal 
        </title>
        <link rel = "stylesheet" type="text/css" href="css/style.css">
        <script>
            $(document).ready(function(){
                //function para fechar a modal
                
               $('.fechar').click(function(){
                  $('.container').fadeOut(400);
               });
            });
        </script>
        
    </head>
    
    <body>
        <a href="#"class="fechar">
            <img src="imagens/fechar.png" width="20px"  height="20px">
        </a>
        
<!--        Formularios para mostrar o conteudo na modal-->
           <div class="fomulario">
                    <div class="informacoes_campo"> 
                        <div class="caixa_central">
                                
                        <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Nome completo:</label>
                                    <p> <input readonly value="<?php echo($nome)?>"> </p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Email:</label>
                                    <p> <input readonly value="<?php echo($email)?>"> </p>
                                </div> 
                            </div>
                            
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Telefone:</label>
                                    <p> <input readonly value="<?php echo($telefone)?>"> </p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Celular:</label>
                                    <p> <input readonly value="<?php echo($celular)?>"> </p>
                                </div> 
                            </div>
                            
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Home page:</label>
                                    <p> <input readonly value="<?php echo($homePage)?>"> </p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Link do facebook:</label>
                                    <p> <input readonly value="<?php echo($facebook)?>"> </p>
                                </div> 
                            </div>
                            
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Informações de produto: </label>
                                    <p> <textarea readonly cols="34" rows="3"><?php echo($infoProduto) ?></textarea></p>
                                </div> 
                                
                                <div class="inseridos"> 
                                    <label> Sexo:</label>
                                    <p>
                                       <input readonly value="<?php echo($sexo)?>">
                                    </p>
                                </div> 
                                
                                 <div class="inseridos"> 
                                    <label> Profissão:</label>
                                    <p> <input readonly value="<?php echo($profissao)?>"> </p>
                                </div> 
                                
                                
                            </div>
                            
                                
                            <div class="text_input">
                                <div class="inseridos"> 
                                    <label> Sugestão/Criticas:</label>
                                    <p><textarea readonly cols="34" rows="3"><?php echo($sugestao)?></textarea></p>
                                </div> 
                            </div>
                        </div>
                    </div>
             </form>
         </div>
    </body>
</html>