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
    <h1>INTRODUCE DATOS</h1>
    <form action="login_hash.php" method="post">
        <table><tr>
        <td>Login:</td><td><input type="text" name="login"></td></tr>
        <tr>
        <td>Password</td><td><input type="text" name="password" id="password"></td></tr>
        <tr><td colspan="2"><input type="submit" name="enviar" value="LOGIN!">
    </td>
    </tr></table></form>
    
</body>
</html>