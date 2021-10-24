<!DOCTYPE html>
<html>

<body>

    <h1>Make A Review!</h1>

    <form action="/review.php">
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
        <input type="button" onclick="formSubmit(event)" value="Rating it!!">
    </form>

    <!-- Welcome
    <?php echo $_GET["name"]; ?><br>
    Your email address is:
    <?php echo $_GET["rating"]; ?> -->
    Welcome
    <?php

    ?>

</body>

</html>