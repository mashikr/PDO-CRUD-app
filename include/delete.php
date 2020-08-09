<?php
if(isset($_GET['id'])) {
   $id = $_GET['id'];

   try{
        require_once 'db.php';
        $sql = "DELETE FROM `users` WHERE id = :id";

        $insert = $con->prepare($sql);
        
        $insert->bindParam(':id', $id);

        $insert->execute();

    } catch (Exception $e) {
        echo $error = $e->getMessage();
    }

        header("Location: ../index.php");
    }
?>