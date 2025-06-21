<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Movies</title>
    <!-- <link rel="stylesheet" href="css/home.css"> -->
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-color: black;
        }
        /* section style  */
        .section-style{
            position: absolute;
            display: inline-flex;
            flex-wrap: wrap;
            width: 100%;
            height: 100%;
            left: 0;
            z-index: 1;
            /* margin-top: 90px; */
            /* background-color: balck; */
            background-image: url("../images/bg.jpg");
            color: white;
            text-align: center;
        }
        .video-view{
            position: relative;
            display: flex;
            flex-wrap: wrap;
            /* flex-direction: row; */
            justify-content: flex-start;
            align-content: flex-start;
            /* align-self:flex-start; */
            height: 400px;
            width: 400px;
            margin: 10px;
            margin-left: 70px;
            /* border: 2px solid green; */
            /* overflow: hidden; */
        }
        .video-style{
            position: absolute;
            display: inline-flex;
            flex-wrap: wrap;
            margin-left: 0;
            /* border: 2px solid red; */
            margin-top: 0;
            /* overflow: hidden; */
        }
        .caption-style1{
            /* position: relative; */
            display: flex;
            margin-top: 285px;
            width: 400px;
            flex-wrap: wrap;
            overflow: hidden;
            /* justify-content: center;
            align-content: flex-start; */
            
        }
        .caption-style{
            position: relative;
            display: flex;
            width: 400px;
            margin: 0;
            flex-wrap: wrap;
            overflow: hidden;
            /* justify-content: center;
            align-content: flex-start; */
        }
        .caption-style-delete{
            position: relative;
            display: inline;
            width: 150px;
            margin: 10px 30px 0 0;
            flex-wrap: wrap;
            overflow: hidden;
        }
        .caption-style-edit{
            position: relative;
            display: inline;
            width: 150px;
            margin: 10px 30px 0 0;
            flex-wrap: wrap;
            overflow: hidden;
        }
        .hide{
            display: none;
        }

        input{
            height: 20px;
            font-size: 15px;
            width: 10px;
            text-align: center;
            border: 2px solid red;
            border-radius: 30px;
            background-color: yellow;
        }
        input:hover{
            background-color: red;
        }
        h1{
            width: 100%;
            text-align: center;
        }

    </style>
</head>
<body>
    <h1> <a href="Adminhome.html">HOME</a></h1>
    <section class="section-style" id="video-section">
     <!-- Retrive video and video data  -->
     <?php
            $conn = new  mysqli('localhost','root','','moviegallery');

            if($conn->connect_error){
                die("Connection faild :". $conn->connect_error);
            }else{
                $sqlQuery = "select moviecontent.Movie_Id,videoURL,poster,movieinfo.Movie_Id,Movie_Title,Length_Time,Number_Actor,categoryName from moviecategory 
                            inner join  movieinfo on moviecategory.Category_Id=movieinfo.Category_Id
                            inner join moviecontent on movieinfo.Movie_Id=moviecontent.Movie_Id; ";
                $queryResult = $conn->query($sqlQuery);

                if ($queryResult->num_rows > 0) {
                    while ($row = $queryResult->fetch_assoc()) {
                        echo "<div class='video-view'>";
                        $videoPath = $row["videoURL"];
                        $videoPoster = $row["poster"];
                        echo "<video class='video-style' source src='$videoPath' width='395' height='280' poster='$videoPoster' controls>";
                        echo "Your browser does not support the video tag.";
                        echo "</video>";
                        echo "<p class='caption-style1'> Title : ". $row["Movie_Title"] ."</p>";
                        echo "<p class='caption-style'> Length of time : ". $row["Length_Time"] ." hours</p>";
                        echo "<p class='caption-style'> Category : ". $row["categoryName"] ."</p>";
                        echo "<form action='deleteMovie.php' method='post' >";
                        echo "<input type='submit' value='DELETE' id='delete' class='caption-style-delete' >";
                        echo "<input type='text' name='movieId' value= '".$row["Movie_Id"]."' class='hide'>";
                       // echo "<input type='submit' value='EDIT' id='edit' onClick='editMovie();'  class='caption-style-edit' >";
                        echo "</form>";
                        echo "<form action='editmovie.php' method='post' >";
                        echo "<input type='submit' value='EDIT' id='edit' class='caption-style-edit' >";
                        echo "<input type='text' name='movieId' value= '".$row["Movie_Id"]."' class='hide'>";
                        echo "<input type='text' name='title' value= '".$row["Movie_Title"]."' class='hide'>";
                        echo "<input type='text' name='length' value= '".$row["Length_Time"]."' class='hide'>";
                        echo "<input type='text' name='noactor' value= '".$row["Number_Actor"]."' class='hide'>";
                        echo "<input type='text' name='category' value= '".$row["categoryName"]."' class='hide'>";
                        echo "<input type='text' name='video' value= '".$row["videoURL"]."' class='hide'>";
                        echo "<input type='text' name='poster' value= '".$row["poster"]."' class='hide'>";

                        echo "</form>";
                        echo "</div>";

                    }
                } else {
                    echo "<h1>No videos found.</h1>";
                }
              //  $conn->close();
            }

?>


    </section>
</body>
</html>