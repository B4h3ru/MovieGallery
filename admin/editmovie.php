<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Movie</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: black;
            color: white;
        }
        .edit-style{
            position: relative;
            height: 100%;
            width: 100%;
            margin-left: 35vw;
        }
        label{
            display: block;
            width: 400px;
            font-size: 25px;

        }
        input{
            display: block;
            width: 400px;
            font-size: 25px;
            border: 2px solid white;
            border-radius: 5px;

        }
        select{
            width: 400px;
            border: 1px solid rgb(170, 167, 167);
            border-radius: 5px;
            font-size: 25px;
        }
        button{
            margin-left: 50px;
            margin-top: 10px;
            font-size: 30px;
            width: 150px;
            border: 2px solid red;
            border-radius: 30px;
            background-color: green;
        }
        button:hover{
            background-color: rgb(186, 186, 31);
        }
        .hide{
            display: none;
        }

    </style>
</head>
<body>
    <?php
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "moviegallery";

        // $conn = new mysqli($servername, $username, $password, $dbname);

        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $movieinfo_id = htmlspecialchars($_POST['movieId']);
            $content_id = htmlspecialchars($_POST['movieId']);
            $title = htmlspecialchars($_POST['title']);
            $length = htmlspecialchars($_POST['length']);
            $category = htmlspecialchars($_POST['category']);
            $noactor = htmlspecialchars($_POST['noactor']);
            // $video = htmlspecialchars($_POST['video']);
            // $poster = htmlspecialchars($_POST['poster']);

        

            echo " <div class='edit-style' >
            <h1>Edit Movie</h1>
            <form action='update.php' method='POST' enctype='multipart/form-data'>
                <input type='text' name='id' value='".$movieinfo_id."' class='hide' >
                <label for='title'> Movie Titile </label>
                <input type='text' name='title' value='".$title."' >
                <br>
                <label for='length'>Lenght of time</label>
                <input type='text' name='length' value='".$length."'>
                <br>
                <label for='noactor'>Number of actors</label>
                <input type='number' name='noactor' value='".$noactor."'>
                <br>
                <label for='category'>Movie category :</label>
                <select name='category'>
                    <option>".$category."</option>
                    <option value='Action'>Action</option>
                    <option value='Animation'>Animation</option>
                    <option value='Comedy'>Comedy</option>
                </select>
                <br><br>
                <label for='video'>Select Video to Upload</label>
                <input type='file' name='video'  >
                <br>
                <label for='poster'>Select video poster </label>
                <input type='file' name='poster' >

                <button type='submit'>Update</button>
                <span>Back to <a href='adminHome.html'>HOME</a></span>
            </form> 
            </div> ";
         }
   ?> 
    
</body>
</html>