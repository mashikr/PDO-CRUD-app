<?php
    if(isset($_POST['insert'])) {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];

        try{
            require_once 'db.php';
            $sql = "INSERT INTO `users`(`first`, `last`, `phone`, `email`, `gender`, `age`) VALUES (:first, :last, :phone, :email, :gender, :age)";

            $insert = $con->prepare($sql);
            
            $insert->bindParam(':first', $first);
            $insert->bindParam(':last', $last);
            $insert->bindParam(':phone', $phone);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':gender', $gender);
            $insert->bindParam(':age', $age);

            $insert->execute();

        } catch (Exception $e) {
            echo $error = $e->getMessage();
        }
       
        header("Location: ../index.php");

    }
?>