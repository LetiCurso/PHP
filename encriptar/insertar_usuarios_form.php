<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            width:300px;
            margin:auto;
            background-color:#FFC;
            border:2px solid #F00;
            padding:5px;

        }

        td{
            text-align:center;
        }
        h1{
            text-align:center
        }

        </style>
</head>
<body>
    <h1>REGISTRATE</h1>
    <form action="insertar_usuarios.php" method="post">
        <table><tr>
        <td>Usuario</td><td><input type="text" name="usu" id="usu"></td></tr>
        <tr>
        <td>Contraseña</td><td><input type="text" name="contra" id="contra"></td></tr>
        <tr><td colspan="2"><input type="submit" name="enviando" value="Dale!">
    </td>
    </tr></table></form>
    
</body>
</html>