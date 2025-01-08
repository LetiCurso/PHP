<!--a-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" type="text/css" href="hoja.css">

</head>

<body>

    <?php

    include("conexion.php");
    /*
DESGLOSADO LA SIGUIENTE LÍNEA

    $conexion=$base->query("SELECT * FROM DATOS_USUARIOS"); //CONEXIÓN ALMACENADA EN OTRO DOC, 
    $registros=$conexion->fetchAll(PDO::FETCH_OBJ); //TENER UN ARRAY DE OBJETOS

    */


    //----------------------------paginación-----------------------

    $tamagno_paginas=3; //muestra registros por páginas

    if(isset($_GET["pagina"])){ //solo se ejecuta si alguien pulsa en página (algún número de la paginación)
                if($_GET["pagina"]==1){
                    header("Location:index.php");
                }else{
                    $pagina=$_GET["pagina"];
                }
            }else{
                
            $pagina=1;//muestra la página en la que nos encontramos
            }
            
            $empezar_desde=($pagina-1)*$tamagno_paginas; //empieza en 1-1=0 0*3= 0 es el número que entra en limit.
            //si alguien pulsa en 3 sería 3-1=2 2*3= 6. empezaría a verse desde el registro 6. Habiendo 3 por visualización (6-7-8)
    
    
    
            $sql_total = "SELECT * /*Id, Nombre, Apellido, Direccion  */FROM DATOS_USUARIOSS /*WHERE Nombre='Antonio'||Id='2'*/";
            $resultado = $base->prepare($sql_total);
           $resultado->execute(array());
    
            $num_filas=$resultado->rowCount(); //cuenta las filas qu ehay dentro del Array(resultado)
            $total_paginas=ceil($num_filas/$tamagno_paginas); //ceil redondea hacia arriba entiendo//tengo 10 registros / numero registros por página = el númer de páginas totales (3.1)
    


//---------------------------------------código-------------------------------------------------



    $registros = $base->query("SELECT * FROM DATOS_USUARIOSS LIMIT $empezar_desde, $tamagno_paginas")->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST["cr"])){
        $nombre=$_POST["Nom"];//almacenas lo que el usuario escribe en el cuadro de texto
        $apellido=$_POST["Ape"];
        $direccion=$_POST["Dir"];
        $sql="INSERT INTO datos_usuarioss (Nombre, Apellido, Direccion) values(:nom, :ape, :dir)";
        //¿?por qué marcadores y no la variable que acabo de almacenar?

        $resultado=$base->prepare($sql);
        $resultado->execute(array(":nom"=>$nombre, ":ape"=>$apellido, ":dir"=>$direccion));
        header("Location:index.php");
    
    }
    ?>


    <h1>CRUD<span class="subtitulo"> Create Read Update Delete </span></h1>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"><!-- para insertar nuevos registros-->
    
    <table width="50%" border="0" align="center">
        <tr>
            <td class="primera_fila">Id</td>
            <td class="primera_fila">Nombre</td>
            <td class="primera_fila">Apellido</td>
            <td class="primera_fila">Dirección</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
            <td class="sin">&nbsp;</td>
        </tr>



        <?php
        /*VIEJO

foreach($registros as $personaPorEjemplo){ //por cada objeto que hay dentro del Array(registro), repiteme el código entre {}
}
*/

        foreach ($registros as $personaPorEjemplo): ?>



            <tr><!--QUIERES QUE SE REPITA TANTAS VECES COMO REGISTRO TENGAS ALMACENADO-->
                <td><?php echo $personaPorEjemplo->Id ?> </td>
                <td> <?php echo $personaPorEjemplo->Nombre ?></td>
                <td> <?php echo $personaPorEjemplo->Apellido ?></td>
                <td><?php echo $personaPorEjemplo->Direccion ?> </td>

                <td class="bot"><a href="borrar.php?Id=<?php echo $personaPorEjemplo->Id ?>"><input type='button' name='del' id='del' value='Borrar'></td>
                <td class='bot'><a href="editar.php?Id=<?php echo $personaPorEjemplo->Id ?> & nom= <?php echo $personaPorEjemplo->Nombre ?> & ape= <?php echo $personaPorEjemplo->Apellido ?> & dir= <?php echo $personaPorEjemplo->Direccion ?>" ><input type='button' name='up' id='up' value='Actualizar'></a></td>
            </tr>


        <?php
        endforeach;
        ?>



        <tr>
            <td></td>
            <td><input type='text' name='Nom' size='10' class='centrado'></td>
            <td><input type='text' name='Ape' size='10' class='centrado'></td>
            <td><input type='text' name='Dir' size='10' class='centrado'></td>
            <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr><!--submit_ envía el formulario-->
            <tr><td><?php
//--------------------------------PAGINACIÓN-------------------------------------

for($i=1; $i<=$total_paginas; $i++){
    echo " <a href='?pagina=" . $i . "'> " . $i . "</a>  ";
}
?></td></tr>

    </table>
</form>



    <p>&nbsp;</p>
</body>

</html>