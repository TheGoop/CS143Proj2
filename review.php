<!DOCTYPE html>
<html>
<?php
// report all PHP errors
error_reporting(E_ALL);

// display error messages in the output page
ini_set("display_errors", "1");

// log error messages in /tmp/php-error.log
ini_set("log_errors", "1");
ini_set("error_log", "/tmp/php-error.log");
?>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>Make A Review!</h1>

    <form method="post">
        <label for="fname">Your name</label>
        <input type="text" name="name" value="Mr. Anonymous"><br><br>
        <label for="lname">Rating</label>
        <select name="rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select> <br> <br>
        <textarea name="comment" rows="10" cols="100" placeholder="no more than 500 characters"></textarea><br><br>
        <!-- <input type="hidden" name="mid" value=<?= $movieID; ?>> -->
        <input type="submit" name="submit" value="Rating it!!">
    </form>
</body>

<?php

if (isset($_POST['name']) and isset($_POST['rating']) and isset($_POST['comment']) and isset($_GET['id'])) {
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    $id = $_GET['id'];
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $query = "insert into Review values ('$name', now(), $id, $rating, '$comment')";
    $rs = $db->query($query);
    if ($rs) {
        $movieUrl = "movie.php?id=$id";
        echo "Thanks for your comment! Your review has been successfully added. ";
        echo "<a href='$movieUrl'>click this to go back to see the movie</a><br>";
    }

    $db->close();
}
?>


</html>