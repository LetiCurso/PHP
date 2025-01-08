<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

             try{
                $login=htmlentities(addslashes($_POST["login"]));
                $password=htmlentities(addslashes($_POST["password"]));
                $contador=0; //para saber si está en baseDatos


        $base=new PDO ('mysql:host=localhost; dbname=pruebas', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $base->exec("SET CHARACTER SET utf8");

        $sql="SELECT * FROM usuarios_pass WHERE USUARIOS= :login";
        $resultado=$base->prepare($sql);
        $resultado->execute(array(":login"=>$login));
 
                while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){ 
                    echo "Usuario:" . $registro['USUARIOS'] . "Contraseña: " . $registro['PASSWORD'];
                    //función para recorrer asociativo
                    
                   if (password_verify($password, $registro['PASSWORD'])) {
                        echo "Usuario autenticado: " . htmlspecialchars($registro['USUARIOS']);
                   }
                }  
                
                 if($contador>0){
                    echo "Usuario registrado";
                    
                 }  else{
                    echo "Usuario no registrado";
                 }
                       
                
                $resultado->closeCursor();
            
                } 
            catch(Exception $e){
                die("Error:" . $e->GetMessage());//para ir a un método de excepción
        
                }finally {//vaciar la memoria de lo que no necesitas
        
                $base=null;
        
        
                }
            
            
                
    
    ?>
</body>
</html>