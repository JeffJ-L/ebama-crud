<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Create Student</title>
</head>
<body>
    <div class="container">
        <form action="student-store.php" method="post">
            <label>Name
                <input type="text" name="name">
            </label>
            <label>Address
                <input type="text" name="address">
            </label>
            <label>Phone
                <input type="text" name="phone">
            </label>
            <label>ZipCode
                <input type="text" name="zip_code">
            </label>
            <label>Email
                <input type="text" name="email">
            </label>
            <label>Cours suivi
                <input type="text" name="cours">
            </label>
            <input class="btn" type="submit" value="Save">
        </form>
    </div>
</body>
</html>