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

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header navbar-defalt">
                <a class="navbar-brand" href="index.php">Akshay's CS143 DataBase Query System</a>
            </div>
        </div>
    </nav>
    <h1>
        <center> Welcome To CS143 Project 2! </center>
    </h1>
    <h2>
        <center> Movie Information Page
    </h2>
    </center>

    <?php
    // echo "The Movie ID input is: " . htmlspecialchars($_GET["id"]) . "<br>";
    $movieID = htmlspecialchars($_GET["id"]);
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    function showMovieInformation($movieID, $db)
    {
        $query = "select title, rating, company, genre, year from Movie inner join MovieGenre on id = mid where mid = " . $movieID;
        $rs = $db->query($query);
        $row = $rs->fetch_assoc();
        echo "Title :" . $row["title"] . "(" . $row["year"] . ")" . "<br>";
        echo "Producer :" . $row["company"] . "<br>";
        echo "MPAA Rating :" . $row["rating"] . "<br>";
        echo "Genre :" . $row["genre"] . "<br>";
    }

    function showMovieActors($movieID, $db)
    {
        $query = "select aid, first, last, role from MovieActor inner join Actor on MovieActor.aid = id where mid = " . $movieID;
        echo "<table>";
        echo "<tr>
                <th> Name  </th>
                <th> Role   </th>
            </tr>";
        $rs = $db->query($query);

        while ($row = $rs->fetch_assoc()) {
            $actorUrl = "actor.php?id=" . $row['aid'];
            echo "<tr>";
            echo "<th><a href='$actorUrl'>" . $row["first"] . " " . $row["last"] . "</a></th>";
            echo "<th>\"" . $row['role'] . "\"</th>";
            echo "</tr>";
        }

        echo "</table>";
    }

    function showUserReview($movieID, $db):
    {
        
    }

    echo "<h3>Movie Information is: <br> </h3>";
    showMovieInformation($movieID, $db);

    echo "<h3>Actors in this Movie: <br> </h3>";
    showMovieActors($movieID, $db);


    echo "<h3>User Review :<br></h3";


    ?>

</body>

</html>