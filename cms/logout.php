<?php
    session_start();
    $token = md5(session_id());
    if(isset($_GET['token']) && $_GET['token'] === $token) {        
        // limpe tudo que for necessário na saída.:
       session_destroy();
       header("location:../index.php");
       exit();
    }

?>