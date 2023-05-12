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
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];
    
    }
    ?>

    <?php
    $method=$_SERVER['REQUEST_METHOD'];
    $showAlert=false;
    if($method=="POST"){
        $comment=$_POST['comment'];
        $comment=str_replace("<","&lt;",$comment);
        $comment=str_replace(">","&gt;",$comment);
        $sno=$_POST['sno'];
       
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your Comment has been Added successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>



    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title;?></h1>
            <p class="lead"> <?php echo $desc;?>.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.No
                Spam / Advertising / Self-promote in the forums · Do not post copyright-infringing material .Do not post
                “offensive” posts, links or images</p>
            <p>Posted By: <em><?php echo $posted_by;?></em></p>
        </div>
    </div>


    <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo' <div class="container">
      <h1 class="py-2">Post a Comment</h1>
      <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
      <div class="form-group">
      <label for="exampleFormControlTextarea1">Type your Comment</label>
      <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
      <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
      </div>
      <button type="submit" class="btn btn-success">Post</button>
      </form>
      </div>';
    }
    else{
      echo'<div class="container">
      <h1 class="py-2">Post a Comment</h1>
      <p class="Lead"><b>You are not Logged in.Please login to be able to Post a Comment</b></p>
      </div>';
    }
    ?>

    <!--Browse Questions-->

    <div class="container mb-5" id="ques">
        <h1 class="py-2">Discussion</h1>
        <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `comments` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id=$row['comment_id'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        $comment_by=$row['comment_by'];
        $sql2="SELECT user_email FROM `users` WHERE sno='$comment_by'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
    
        echo'<div class="media my-3">
            <img src="img/userimage.jpg" width="54px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="font-weight-bold my-0">Asked By: '. $row2['user_email'] .'at '.$comment_time.'</p>
              '.$content.'
            </div>
        </div>';
    }
    if($noResult){
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No comments Found</h1>
          <p class="lead">Be the First to Comment</p>
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