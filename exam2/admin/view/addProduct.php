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
                if (isset($_POST['addProduct'])) {
                  $category = $_POST['cat'];
                  $title = $_POST['title'];
                  $description = $_POST['description'];
                  $price = $_POST['price'];
                  $quantity = $_POST['quantity'];

                  $image = $_FILES['img'];
                  $image_name = $image['name'];        
                  $tmp_name = $image['tmp_name'];
                  $image_error = $image['error'];
                  $image_size = $image['size']/(1024*1024); 
                  $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                  $ext_array = ['png','gif','jpeg','jpg'];

                  if (empty($category) || empty($title) || empty($description) || empty($price) || empty($quantity)) {
                    echo'all inputs is required <br>';
                  }
                  elseif (! in_array($image_ext, $ext_array)) {
                    echo'not valid image extension';

                    }else {
                      $new_name = uniqid($image_name) . '.' . $image_ext;

                      $checkCategory="SELECT `title` FROM `categories` WHERE `title`='$category'"; 
                      $runCheckCategory=mysqli_query($connection, $checkCategory); 
                      $categoryRows=mysqli_num_rows ($runCheckCategory);

                      if($categoryRows>0){
                        $checkTitle="SELECT `name` FROM `products` WHERE `name`='$title'";
                        $runCheckTitle=mysqli_query($connection, $checkTitle);
                        $titleRows=mysqli_num_rows($runCheckTitle);
                      
                        if($titleRows>0){
                        echo'product already exists';
                        }else {
                          $catID = "SELECT `categories_id` FROM `categories` WHERE `title` = '$category'";
                          $runcatID = mysqli_query($connection, $catID);
                          $fetchID = mysqli_fetch_assoc($runcatID);
                          $fetchcatID = $fetchID['categories_id'];

                          $addproduct = "INSERT INTO `products`(`name`,`description`,`price`,`quantity`,`image`,`categories_id`) 
                          VALUES ('$title','$description','$price','$quantity','$new_name','$fetchcatID')";
                          $runaddproduct = mysqli_query($connection, $addproduct);
                          move_uploaded_file($tmp_name, "../upload/$new_name");

                          if ($runaddproduct) {
                            echo'product added successfully';
                          }else {
                            echo'failed add product';
                          }
                }    
              }
            }
          
        }
              ?>

              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Product</h3>
                <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="cat" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
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