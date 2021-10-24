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
                <a class="navbar-brand" href="./index.php">Akshay's CS143 DataBase Query System</a>
            </div>
        </div>
    </nav>
    <h1>
        <center> Welcome To CS143 Project 2! </center>
    </h1>
    <h2>
        <center> Actor Information Page </center>
    </h2>

    <?php
    // echo "The Actor ID input is: " . htmlspecialchars($_GET["id"]) . "<br>";
    $actorID = htmlspecialchars($_GET["id"]);
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }

    function showActorInformation($actorID, $db)
    {
        $query = "select first, last, sex, dob, dod from Actor where Actor.id = " . $actorID;
        echo "<table>";
        echo "<tr>
                <th> Name  </th>
                <th> Sex   </th>
                <th> Date Of Birth  </th>
                <th> Date Of Death  </th>
            </tr>";
        $rs = $db->query($query);

        while ($row = $rs->fetch_assoc()) {
            echo "<tr>";
            echo "<th>" . $row["first"] . " " . $row["last"] . "</th>";
            echo "<th>" . $row['sex'] . "</th>";
            echo "<th>" . $row['dob'] . "</th>";
            if (is_null($row['dod'])) {
                echo "<th>" . "Still Alive" . "</th>";
            } else {
                echo "<th>" . $row['dod'] . "</th>";
            }
            echo "</tr>";
        }


        echo "</table>";
    }

    function showActorRoles($actorID, $db)
    {
        $query = "select role, title, MovieActor.mid movieId from (Actor left join MovieActor on Actor.id = MovieActor.aid) left join Movie on MovieActor.mid = Movie.id where Actor.id = " . $actorID . ";";
        // echo $query . "<br>";
        $rs = $db->query($query);
        echo "<table>";
        echo "<tr>
                <th> Role  </th>
                <th> Movie Title </th>
            </tr>";
        while ($row = $rs->fetch_assoc()) {
            $movieUrl = "./movie.php?id=" . $row['movieId'];
            echo "<tr>";
            echo "<th>\"" . $row['role'] . "\"</th>";
            echo "<th> <a href='$movieUrl'>" . $row['title'] . "</a></th>";
            echo "</tr>";
        }
        echo "</table>";
    }

    echo "<h3>Actor Information is: <br> </h3>";
    showActorInformation($actorID, $db);
    echo "<h3>Actor's Movies and Role: <br> </h3>";
    showActorRoles($actorID, $db);
    $db->close();
    ?>

</body>

</html>