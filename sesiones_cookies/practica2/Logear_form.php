<!-- https://localhost/CursoPHP/sesiones_cookies/practica2/Logear_form.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
<style>
    h1,h2{text-align:center;
    }

    table{
        width:25%;
        background-color:#FFC;
        border: 2px dotted #F00;
        margin:auto;
    }
    .izq{text-align:right;
    }

    .der{text-align:left;
    }

    td{text-align:center;
        padding:10px;
    }
</style>

</head>
<body>

<?php

$autenticado=false;

if(isset($_POST["enviar"])){//preguntar si hemos pulsado el botón de enviar para poder entrar al código
    
//try catch para que intente conectarse BBDD y si no tiene exito muestre excepción
try{

$base=new PDO("mysql:host=localhost;dbname=pruebas", "root", ""); //conexión
$base->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//prueba leti no va.
//$sql="INSERT INTO usuarios_pass (USUARIOS, PASSWORD) VALUES ('Leticia','33')";



$sql="SELECT * FROM usuarios_pass WHERE USUARIOS=:login and PASSWORD=:password"; //: para marcadores
//mira en la bbdd si usuario existe o no.

$resultado=$base->prepare($sql); //consulta oreoarada con marcadores. conexión llama a la función prepare.



$login=htmlentities(addslashes($_POST["login"]));  //evitar inyección SQL
$password=htmlentities(addslashes($_POST["password"]));

//AHORA HAY QUE RELACIONAR MARCADORES DE CONSULTA SQL CON LO QUE GUARDAMOS DEL FORMULARIO EN VARIABLES

$resultado->bindValue(":login", $login);
$resultado->bindValue(":password", $password);
$resultado->execute(); // para que ejecute búsqueda
$numero_registro=$resultado->rowCount();


if($numero_registro!=0){ //comprueba si los datos son correctos y por lo tanto entra en la pág
    $autenticado=true;
    if(isset($_POST["recordar"])){ //si ha activado casilla recordar se activa cookie
        setcookie("nombre_usuario",$_POST["login"],time()+86400); //se guarda el login, y por lo tanto próximas sesiones entra
    }

}else{
    echo "Usuario/contraseña incorrectos. No registrado";
}

}catch (Exception $e){
die("Error: " . $e->getMessage());

}
}
?>

<?php


if($autenticado==false){ //si el login no ha tenido éxito
    //opción 1 entras en pag, autenticado false, entra y lee formulario
    //opción 2 te registras, autenticado true, no hay cookie, MUESTRA el formulario otra vez.
    //opción 3. te registras RECUERDAS, autenticado false, !isset si hay cookie, el incluide no lo lee. se sale 

    if(!isset($_COOKIE["nombre_usuario"])){
        include("formulario.html");
    }
}
if(isset($_COOKIE["nombre_usuario"])){
    echo "Hola " . $_COOKIE["nombre_usuario"];
}else if($autenticado==true){
    echo "Hola " . $_POST["login"];
}
?>

<h2>CONTENIDO DE LA WEB</h2>
<table width="800"border="0">
    <tr>
        <td><img src="imagenes/1.jpg" width="300" height="166"></td>
        <td><img src="imagenes/2.jpg" width="300" height="171"></td>
    </tr>
    <tr>
        <td><img src="imagenes/3.jpg" width="300" height="166"></td>
        <td><img src="imagenes/4.jpg" width="300" height="197"></td>
    </tr>
</table>
<?php
if($autenticado==true || isset($_COOKIE["nombre_usuario"])){// login o cookie creada
    include("info_add.php");

}
?>

</body>
</html>