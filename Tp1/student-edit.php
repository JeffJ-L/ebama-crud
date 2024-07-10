<?php
if(isset($_GET['id']) && $_GET['id'] != null) {
    $id = $_GET['id'];
    require_once('Classe/CRUD.php');

    $crud = new CRUD;
    $selectId = $crud->selectId('etudiant', $id);

    if($selectId){
        foreach( $selectId as $key=>$value){
            $$key =$value;
        }
    }else {
        header('location:index.php');
        exit;
    } 
}else {
    header('location:index.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit a student</title>
</head>
<body>
    <div class="container">
        <form action="student-update.php" method="post">
            <h2>Edit a student</h2>
            <input type="hidden" name="id" value="<?= $id;?>">
            <label>Name
                <input type="text" name="name" value="<?= $name;?>">
            </label>
            <label>Address
                <input type="text" name="address" value="<?= $address;?>">
            </label>
            <label>Phone
                <input type="text" name="phone" value="<?= $phone;?>">
            </label>
            <label>ZipCode
                <input type="text" name="zip_code" value="<?= $zip_code;?>">
            </label>
            <label>Email
                <input type="text" name="email" value="<?= $email;?>">
            </label>
            <label>Email
                <input type="text" name="cours" value="<?= $cours;?>">
            </label>
            <input class="btn" type="submit" value="Save">
        </form>
    </div>
</body>
</html>