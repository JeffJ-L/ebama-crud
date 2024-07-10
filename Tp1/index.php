<?php

require_once('Classe/CRUD.php');

$crud = new CRUD;
$select = $crud->select('etudiant');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Student Index</title>
</head>
<body>
    <h1>Student</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>zip_code</th>
                <th>Email</th>
                <th>Cours</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($select as $row) {
                ?>
                <tr>
                    <td><a href="student-show.php?id=<?=$row['id'];?>"><?=$row['name']; ?></a></td>
                    <td><?=$row['address']; ?></td>
                    <td><?=$row['phone']; ?></td>
                    <td><?=$row['zip_code']; ?></td>
                    <td><?=$row['email']; ?></td>
                    <td><?=$row['cours']; ?></td>
                    <td><a class="btn" href="student-show.php?id=<?= $row['id'];?>">Edit</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="student-create.php" class="btn">Add a new student</a>
</body>
</html>