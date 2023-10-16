<?php
include "./partials/_header.php";
$is_logged = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password =  $_POST['password'];
    require "./partials/_db_connect.php";
    $sql = "SELECT * FROM `users_info` WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);
    $result_found = mysqli_num_rows($result);
    if ($result_found == 1){
        $hashed_password = mysqli_fetch_assoc($result)['Password'];
        $password_check = password_verify($password, $hashed_password);
        if($password_check) {
          session_start();
          $_SESSION['username'] = $username;
          $_SESSION['loggedin'] = true;
          header("location: /loginsystem/welcome.php");
          $is_logged = true;
        }else {
          echo '<div class="alert alert-danger alert-danger fade show" role="alert">
          <strong>Error! </strong>Incorrect Password.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
        }
        
        } else {
            echo '<div class="alert alert-danger alert-danger fade show" role="alert">
           <strong>Error!</strong> User not found. 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
        } 
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css">

    <title>Login</title>
  </head>
  <body>
  <div class="my-4 container">
        <h1 class="text-center">Login</h1>

        <form class="my-4" action="./login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrap">
                <input type="password" class="form-control" id="password" name="password">
                <i class="fa eye-btn fa-eye" style="cursor: pointer;" id="togglePassword"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
    </script>
  </body>
</html>