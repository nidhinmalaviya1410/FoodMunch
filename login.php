<!-- signin.php -->
<?php include 'template/header.php'; ?>
  <body>
    
    <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->

    <script type="text/javascript">
      function toggle()
      {
        var x=document.getElementById('otphandler1');
        var y=document.getElementById('otphandler2');

        var z=document.getElementById('email1');
        var w=document.getElementById('password1');


        if(z.value=='')
        {
          alert("Please Enter Email first.");
          return;
        }
        if(w.value=='')
        {
          alert("Please Enter Password.");
          return;
        }

        $(document).ready(function(){

          $.ajax({
            url: "mail/mail.php?change_password="+z.value});
          

        });


        x.style.display="none";
        y.style.display="block";
        
      }
      
    </script>

    
    <section class="home-slider owl-carousel" style="height: 400px;">
      <div class="slider-item" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center">
            <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
              <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Login</span></p>
              <h1 class="mb-3">Login</h1>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading">Login</span>
            <h2>Log In Our Site</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 dish-menu">

            <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="flaticon-meat"></span> Login</a>
              
            </div>

            <div class="tab-content py-5" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-8">
                    <div class="menus d-flex ftco-animate" style="background: white;">
	                    <div class="row" style="width: 100%">
      					        <div class="col-md-12">
      					            <form action="" method="POST" enctype="multipart/form-data">
                              <div id='otphandler1'>
        					              <div class="form-group">
        					                <input type="email" name="email" id="email1" class="form-control" required="" placeholder="Your Email" >
        					              </div>
        					              <div class="form-group">
        					                <input type="password" name="password" id="password1" class="form-control" required="" placeholder="Your Password" >
        					              </div>
        					              <div class="form-group">
        					                <div onclick="toggle()"  class="btn btn-primary py-3 px-5">LogIn</div> 
        					              </div>
                              </div>
                              <div id='otphandler2' style="display:none;">
                                <div class="form-group">
                                  <input type="text" name="otp" class="form-control" required="" placeholder="Enter OTP">
                                </div>
                                <div class="form-group">
                                  <input value="Login" name="login" type="submit" class="btn btn-primary py-3 px-5">
                                </div>
                              </div>
      					            </form>
                            <p class="text-center">For Register <a href="register.php">Click Here.</a> </p>
      					        </div>
					             </div>
	                  </div>
                  </div> <!-- Row -->
                </div>
              </div><!-- END -->

            </div>
          </div>
        </div>
      </div>
    </section>

    
    

    <?php include 'template/instagram.php'; ?>

    <?php include 'template/footer.php'; ?>
    
    <?php include 'template/script.php'; ?>


    
  </body>
</html>



<?php 

  

  if (isset($_POST['login'])) {
    
  $email = $_POST['email'];
  $password = $_POST['password'];

  $otp=$_POST['otp'];


  include 'dbCon.php';
  $con = connect();

  $emailSQL = "SELECT * FROM restaurant_info WHERE email = '$email';";

  $passwordSQL = "SELECT * FROM restaurant_info WHERE email = '$email' And password = '$password'";

  $emailResult = $con->query($emailSQL);

  $passwordResult = $con->query($passwordSQL);

  if ($emailResult->num_rows <= 0) {
    echo '<script>alert("This Email Does Not Exist.")</script>';
    echo '<script>window.location="login.php"</script>';
  }else if ($passwordResult->num_rows <= 0) {
    echo '<script>alert("This Password is Incorrect.")</script>';
    echo '<script>window.location="login.php"</script>';
  }else{

    $_SESSION['isLoggedIn'] = TRUE;

    // $SQL = "SELECT * FROM restaurant_info WHERE email = '$email' And password = '$password' AND approve_status=1";

    $SQL = "SELECT * FROM restaurant_info WHERE email = '$email' And password = '$password' And otp='$otp'";
    
    $result = $con->query($SQL);

     foreach ($result as $r) {
       $_SESSION['id'] = $r['id'];
       $_SESSION['name'] = $r['restaurent_name'];   
       $_SESSION['phone'] = $r['phone'];
       $_SESSION['email'] = $r['email'];
       $_SESSION['password'] = $r['password'];
       $_SESSION['role'] = $r['role'];
     }

     if ($_SESSION['role'] == 1) {
        echo '<script>window.location="dashboard/index.php"</script>';
     }elseif ($_SESSION['role'] == 2) {
       echo '<script>window.location="index.php"</script>';
    } 
  }

  }
?>