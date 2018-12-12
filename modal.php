<?php
    
    session_start();
    require_once('conexao.php');
    $conexao = conexaoDB();

    $codigo = $_POST['idRegistro'];

    $sql = "select * from tbl_produtos where id=".$codigo;

    $select = mysqli_query($conexao, $sql);

    if($rsProdutos = mysqli_fetch_array($select)){
        $titulo = $rsProdutos['titulo'];
        $descricao =$rsProdutos['descricao'];
        $preco = $rsProdutos['preco'];
        $imagem = $rsProdutos ['imagem'];
        
    }

?>


<html>
    <head>
        <title>
            Modal 
        </title>
        <link rel = "stylesheet" type="text/css" href="css_modal/style.css">
        
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
        <a href="#" class="fechar">
            <img class="icone_fechar" src="cms/imagens/fechar.png">
        </a>
        
        <div class="cadastro_produtos">
            <form name="frmProdutos" method="post" action="cadastro_produto.php" enctype="multipart/form-data">                    
                <div class="imagem_produto"> 
                    <img src="cms/<?php echo($imagem)?>">
                </div>
                
                <div class="area_cadastro_produto">
                     <label> <strong> Titulo: </strong> </label>
                    <p> <input readonly type="text" name="txttitulo" value="<?php echo($titulo)?>"></p>

                    <label> <strong> Descrição: </strong> </label>

                    <p>

                    <textarea readonly cols="40" rows="9" name="txtdescricao" required><?php echo($descricao)?></textarea>
                    </p>

                   <label> <strong> Preço do produto: </strong> </label>
                    <p> <input readonly type="text" name="txtpreco" value="R$ <?php echo($preco)?>" R$></p>

                </div> 
            </form>
        </div>
    </body>
</html>