<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BahirMovies Gallery</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <header class="header-style">
        
        <div class="menu-bar">
            <input type="checkbox" class="menu" id="menu" >
            <label for="menu" class="menu-label">
                <div class="menu-1"></div>
                <div class="menu-2"></div>
                <div class="menu-3"></div>
            </label>

            <div class="logo-style">
                <h1>BahirMovies Gallery</h1>
            </div>
        
            <nav class="nav-style">
                <ul>
                    <li><h2>Movie Category</h2></li>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="action.php">Action</a></li>
                    <li><a href="Animation.php">Animation</a></li>
                    <li><a href="comedy.php">Comedy</a></li>
                    <!-- <li><a href="#romance">Rormance</a></li> -->
                </ul>
            </nav>
       </div>
    </header>

    <section class="section-style" id="video-section">
        <!-- this is posting area -->
        <?php
            $conn = new  mysqli('localhost','root','','moviegallery');

            if($conn->connect_error){
                die("Connection faild :". $conn->connect_error);
            }else{
                $sqlQuery = "select videoURL,poster,Movie_Title,Length_Time,categoryName from moviecategory 
                            inner join  movieinfo on moviecategory.Category_Id=movieinfo.Category_Id
                            inner join moviecontent on movieinfo.Movie_Id=moviecontent.Movie_Id where moviecategory.Category_Id='C02';";
                $queryResult = $conn->query($sqlQuery);

                if ($queryResult->num_rows > 0) {
                    while ($row = $queryResult->fetch_assoc()) {
                        echo "<div class='video-view'>";
                        $videoPath = $row["videoURL"];
                        $videoPoster = $row["poster"];
                        echo "<video class='video-style' source src='admin/$videoPath' width='395' height='280' poster='admin/$videoPoster' controls>";
                        echo "Your browser does not support the video tag.";
                        echo "</video>";
                        echo "<p class='caption-style1'> Title : ". $row["Movie_Title"] ."</p>";
                        echo "<p class='caption-style'> Length of time : ". $row["Length_Time"] ." hours</p>";
                        echo "<p class='caption-style'> category : ". $row["categoryName"] ."</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<h1>No videos found.</h1>";
                }
                $conn->close();
            }
        
        ?>
    </section>




    <!-- Retrive video and video data -->
    <?php
    $conn = new  mysqli('localhost','root','','moviegallery');
    if($conn->connect_error){
        die("Connection faild :". $conn->connect_error);
    }else{
        $sqlQuery = "select Movie_Title,Length_Time,categoryName,videoURL,poster from movieinfo,moviecategory,moviecontent 
        where movieinfo.Movie_Id=moviecontent.Movie_Id and movieinfo.Category_Id='C02'; ";
        $queryResult = $conn->query($sqlQuery);
    }
    
    $queryData= array();
    while ($row = $queryResult->fetch_assoc()) {
        $queryData[] = $row;
    }
    $movieData = json_encode($queryData);

    ?>

    <script>

        let videourl = "rophy.mp4";
        let title = "title";
        let lengthoftime = "3:00";
        let catgrry = "Action";
        let posterr="images/background.jpg";
        
        let div = "videoID";

        function moviePost(v,postr,t,len,cat,divId){
            let section=document.getElementById("video-section");
            let div=document.createElement("div");
            div.className = "video-view";
            //div.setAttribute('class','Video-view');
            //div.textContent="this is video";
            div.setAttribute('id',divId);
            section.appendChild(div);
            
            let video = document.createElement("video");
            video.className = "video-style";
            video.setAttribute('controls','auto');
            video.setAttribute('width','395');
            video.setAttribute('height','280');
            video.setAttribute('src',v);
            video.setAttribute('poster',postr);
            document.getElementById(divId).appendChild(video);

            let caption = document.createElement("p");
            caption.setAttribute('class','caption-style1');
            caption.textContent ="Title : " + t; //use variable 
            document.getElementById(divId).appendChild(caption);

            let length = document.createElement("p");
            length.setAttribute('class','caption-style');
            length.textContent ="Length of time : " + len + " hours"; //use variable 
            document.getElementById(divId).appendChild(length);

            let category = document.createElement("p");
            category.setAttribute('class','caption-style');
            category.textContent ="Catagory : " + cat; //use variable 
            document.getElementById(divId).appendChild(category);
        }

        

    </script>
</body>
</html>