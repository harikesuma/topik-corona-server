<?php
if (isset($_COOKIE['id']) || isset($_COOKIE['nama']) || isset($_COOKIE['username']) || isset($_COOKIE['email'])) {  
  header("Location: index.php");
  }
  else{
    setcookie('id', "", time() - 3600, "/");
    setcookie('nama', "", time() - 3600, "/");
    setcookie('username', "", time() - 3600, "/");
    setcookie('email', "", time() - 3600, "/");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body style="background-image: url('http://www.seekgif.com/uploads/2017/06/polygon-background-1-jpg-1.jpeg');">
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="row">
            <div class="col s3"></div>
            <div class="col s6">
            <div class="card" style="margin-top: 45%">
                <div class="card-content" style="text-align:center;">
                    <center><span class="card-title">Login</span></center><br>
                    <form action="action/login_admin.php" method="post">
                        <div class="input-field" style="width:75%; display: inline-block;">
                            <input id="username" type="text" class="validate" name="username">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field" style="width:75%; display: inline-block;">
                            <input id="password" type="password" class="validate" name="password">
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field" style="width:75%; display: inline-block;">
                            <button class="btn waves-effect waves-light btn-large cyan darken-1" type="submit" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col s3"></div>
        </div>
    </div>
    </div>
  </div>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
