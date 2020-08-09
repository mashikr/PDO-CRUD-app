<?php
    $id = $_GET['id'];
    try{
        require_once 'db.php';
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $con->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $result->bindColumn('first', $first);
        $result->bindColumn('last', $last);
        $result->bindColumn('phone', $phone);
        $result->bindColumn('email', $email);
        $result->bindColumn('gender', $gender);
        $result->bindColumn('age', $age);
        $errorInfo = $con->errorInfo();
        if(isset($errorInfo[2])) {
            echo "Error: " . $error = $errorInfo[2];
        }

    } catch (Exception $e) {
        echo $error = $e->getMessage();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>PDO (CRUD) app edit page</title>
</head>
<body>
    <div class="container">
        <a class="position-absolute" href="../index.php">Home page</a>
        <div class="display-4 text-center">Edit data</div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-8">
            <?php  while ($row = $result->fetch()) { ?>
            <form action="" method="post">
                <label for="first">First Name:</label>
                <input type="text" class="form-control" name="first" value = "<?php echo $first ?>" placeholder="Enter first name" required>
                <label for="last">Last Name:</label>
                <input type="text" class="form-control" name="last" value = "<?php echo $last ?>" placeholder="Enter last name" required>
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" value = "<?php echo $phone ?>" placeholder="Enter phone" required>
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value = "<?php echo $email ?>" placeholder="Enter email" required>
                <div class="d-flex py-2 align-items-center">
                    <label for="gender">Gender:</label>
                    <div class="ml-3"><input type="radio" <?php if($gender == "Male") {echo "checked";} ?> name="gender" value="Male" required> Male</div>
                    <div class="ml-3"><input type="radio" <?php if($gender == "Female") {echo "checked";} ?> name="gender" value="Female" required> Female</div>
                </div>
                <label for="age">Age:</label>
                <input type="number" class="form-control" name="age" value = "<?php echo $age ?>" placeholder="Enter age" min="1" required>
                <button class="btn btn-primary mt-3" name="update" type="submit">Update</button>
            </form>
            <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST['update'])) {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];

        try{
            require_once 'db.php';
            $sql = "UPDATE `users` SET `first`= :first,`last`= :last,`phone`= :phone,`email`= :email,`gender`= :gender,`age`= :age WHERE `id`= :id";

            $update = $con->prepare($sql);

            $values = array(
                ':first' => $first,
                ':last' => $last,
                ':phone' => $phone,
                ':email' => $email,
                ':gender' => $gender,
                ':age' => $age,
                ':id' => $id
            );

            echo $test = $update->execute($values);
            

        } catch (Exception $e) {
            echo $error = $e->getMessage();
        }
       
        header("Location: edit.php?id={$id}");

    }
?>