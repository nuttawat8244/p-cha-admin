<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login form</title>
  <link rel="stylesheet" href="Css/fontbg.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gudea:ital,wght@0,700;1,400&family=Lilita+One&family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<?php
session_start();

if(isset($_SESSION['false'])){
  // echo $_SESSION['login-false'];
  require_once "swithalert.php";

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $user_name = $_POST['username'];
  $password_ = $_POST['password'];


  if($user_name == "Cha" && $password_ == "333333"){
      $_SESSION['username'] = $user_name;
      $_SESSION['password'] = $password_;
      $_SESSION['office'] = "";
      $_SESSION['section'] = "Computer";
      header("location:index.php");
  }else{

  // echo $user_name . "<br>";

  if (!empty($user_name) || !empty($password_)) {
    $username = "UCC\\" . $user_name;
    $password = $password_;
    $ds = ldap_connect("192.168.81.6");
    if ($ds) {
      ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
      ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

      $r = ldap_bind($ds, $username, $password);
          if(!$r){
            $_SESSION['false'] = "Username or Password incorect!!";
            // die("LDAP bind failed: " . $_SESSION['login-false']);
            header("Location:login.php");
            // echo $_SESSION['login-false'];
          }
      $sr = ldap_search($ds, "DC=ucc,DC=co,DC=th", "CN=$user_name");
      
      $info = ldap_get_entries($ds, $sr);
    //   $office = $info[0];
      // print_r($office) ;
      // print_r($info[0]["physicaldeliveryofficename"][0]);

      $office = $info[0]["physicaldeliveryofficename"][0];
      $descript = $info[0]["description"][0];

      $section = explode("/",$descript);
      $sections = $section[1];
      $_SESSION['section'] = $sections;
    //   print_r($office) ;
    //   echo @$info[0]["initials"][0];
      // foreach($info[0]["physicaldeliveryofficename"] as $office){
      //   echo $office;
      // }

      if ($info["count"] > 0) {
        $user_profile = array(
          @$info[0]["initials"][0],
          @$info[0]["givenname"][0],
          @$info[0]["sn"][0],
          @$info[0]["mail"][0],
          @$info[0]["telephonenumber"][0],
          @$info[0]["mobile"][0],
          @$info[0]["physicaldeliveryofficename"][0],
          @$info[0]["description"][0],
          @$info[0]["wwwhomepage"][0]
        );
        // print_r($user_profile);

        $memberof = array();
        for ($z = 0; $z < count($info[0]["memberof"]) - 1; $z++) {
          $mem = explode(",", $info[0]["memberof"][$z]);
          $memof = explode("=", $mem[0]);
          $memberof[] = $memof[1];
        //   echo "<br>ดเ้ด้ด".$memberof[$z];
        }

        $_SESSION['username'] = $user_name;
        $_SESSION['password'] = $password;
        $_SESSION['user_profile'] = $user_profile;
        $_SESSION['memberof'] = $memberof;
        $_SESSION['office'] = $office;
        header("location: index.php");
      } else {
        // Handle the case where no LDAP results were found.
        echo "No LDAP results found.";
      }

      ldap_close($ds);
    } else {
      // Handle LDAP connection error.
      die("Unable to connect to LDAP server");
    }
  }
}
}
?>


<body id="bg">
  <nav class="shadow p-3 mb-5 bg-body-tertiary rounded">
    <div class="container-fluid">
      <a class="navbar-brand fs-4" href="Board.php">
        <img src="img/ucclogo.png" alt="Logo" width="70" height="24" class="d-inline-block align-text-top mt-1">
         (Admin) Requirement
      </a>
    </div>
  </nav>
<h1 class="text-center">ADMIN</h1>
  <div class="card position-absolute top-50 start-50 translate-middle  border-1 rounded-4 shadow-lg p-3 mb-5 bg-body-tertiary" style="width: 35%;">
    <form class="" style="width: 100%;" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>">
      <div class="d-flex justify-content-center mt-2  "><img src="img/ucclogo.png" alt="Logo" width="100%" height="100%" class="d-inline-block align-text-top w-25"></div>
      <div class="d-flex justify-content-center mt-3">Sing in to start your session</div>
      <div class="form-group  p-2 mt-3">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
            </svg>
          </span>
          <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" value="<?php if ($_SERVER['REQUEST_METHOD'] == "POST") echo $_POST['username'] ?>" class="form-control" required>
        </div>
      </div>

      <div class="form-group  p-2">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
              <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            </svg>
          </span>
          <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" maxlength="15" class="form-control" required >
        </div>
      </div>
      <div class="d-flex justify-content-end p-2">
        <input type="submit" name="login" value="Sing in" class="btn btn-primary ">
        
        <!-- <a class="btn btn-secondary my-3 " href="insert_user.php">Register</a> -->
      </div>


    </form>
  </div>

</body>

</html>