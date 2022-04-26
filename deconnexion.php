<!DOCTYPE html>
<html>
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head> 
     
    <body>
    <?php
        session_start();
        session_destroy();
        header('location: accueil.php'); 
    ?>



</body>
</html>