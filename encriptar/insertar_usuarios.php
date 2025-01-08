<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $usuario=$_POST["usu"];
        $contraseña=$_POST["contra"];
        $pass_cifrado=password_hash($contraseña, PASSWORD_DEFAULT, array ("cost"=>12));

            try{
        $base=new PDO ('mysql:host=localhost; dbname=pruebas', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $base->exec("SET CHARACTER SET utf8");
        $sql="INSERT INTO usuarios_pass (USUARIOS, PASSWORD) VALUES (:usu, :contra)";
        $resultado=$base->prepare($sql);
        $resultado->execute (array(":usu"=>$usuario, ":contra"=>$pass_cifrado));
        
                echo "Registro insertado";
                $resultado->closeCursor();
            
                    }catch(Exception $e){
                    die("Error:" . $e->GetMessage());//para ir a un método de excepción
            
                    }finally {//vaciar la memoria de lo que no necesitas
            
                    $base=null;
            
            
                    }
    
    ?>
</body>
</html>