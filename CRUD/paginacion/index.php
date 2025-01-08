<!--https://localhost/CursoPHP/CRUD/paginacion/-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    try {
        $base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");
        //VARIABLES 
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



        $sql_total = "SELECT Id, Nombre, Apellido, Direccion  FROM DATOS_USUARIOSS /*WHERE Nombre='Antonio'||Id='2'*/";
        $resultado = $base->prepare($sql_total);
       $resultado->execute(array());

        $num_filas=$resultado->rowCount(); //cuenta las filas qu ehay dentro del Array(resultado)
        $total_paginas=ceil($num_filas/$tamagno_paginas); //ceil redondea hacia arriba entiendo//tengo 10 registros / numero registros por página = el númer de páginas totales (3.1)

        echo "Número de registros de la consulta: " . $num_filas . "<br>";
        echo "Mostramos: " . $tamagno_paginas . " registros por página <br>";
        echo "Mostrando la página: " . $pagina . " de " . $total_paginas . "<br>";
echo "<br><br>";
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

            echo "Nombre: " . $registro["Nombre"] . " " . $registro["Apellido"]  . " " . $registro["Direccion"] . "<br>";
       
       
        }
        echo "<br><br>";
        $resultado->closeCursor();
        $sql_limite="SELECT Id, Nombre, Apellido, Direccion  FROM DATOS_USUARIOSS LIMIT $empezar_desde, $tamagno_paginas";
        $resultado = $base->prepare($sql_limite);
        $resultado->execute(array());
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

            echo "Nombre: " . $registro["Nombre"] . " " . $registro["Apellido"]  . " " . $registro["Direccion"] . "<br>";

        }
    } catch (Exception $e) {

        echo "Línea de error: " . $e->getLine();
    }

//------------------------------------PAGINACIÓN_-----------------------------

for($i=1; $i<=$total_paginas; $i++){
    echo " <a href='?pagina=" . $i . "'> " . $i . "</a>  ";
}


    ?>
</body>

</html>