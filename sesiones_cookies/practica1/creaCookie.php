<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    setcookie ("idioma_seleccionado", $_GET["idioma"], time()+86400);
    //dos parámetros. el nombre de la cookie, y el valor que le pasamos desde la página principal
    //la que selecciona el idioma que selecciona el cliente. es o en

    header("location:ver_cookie.php");


?>
</body>
</html>