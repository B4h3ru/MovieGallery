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
    $movieinfo_id = htmlspecialchars($_POST['id']);
    $content_id = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);
    $length = htmlspecialchars($_POST['length']);
    $noactor = htmlspecialchars($_POST['noactor']);
    $category = htmlspecialchars($_POST['category']);
    // $vido = htmlspecialchars($_POST['video']);
    // $postr = htmlspecialchars($_POST['poster']);

    if( $category=="Action"){
        $sql2 = "update  movieinfo
             set Movie_Title='".$title."', Length_Time='".$length."', Number_Actor='".$noactor."',Category_Id='C01' 
             where Movie_Id=".$movieinfo_id;
        $conn->query($sql2);
    }
    else if($category=="Animation"){
        $sql2 = "update  movieinfo
        set Movie_Title='".$title."', Length_Time='".$length."', Number_Actor='".$noactor."',Category_Id='C02' 
                where Movie_Id=".$movieinfo_id;
        $conn->query($sql2);
    }
    else if($category=="Comedy"){
        $sql2 = "update  movieinfo
        set Movie_Title='".$title."', Length_Time='".$length."', Number_Actor='".$noactor."',Category_Id='C03' 
        where Movie_Id=".$movieinfo_id;
        $conn->query($sql2);

    }

        $targetDir = "uploads/";
        $fileName = basename($_FILES["video"]["name"]);
        $videoFilePath = $targetDir . $fileName;
    
        $imageFileName = basename($_FILES["poster"]["name"]);
        $imageFilePath = $targetDir . $imageFileName;
    
        $VideoFileType = pathinfo($videoFilePath, PATHINFO_EXTENSION);
        $imageFileType = pathinfo($imageFilePath, PATHINFO_EXTENSION);
    
       
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'); // Check if the file is a valid image or video
        if (in_array($VideoFileType , $allowedTypes) || in_array($imageFileType , $allowedTypes)) {
            move_uploaded_file($_FILES["video"]["tmp_name"], $videoFilePath);         // Upload file to server
            move_uploaded_file($_FILES["poster"]["tmp_name"], $imageFilePath); 
            $videoData = $videoFilePath;
            $imageData = $imageFilePath;

                // $sqlquery = "select Movie_Id from movieinfo";
                // $rslt = $conn->query($sqlquery);

                // $sql2 = "insert into moviecontent(videoURL,poster)
                //           values('$videoData','$imageData');";
                // $conn->query($sql2);        // Insert file path into database
                
        $sql1 = "update moviecontent 
        set videoURL='".$videoData."',poster='".$imageData."'
        where Movie_Id=".$content_id;
        $conn->query($sql1);

        }
    

    echo "<h1>The movie is Successfully Edited </h1>";
    echo "<h1> Back to Update movie <a href='updatemovie.php'>Click Here</a></h1>";
}
$conn->close();
?>