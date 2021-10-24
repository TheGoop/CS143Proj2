<!DOCTYPE html>
<html>

<body>
    <h1>Make A Search!</h1>

    <form method="post">
        <label for="fname">Actor Name</label>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Search">
    </form>
</body>

<?php

if ($_POST['name']) {
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
        $movieUrl = "review.php?id={$row['mid']}";
        echo "Thanks for your comment! Your review has been successfully added. ";
        echo "<a href='$movieUrl'>click this to go back to see the movie</a><br>";
    }

    $db->close();
}
?>


</html>