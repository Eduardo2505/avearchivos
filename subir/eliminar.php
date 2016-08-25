<?php

session_start();

include 'conexion.php';



        $sql = "DELETE FROM archivos WHERE idarchivos=".$_GET["idarchivo"].";";
		
		
        if ($conn->query($sql) === TRUE) {
			
          $conn->close();


           header('Location: anexos.php?idregistro='.$_GET["idregistro"].'');
		   
		   
        } 
  

?>