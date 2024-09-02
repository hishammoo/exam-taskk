<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
require_once "../../dbconnection.php";
?>


      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">

            <?php

              if (isset($_POST['addCategory'])) {
                $title = htmlspecialchars($_POST['title']);

                if (!empty($title)) {
                  $checkTitle="SELECT `title` FROM `categories` WHERE `title` ='$title'";  
                  $runCheckTitle=mysqli_query($connection, $checkTitle);

                  if(mysqli_num_rows($runCheckTitle)>0){ 
                    echo"category is already added";

                  }else{
                    $addCategory = "INSERT INTO `categories` (`title`) VALUES ('$title')";
                    $runaddCategory = mysqli_query($connection,$addCategory);

                    if ($runaddCategory) {
                      echo'category added successfully';
                    }else {
                      echo'failed added';
                    }
                  }
                  
                }else {
                  echo'title invalid';
                }
              }
            ?>

              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Category</h3>
                <form method="POST" action="addCategory.php">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

<?php 
include "../view/footer.php";
?>