<?php
session_start();
error_reporting(0);
include("include/config.php");
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' and password='$password'");
  $num = mysqli_fetch_array($ret);
  if ($num > 0) {
    $extra = "menu.php";
    $_SESSION['alogin'] = $_POST['username'];
    $_SESSION['id'] = $num['id'];
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location:http://$host$uri/$extra");
    exit();
  } else {
    $_SESSION['errmsg'] = "Invalid username or password";
    $extra = "index.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location:http://$host$uri/$extra");
    exit();
  }
}
?>

<?php include 'head.php' ?>

<div class="container" style="margin-top: 100px;">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-6">
    </div>
    <div class="col-md-4">
      <h3 style="margin-bottom: 30px; margin-top: 30px">Masuk Admin</h3>
      <form method="POST">
        <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" aria-describedby="usernameHelp" placeholder="Masuk username Anda" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Masuk Password Anda" />
        </div>
        <button type="submit" class="btn btn-primary" name="submit" style="width: 100%; margin-top: 30px; margin-bottom: 10px">
          Masuk
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>