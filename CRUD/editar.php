<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ACTUALIZAR</h1>

<?php

include("conexion.php");
if(!isset($_POST["bot_actualizar"])){ //si no has pulsado el botón actualizar ejecutas lo que hay dentro.
$Id=$_GET["Id"];//lo rescata de la URL, está en el parámetro de index
$nom=$_GET["nom"];
$ape=$_GET["ape"];
$dir=$_GET["dir"];

}else{
    //código a realizar al pulsar actualizar
    $Id=$_POST["id"]; //no lo ve, pero necesito el dato para el criterio por eso lo pone
    $nom=$_POST["nom"];
    $ape=$_POST["ape"];
    $dir=$_POST["dir"];
    $sql="UPDATE DATOS_USUARIOSS SET Nombre=:miNom, Apellido=:miApe, Direccion=:miDir WHERE Id=:miId";
    $resultado=$base->prepare($sql);
    $resultado->execute(array(":miId"=>$Id, ":miNom"=>$nom, ":miApe"=>$ape, ":miDir"=>$dir));
    header("Location:index.php");

}
?>
    <P></P>

    <p> &nbsp;</p>

    <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table width="25%" border="0" align="center">
            <tr>
                <td></td>
                <td><label for="id"></label>
                <input type="hidden" name="id" id="id" value="<?php echo $Id ?>"></td> <!--valor existe pero no se puede ver ni editar-->
            </tr>
            <tr>
                <td>Nombre</td>
                <td><label for="nom"></label>
                <input type="text" name="nom" id="nom" value="<?php echo $nom ?>"></td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td><label for="ape"></label>
                <input type="text" name="ape" id="ape" value="<?php echo $ape ?>"></td>
            </tr>
            <tr>
                <td>Dirección</td>
                <td><label for="dir"></label>
                <input type="text" name="dir" id="dir" value="<?php echo $dir ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="bot_actualizar" id="bot_actualizar" value="Actualizar"></td>
            </tr>
        </table>
    </form>

</body>
</html>