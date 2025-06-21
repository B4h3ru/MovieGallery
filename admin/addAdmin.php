<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password_confirmation = htmlspecialchars($_POST['confirmpassword']);
    

    $conn = new mysqli('localhost','root','','moviegallery');
    if($conn->connect_error){
    die("".$conn->connect_error);
    }
    else{
        // echo " succefully connected<br>";
        $stmt = $conn->prepare("insert into adminaccount(firstname,lastname,email,username,passwrd)
        values(?,?,?,?,?)");
        $stmt->bind_param("ssssd",$firstname,$lastname,$email,$username,$password);
        if($password==$password_confirmation){
            $stmt->execute();
            echo "<h1>Admin account is successfuly created.</h1>";
            echo "<h1>back to <a href='AdminHome.html'>Home</a></h1>";
            $stmt->close();
            $conn->close();
        }else{
            echo "<h1>Password missmatch <br>please back and Enter matched value for password and confrim password</h1>";
        }
    }
  }
  else{
    echo "<h1>Invalid request method</h1>";
  }
