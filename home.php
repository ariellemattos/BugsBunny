<?php
    require_once('conexao.php');

    session_start();

    $conexao = conexaoDB();

    $sqlProdutos  = "SELECT * FROM tbl_produtos WHERE id > 0 and status = 1";

    if (isset($_GET['modo'])){

        $modo = $_GET['modo'];

    // Variável que recebe o id do modo
        $id = $_GET['id'];

    if ($modo == "categoria")
        $sqlProdutos =  "SELECT * FROM tbl_produtos AS PRODUTO, tbl_categoria_sub AS subcategoria, tbl_categoria AS categoria WHERE  subcategoria . categoria_id  = '".$id."'  AND categoria.categoria_id = '".$id."' AND subcategoria.sub_id = produto.sub_id";

    else if ($modo == "subcategoria")
        $sqlProdutos = $sqlProdutos." AND sub_id= ".$id;

    }

    $sqlProdutos = $sqlProdutos." ORDER BY RAND()";


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

         <script>
                $(document).ready(function(){
                    //Function para abrir a janela Modal
                    $(".visualizar").click(function(){
                        //toogle, slideToogle, slideDown, slideUp, fadeIn, fadeOut
                        $(".container").fadeIn(1100);
                    });
                });

              function modal(idItem){

                   $.ajax({
                type: "POST",
                url: "modal.php",
                data:{idRegistro:idItem},
                success: function(dados){
                    //alert(dados);
                    $('.modal').html(dados);
                }

                })
            }
        </script>
	</head>
    <body>
        <header>
            <div class="logo"></div>

            <div class="menu">
                <nav>
                <div class="submenu">
                     <a href="home.php">
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

        <div class="container">
            <div class="modal">

            </div>
        </div>
        <div id="principal">
            <div id="imagens">
                <ul>
                    <li>
                        <img class="slide_img" src="img/slide1.jpg" alt="imagem01" title=""/>
                    </li>

                    <li>
                        <img class="slide_img" src="img/slide2.png" alt="imagem02" title="imagem02"/>
                    </li>

                    <li>
                        <img class="slide_img" src="img/slider3.jpg" alt="imagem03" title="imagem03"/>
                    </li>
                 </ul>
            </div>

            <div class="menu_lateral">

                <?php
                    $sql = "SELECT * FROM tbl_categoria tbl_categoria WHERE status = 1";
                    $select = mysqli_query($conexao, $sql);

                    while($rsCategoria = mysqli_fetch_array($select)){

                ?>
                <a href="home.php?modo=categoria&id=<?= $rsCategoria['categoria_id']?>">
                    <div class="sub_lateral">
                       <?php echo($rsCategoria['categoria_name'])?>
                        <div class="sub_conteudo">
                              <?php
                                    // Variável que recebe o SELECT do banco
                                    $sqlSubcategoria = " SELECT * FROM tbl_categoria_sub WHERE categoria_id = '".$rsCategoria['categoria_id']."' AND status = 1 " ;

                                    // Variável que executa o SELECT
                                    $selectSubcategoria = mysqli_query($conexao, $sqlSubcategoria);

                                    // Loop para pegar cada registro não SELECT e colocar em um array
                                    while ($rsSubcategoria = mysqli_fetch_array($selectSubcategoria)){
                            ?>

                            <a href="home.php?modo=subcategoria&id=<?=$rsSubcategoria['sub_id']?>">
                                <div class="sub_itens">
                                    <?php echo($rsSubcategoria['sub_name']) ?>
                                </div>
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </a>

                <div class="linha"> </div>

                <?php
                }
                ?>
            </div>

            <section class="conteudo">
                <form name="frmPesquisa" name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?modo=buscar" >
                    <div class="pesquisa">
                      <input type="text" name="palavra" id="txtBusca" placeholder="Buscar..."/>
                    <input type="submit" id="btnBusca" value="Buscar" />
                    </div>
                </form>



               <div class="sessao">
                    <?php

                    $selectProdutos  =  mysqli_query($conexao, $sqlProdutos);

                    while ($rsProdutos  =  mysqli_fetch_array($selectProdutos)){
                    ?>
                        <div class="produtos">
                            <div class="foto">
                                <img src="cms/<?php echo($rsProdutos["imagem"])?>">
                            </div>

                            <div class="informacoes">
                                <div class="titulo_livro">
                                    <?php echo($rsProdutos['titulo'])?>
                                </div>

                                <div class="preco">
                                   R$ <?php echo($rsProdutos['preco'])?>
                                </div>

                                <div class="titulo_detalhes visualizar" onclick="modal(<?php echo($rsProdutos['id'])?>)">

                                       Mais detalhes

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

        </section>
        </div>
        </div>
        <footer>© 2018 Todos os direitos reservados. </footer>
    </body>
</html>
