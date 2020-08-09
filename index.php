<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>PDO (CRUD) app</title>
</head>
<body>
    <div class="container">
     <div class="display-4 text-center">Data (CRUD) app</div>
     <hr>
     <div class="row">
        <div class="col-lg-3 pb-3">
            <div class="text-center"><h4>Data Entry</h4><hr></div>
            <form action="include/insert.php" method="post">
            <label for="first">First Name:</label>
            <input type="text" class="form-control" name="first" placeholder="Enter first name" required>
            <label for="last">Last Name:</label>
            <input type="text" class="form-control" name="last" placeholder="Enter last name" required>
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter phone" required>
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" placeholder="Enter email" required>
            <div class="d-flex py-2 align-items-center">
                <label for="gender">Gender:</label>
                <div class="ml-3"><input type="radio" name="gender" value="Male" required> Male</div>
                <div class="ml-3"><input type="radio" name="gender" value="Female" required> Female</div>
            </div>
            <label for="age">Age:</label>
            <input type="number" class="form-control" name="age" placeholder="Enter age" min="1" required>
            <button class="btn btn-primary mt-3" name="insert" type="submit">Submit</button>
            </form>
        </div>
        <div class="col border-left">
            <table class="table table-sm table-responsive-sm table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Age</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                        <!-- <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>012334</td>
                        <td>email@gmail.com</td>
                        <td>Male</td>
                        <td>22</td>
                        <td><button class="btn btn-warning">Edit</button></td>
                        <td><button class="btn btn-danger">Delete</button></td>
                        </tr> -->
                        <?php
                            try{
                                require_once 'include/db.php';
                                $sql = "SELECT * FROM users";
                                $result = $con->prepare($sql);
                                $result->execute();
                                $result->bindColumn('id', $id);
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

                            while ($row = $result->fetch()) {
                                echo '<tr><th scope="row">' . $id . '</th>
                                <td>' . $first . '</td>
                                <td>' . $last . '</td>
                                <td>' . $phone . '</td>
                                <td>' . $email . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $age . '</td>
                                <td><a class="btn btn-warning" href="include/edit.php?id=' . $id . '">Edit</a></td>
                                <td><a onclick="javascript: return confirm(\'Are you sure want to delete?\');" class="btn btn-danger" href="include/delete.php?id=' . $id . '" >Delete</a></td></tr>';
                            }
                            
                        ?>
                </tbody>
            </table>
        </div>
     </div>
    </div>
</body>
</html>