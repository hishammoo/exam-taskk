
<?php
include "header.php";
include "navbar.php";
require_once "dbconnection.php";
?>


                <div class="card-body px-5 py-5" style="background-color:darkgray;">           
                  <?php 
                  if (isset($_POST['submit'])) {
                      $name = trim(htmlspecialchars($_POST['name']));
                      $email = trim(htmlspecialchars($_POST['email']));
                      $password = trim(htmlspecialchars($_POST['password']));
                      $phone = trim(htmlspecialchars($_POST['phone']));
                      $address = trim(htmlspecialchars($_POST['address']));
                      
                      $errors = [];
                      
                      if (empty($name)) {
                          $errors[] = 'Your name is required';
                      } elseif (is_numeric($name)) {
                          $errors[] = 'Your name must be a string';
                      } elseif (strlen($name) > 20) {
                          $errors[] = 'Your name must be less than 20 characters';
                      }
                      
                      if (empty($email)) {
                          $errors[] = 'Your email is required';
                      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                          $errors[] = 'Your email is not valid';
                      } elseif (strlen($email) > 30) {
                          $errors[] = 'Your email must be less than 30 characters';
                      } 
                          $checkemail = "SELECT * FROM users WHERE email = '$email'";
                          $runcheck = mysqli_query($connection, $checkemail);
                          if (mysqli_num_rows($runcheck) > 0) {
                              $errors[] = 'Email already exists';
                          }
                      
                      if (empty($password)) {
                          $errors[] = 'Your password is required';
                      } elseif (strlen($password) < 5) {
                          $errors[] = 'Your password must be more than 5 characters';
                      }
                      if (empty($phone)) {
                          $errors[] = 'Your phone is required';
                      } elseif (!is_numeric($phone)) {
                          $errors[] = 'Your phone must be a number';
                      } elseif (strlen($phone) > 15) {
                          $errors[] = 'Your phone must be less than 15 characters';
                      }
                      if (empty($address)) {
                          $errors[] = 'Your address is required';
                      }

                      if (empty($errors)) {
                          $passwordhashed = password_hash($password,PASSWORD_DEFAULT);
                          $query = "INSERT INTO  users (`name`, `email`, `password`, `phone`, `address`) 
                          VALUES ('$name', '$email', '$passwordhashed', '$phone', '$address')";
                          $runquery = mysqli_query($connection, $query);

                          if ($runquery) {
                              echo 'Inserted successfully';
                          } else {
                              echo 'Insert failed';
                              }
                      }
                  }
                  ?>

                <h3 class="card-title text-left mb-3">Register</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])/*form 'sends data to the same page' that was implemented*/?>" method="post">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name ="name" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name ="email" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name ="password" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name ="phone" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name ="address" class="form-control p_input" >
                  </div>
              
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                    
                  <div class="text-center">
                    <button type="submit" name ="submit" class="btn btn-primary btn-block enter-btn">Signup</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
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

    <?php include "footer.php" ?>