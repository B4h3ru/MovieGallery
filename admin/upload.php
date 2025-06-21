<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = htmlspecialchars($_POST['title']);
    // $movieid = htmlspecialchars($_POST['movieid']);
    $length = htmlspecialchars($_POST['length']);
    $noactor = htmlspecialchars($_POST['noactor']);
    $producerfname = htmlspecialchars($_POST['producerfname']);
    $producerlname = htmlspecialchars($_POST['producerlname']);
    $prophoneno = htmlspecialchars($_POST['prophoneno']);
    // $producerid = htmlspecialchars($_POST['producerid']);
    $category = htmlspecialchars($_POST['category']);

      
   
    $conn = new mysqli('localhost','root','','moviegallery'); //create connection
    if($conn->connect_error){
    die("".$conn->connect_error);
    }
    else{
        $sql0 = "insert into movieproducer(FirstName,lastname,PhoneNumber)
                values('$producerfname',' $producerlname','$prophoneno');";
                $conn->query($sql0);

        if($category == "Action"){
        $sql1 = "insert into movieinfo(Movie_Title,Length_Time,Number_Actor,category_Id)
                values('$title','$length','$noactor','C01');";
                $conn->query($sql1);
        }
        else if($category = "Animation"){
            $sql1 = "insert into movieinfo(Movie_Title,Length_Time,Number_Actor,category_Id)
                     values('$title','$length','$noactor','C02');";
             $conn->query($sql1);
        }
        else if($category = "Comedy"){
            $sql1 = "insert into movieinfo(Movie_Title,Length_Time,Number_Actor,category_Id,producer_Id)
                    values('$title','$length','$noactor','C03');";
            $conn->query($sql1);
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

                $sql2 = "insert into moviecontent(videoURL,poster)
                          values('$videoData','$imageData');";
                $conn->query($sql2);        // Insert file path into database
        } else {
            echo "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, & MOV files are allowed.";
        }

        echo "<h1>The movie is successfully uploaded.</h1<br>";
        echo "<h1>Back to home page Click =><a href='Adminhome.html'>Home</a><h1>";
        $conn->close();
    }


}
?>