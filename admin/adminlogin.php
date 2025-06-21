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
    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);

    // Secure the inputs
    $user = $conn->real_escape_string($user);
    $pass = $conn->real_escape_string($pass);

    $sql = "SELECT * FROM adminaccount WHERE userName = '$user' AND passwrd = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: adminHome.html"); 
        exit();
    } else {
        header("Location: administrator.html");
        exit();
    }
}
$conn->close();