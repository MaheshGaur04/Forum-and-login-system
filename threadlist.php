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
    #ques {
        min-height: 433px;
    }
    </style>

    <title> Welome To iForum</title>
</head>

<body>

   
    <?php include 'partials/headers.php';?>
    <?php include 'partials/dbconnect.php';?>
   

    <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
    ?>

    <?php
    $method=$_SERVER['REQUEST_METHOD'];
    $showAlert=false;
    if($method=="POST"){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $th_title=str_replace("<","&lt;",$th_title);
        $th_title=str_replace(">","&gt;",$th_title);

        $th_desc=str_replace("<","&lt;",$th_desc);
        $th_desc=str_replace(">","&gt;",$th_desc);
        $sno=$_POST['sno'];
        $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your Thread has been Added successfully.Please wait for community to Responds.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>


    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome To <?php echo $catname;?> Forums</h1>
            <p class="lead"> <?php echo $catdesc;?>.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.No
                Spam / Advertising / Self-promote in the forums · Do not post copyright-infringing material .Do not post
                “offensive” posts, links or images</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <!--Browse Questions-->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo'<div class="container">
    
      <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
      <div class="form-group">
      <h1 class="py-2">Start a Discussion</h1>
        <label for="exampleInputEmail1">Problem Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">Keep your Title as Short as Possible.</small>
      </div>
      <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
       
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
      </form>
      </div>';
    }
    else{
      echo'<div class="container">
      <h1 class="py-2">Start a Discussion</h1>
      <p class="Lead"><b>You are not Logged in.Please login to be able to Start a Discussion</b></p>
      </div>';
    }
    ?>
   

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
    $result=mysqli_query($conn,$sql);
    $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $time=$row['timestamp'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
       
    
        echo'<div class="media my-3">
            <img src="img/userimage.jpg" width="54px" class="mr-3" alt="...">
            <div class="media-body">'.
            '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                '.$desc.'</div>'.'<p class="font-weight-bold my-0">Asked By: '. $row2['user_email'] .' at '.$time.'</p>'.
        '</div>';

}
if($noResult){
    echo'<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">No Threads Found</h1>
      <p class="lead">Be the First Person to Ask a Question</p>
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