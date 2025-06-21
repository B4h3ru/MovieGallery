<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moviegallery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieinfo_id = htmlspecialchars($_POST['movieId']);
    $content_id = htmlspecialchars($_POST['movieId']);

    $sql1 = "delete from moviecontent where Movie_Id=".$content_id;
    $conn->query($sql1);
    $sql2 = "delete from movieinfo where Movie_Id=".$movieinfo_id;
    $conn->query($sql2);

    echo "<h1>The movie is Successfully deleted </h1>";
    echo "<h1> Back to Update movie <a href='updatemovie.php'>Click Here</a></h1>";
}
$conn->close();
?>