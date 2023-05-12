<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    .maincontainer {
        min-height: 85vh;
    }
    </style>
    <title> Welome To iForum</title>
</head>

<body>

    <?php include 'partials/headers.php';?>
    <?php include 'partials/dbconnect.php';?>

   

    <!--Search Results Starts Here-->

    <div class="container my-3" id="maincontainer">
        <h1 class="py-3">Search Result For <em>"<?php echo $_GET['search'];?>"</em></h1>
    <?php
    $noresults=true;
    $query=$_GET["search"];
    $sql="SELECT * FROM threads where match (thread_title,thread_desc) against ('$query')";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_id=$row['thread_id'];
        $url="thread.php?threadid=".$thread_id;
        $noresults=false;
        echo'<div class="Result">
            <h3><a href="'.$url.'" class="text-dark">'.$title.'</h3>
            <p>'.$desc.'</p>
        </div>';
       }

       if($noresults){
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Results Found</h1>
          <p class="lead">Suggestions: <ul><li>Make sure that all words are spelled correctly.</li>
                          <li>Try different keywords.</li>
                          <li>Try more general keywords.</li></ul>
                </p>
        </div>
      </div>';
    }
    ?>

</div>





    <!--Footer-->
    <?php include 'partials/footer.php';?>



    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>


</body>

</html>