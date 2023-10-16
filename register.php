<?php
include "./partials/_header.php";
$error = false;
$user_created = false;
$user_exist = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "./partials/_db_connect.php";
    $username = $_POST['username'];
    $password =  $_POST['password'];
    $cpassword =  $_POST['cpassword'];
    $sql = "SELECT * FROM `users_info` WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user_exist_query = mysqli_num_rows($result);
    if ($user_exist_query > 0) {
        $user_exist = true;
    } else {
    if($password != $cpassword) {
        $error = true;
    }
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users_info` (`Username`, `Password`) VALUES ('$username', '$hash')";
        $result = mysqli_query($conn, $sql);
        if ($result){
          $user_created = true;
        }
        else {
            echo '<div class="alert alert-dismissible alert-dismissible fade show" role="alert">
      <strong>Error! </strong>User creation failed.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
        } 
     }
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

    <link rel="stylesheet" href="./assets/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>

<!-- Error Alert -->

<?php
if($error) {
echo '<div class="alert alert-danger alert-danger fade show" role="alert">
  <strong>Error!</strong> Password do not match.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>'; 
}
?>


<!-- User Creation Alert -->

<?php
if($user_created) {
    echo '
    <div class="alert alert-sucess alert-success fade show" role="alert">
<strong>Success! </strong>User created successfully. You can login now!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
<!-- User Creation Alert -->

<?php
if($user_exist) {
    echo '
    <div class="alert alert-danger alert-danger fade show" role="alert">
<strong>Error! </strong>Username already taken.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
?>
    <div class="my-4 container">
        <h1 class="text-center">Register</h1>

        <form class="my-4" action="./register.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrap">
                <input type="password" class="form-control" id="password" name="password">
                <i class="fa eye-btn fa-eye" style="cursor: pointer;" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                </div>
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <div class="password-wrap">
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <i class="fa eye-btn fa-eye" style="cursor: pointer;" id="togglecPassword"></i>
                </div>
                <small id="cpasswordHelp" class="form-text text-muted">Please make sure the passwords are the same.</small>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
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
      const togglecPassword = document.querySelector('#togglecPassword');
      const cpassword = document.querySelector('#cpassword');

  togglecPassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = cpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    cpassword.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
    </script>
</body>
</html>