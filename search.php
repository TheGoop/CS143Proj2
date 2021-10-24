<!DOCTYPE html>
<html>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header navbar-defalt">
                <a class="navbar-brand" href="./index.php">Akshay's CS143 DataBase Query System</a>
            </div>
        </div>
    </nav>
    <h1>
        <center> Welcome To CS143 Project 2! </center>
    </h1>
    <center>
        <h2>Make A Search!</h2>
        <form method="post">
            <label for="fname">Actor Name</label>
            <input type="text" name="name" width="400 px">
            <input type="submit" name="submit" value="Search">
        </form>
    </center>
</body>

<?php

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if (isset($_POST["submit"])) {
    redirect("./search.php?actor=" . $_POST["name"]);
}


$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
if (isset($_GET["actor"])) {
    $name = htmlspecialchars($_GET["actor"]);
    $query = "";
}


$db->close();
?>


</html>