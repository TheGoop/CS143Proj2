<!DOCTYPE html>
<html>

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
            <input type="actor" name="actor" width="400 px">
            <input type="submit" name="submitActor" value="Search">
            <?php echo "\t\t"; ?>
            <label for="fname">Movie Name</label>
            <input type="movie" name="movie" width="400 px">
            <input type="submit" name="submitMovie" value="Search">
        </form>
        </form>
    </center>
</body>

<?php

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if (isset($_POST["submitActor"])) {
    redirect("./search.php?actor=" . $_POST["actor"]);
}

if (isset($_POST["submitMovie"])) {
    redirect("./search.php?movie=" . $_POST["movie"]);
}


$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
if (isset($_GET["actor"])) {
    $actor = htmlspecialchars($_GET["actor"]);
    $keywords = explode(" ", $actor);
    $query = "";
    for ($i = 0; $i < count($keywords); $i++) {
        $keyword = $keywords[$i];
        $defaultQuery = "select first, last, dob, id from Actor where first like '%{$keyword}%' or last like '%{$keyword}%' union ";
        $query = $query . $defaultQuery;
    }
    $query = $query . "select first, last, dob, id from Actor where 1 = 0";
    $rs = $db->query($query);
    echo "<br><table>";
    echo "<tr>
                <th> Name  </th>
                <th> Date of Birth </th>
            </tr>";
    while ($row = $rs->fetch_assoc()) {
        $actorUrl = "./actor.php?id=" . $row['id'];
        echo "<tr>";
        echo "<th><a href='$actorUrl'>" . $row["first"] . " " . $row["last"] . "</a></th>";
        echo "<th>" . $row['dob'] . "</th>";
        echo "</tr>";
    }
} else if (isset($_GET["movie"])) {
    $movie = htmlspecialchars($_GET["movie"]);
    $keywords = explode(" ", $movie);
    $query = "";
    for ($i = 0; $i < count($keywords); $i++) {
        $keyword = $keywords[$i];
        $defaultQuery = "select title, year, id from Movie where title like '%{$keyword}%' union ";
        $query = $query . $defaultQuery;
    }
    $query = $query . "select title, year, id from Movie where 1 = 0";
    $rs = $db->query($query);
    echo "<br><table>";
    echo "<tr>
                <th> Title  </th>
                <th> Year </th>
            </tr>";
    while ($row = $rs->fetch_assoc()) {
        $movieUrl = "./movie.php?id=" . $row['id'];
        echo "<tr>";
        echo "<th><a href='$movieUrl'>" . $row["title"] . "</a></th>";
        echo "<th><a href='$movieUrl'>" . $row['year'] . "</a></th>";
        echo "</tr>";
    }
}


$db->close();
?>


</html>