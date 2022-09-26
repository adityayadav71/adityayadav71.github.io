<?php
session_start();
error_reporting(0);
include 'db_connection.php';
if(isset($_POST['submit'])){
   $id = $_POST["id"];
   $p = $_POST["pass"];
$sql = $mysqli->query("SELECT * from voterdetails where VID='".$id."'");
if($sql->num_rows == 0){
    $_SESSION['status'] = "ERROR!";
    $_SESSION['message'] = "Please register first.";
    $_SESSION['status-code'] = "error";
}else{
 while($row = mysqli_fetch_array($sql)){
        if ($p == $row['pwd']){ 
            $_SESSION['user'] = $row['Name'];
            $_SESSION['VID'] = $row['VID'];
            $_SESSION['Voted'] = $row['Voted'];
            $_SESSION['image'] = $row['Image'];
            header('location: VoterPage/index.php');
         }else{
            $_SESSION['status'] = "ERROR!";
            $_SESSION['message'] = "Incorrect Password!";
            $_SESSION['status-code'] = "error";
         }         
    }
 }
}
 $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./js/sweetalert.min.js"></script>
  <script type="text/javascript" src="./js/mobile.js"></script>
  <link rel="stylesheet" href="./css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
  <link rel="icon" href="images/image3.ico" type="image/x-icon">
  <title>Login to Dashboard</title>
  <script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  </script>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

  * {
    margin: 0;
    padding: 0;
    outline: none;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  body {
    height: 100vh;
    display: flex;
    width: 100%;
    background: #E4E9F7;
  }

  .show-btn,
  .container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 42px;
  }

  .container {
    background: #fff;
    width: 410px;
    padding: 30px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1)
  }

  .text {
    font-size: 25px;
    font-weight: 500;
    font-style: normal;
    color: #0c0c0c;
    text-align: center;
  }

  .container.text {
    font-size: 35px;
    font-weight: 500;
    text-align: center;
  }

  .container form {
    margin-top: -20px;
  }

  .container form .data {
    height: 45px;
    width: 100%;
    margin: 56px 0px;
  }


  form .data label {
    color: #0c0c0c;
    font-size: 18px;
    font-weight: 500;
    margin-left: -5px;
    padding: 10px 10px 10px 10px;
  }

  form .data input {
    height: 100%;
    width: 100%;
    padding: 10px;
    margin: 13px 30px 100px 0px;
    font-size: 17px;
    border: 1px solid silver;
    display: block;
    border-radius: 5px;
  }

  form .data input:focus {
    border-color: #3498db;
    border-bottom-width: 2px;
  }

  form .forgot-pass {
    margin-top: -8px;
  }

  form .forgot-pass a {
    color: #3498db;
    text-decoration: none;
  }

  form .forgot-pass a:hover {
    text-decoration: underline;
  }

  form .btn {
    margin: 60px 0px 10px 0px;
    height: 45px;
    width: 100%;
    position: relative;
    overflow: hidden;
    border-radius: 5px;
  }

  form .btn .inner {
    height: 100%;
    width: 300%;
    position: absolute;
    left: -100%;
    z-index: -1;
    background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
    transition: all 0.4s ease;
  }

  form .btn :hover .inner {
    left: 0;
  }

  form .btn .button {
    height: 100%;
    width: 100%;
    background: none;
    border: none;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;

  }

  form .signup-link {
    text-align: center;
  }

  form .signup-link a {
    color: #3498db;
    text-decoration: none;
  }

  form .signup-link a:hover {
    text-decoration: underline;
  }
  </style>
</head>

<body>
  <header style="height: 58px; display:inline-flex; width:100%">
    <a class="logo" href="/"><img src="images/image1.png" style="height:36px; width:197px" alt="logo"></a>
    <nav>
      <ul class="nav__links">
        <li><a href="./AdminLogin.php">Admin</a></li>
        <li><a href="./candidates.php">Candidates</a></li>
        <li><a href="#">About</a></li>
      </ul>
    </nav>
    <a class="cta" href="./Register.php">Register</a>
    <p class="menu cta">Menu</p>
  </header>
  <div class="center">
    <div class="container">
      <div class="text">Login Form</div>
      <form action="" method="post">
        <div class="data">
          <label>Voter ID number</label>
          <input type="text" name="id" placeholder="Enter your Voter ID number" required>
        </div>
        <div class="data">
          <label>Password</label>
          <input type="password" name="pass" placeholder="Enter your Password" required>
        </div>
        <div class="btn">
          <div class="inner"></div>
          <input class="button" type="submit" name="submit">
        </div>
        <div class="signup-link"> <a href="./Register.php">Click here for registration</a></div>
      </form>
      <?php
 if(isset($_SESSION['status'])){
        ?><script>
      swal({
        title: "<?php echo $_SESSION['status']?>",
        text: "<?php echo $_SESSION['message']?>",
        icon: "<?php echo $_SESSION['status-code']?>",
        button: "OK!",
      });
      </script>
      <?php
 }
 ?>
</body>

</html>