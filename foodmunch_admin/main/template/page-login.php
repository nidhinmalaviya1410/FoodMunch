<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-md-5">
                    <div class="form-input-content">
                        <div class="card card-login">
                            <div class="card-header">
                                <div class="nav-header position-relative  text-center w-100">
                                    <div class="brand-logo">
                                        <a href="index.html">
                                            <b class="logo-abbr">F</b>
                                            <span class="brand-title"><b>FoodMunch</b></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="page-login.php" method="post">
                                    <div class="form-group mb-4">
                                        <input type="text" name="username" class="form-control rounded-0 bg-transparent" placeholder="Username">
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" name="password" class="form-control rounded-0 bg-transparent" placeholder="Password">
                                    </div>
                                    <div class="form-group ml-3 mb-5">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="label-checkbox ml-2 mb-0" for="checkbox1">Remember Password</label>
                                    </div>
                                    <button class="btn btn-primary btn-block border-0" name="submit" type="submit">Login</button>
                                </form>
                            </div>
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
    <script src="../../assets/plugins/common/common.min.js"></script>
    <!-- Custom script -->
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/quixnav.js"></script>
</body>
</html>

<?php 

  if (isset($_POST['submit'])) {
    
  $username = $_POST['username'];
  $password = $_POST['password'];

  include 'dbCon.php';
  $con = connect();

  $emailSQL = "SELECT * FROM admin WHERE username = '$username';";

  $passwordSQL = "SELECT * FROM admin WHERE username = '$username' And password = '$password';";

  $emailResult = $con->query($emailSQL);

  $passwordResult = $con->query($passwordSQL);

  if ($emailResult->num_rows <= 0) {
    echo '<script>alert("This Email Does Not Exist.")</script>';
    echo '<script>window.location="page-login.php"</script>';
  }else if ($passwordResult->num_rows <= 0) {
    echo '<script>alert("This Password is Incorrect.")</script>';
    echo '<script>window.location="page-login.php"</script>';
  }else{

    $_SESSION['isLoggedIn'] = TRUE;

    $SQL = "SELECT * FROM `admin` WHERE username = '$username' AND password = '$password';";

    $result = $con->query($SQL);

    $SQL1 = "SELECT * FROM restaurant_info ORDER BY id DESC";
    
    $result1 = $con->query($SQL1);

    $row=mysqli_num_rows($result1);

     foreach ($result1 as $r) {
       $_SESSION['id'] = $r['id'];
       $_SESSION['name'] = $r['restaurent_name'];   
       $_SESSION['phone'] = $r['phone'];
       $_SESSION['email'] = $r['email'];
       $_SESSION['password'] = $r['password'];
       $_SESSION['role'] = $r['role'];
       print_r($r);
     }

     // for($i=0;$i<$row;$i++)
     // {
     //   print_r($r);
     // }

    if($result == true)
    {
    ?>
       <script>location.href="restaurant_employees.php";</script>
    <?php
    }

      
  }

  }
?>

