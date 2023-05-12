
<?php
$sql="SELECT category_name,category_id FROM `categories` LIMIT 3";
      $result=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_assoc($result)){
        echo'<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
      }
?>