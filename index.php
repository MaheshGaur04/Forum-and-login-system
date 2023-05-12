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
        #ques{
            min-height:433px;
        }
    </style>
    <title> Welome To iForum</title>
</head>

<body>
    
    <?php include 'partials/headers.php';?>
    
    <?php include 'partials/dbconnect.php';?>
 
    
    

    <!--Carousel-->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?nature,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?sports,water" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?nature,water" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!--Categories-->
    <div class="container my-4" id="ques">
        <h2 class="text-center my-3">iForum-Categories</h2>
        <div class="row my-3">
            <!--Fetch all The categories-->
            <?php
            $sql="SELECT * FROM `categories`";
             $result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
  //echo $row['id'];
  $id=$row['category_id'];
  $cat=$row['category_name'];
  $desc=$row['category_description'];
  echo'<div class="col-md-4 my-2">
  <div class="card" style="width: 18rem;">
      <img src="https://source.unsplash.com/900x600/?'.$cat.',coding" class="card-img-top"
          alt="search terms">
            <div class="card-body">
            <h5 class="card-title"><a href="threadlist.php?catid='.$id.'"> '.$cat.' </a></h5>
              <p class="card-text">'. substr($desc, 0,10).'...</p>
               <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Thread</a>
            </div>
        </div>
      </div>';
}
?>
</div>
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