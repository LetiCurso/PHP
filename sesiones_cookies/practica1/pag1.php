<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body><!--página de las banderas, saber si se ha creado la cookie para llevarte a un idioma u otro-->

<?php

if(isset($_COOKIE["idioma_seleccionado"])){
   
    if($_COOKIE["idioma_seleccionado"]=="es"){
    header("Location:spanish.php");
    }else if($_COOKIE["idioma_seleccionado"]=="en"){
     header("Location:english.php");
    }
}



?>


    <table width="25%" border="0" align="center">
        <tr>
            <td colspan="2" align="center"><h1>Elige idioma</h1>
         </tr>
         <tr>
            <td align="center"><a href="creaCookie.php?idioma=es"><img src="img/esp.gif" width="90" height="60"></a></td>
            <td align="center"><a href="creaCookie.php?idioma=en"><img src="img/ing.gif" width="90" height="60"></a></td>
        </tr>
    </table>
  
    <p>&nbsp;</p>
    <p>&nbsp;</p>

</body>
</html>