<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("conexion.php");
        $Idvar=$_GET["Id"];
        $base->query("DELETE FROM DATOS_USUARIOSS WHERE ID='$Idvar'");
        header("Location:index.php");

    ?>
</body>
</html>