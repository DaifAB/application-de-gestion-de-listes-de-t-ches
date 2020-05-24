<!DOCTYPE html>
<html>
<head>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>


<?php

require('config.php');
require('class.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $user = new USER();


$user->username = stripslashes($_REQUEST['username']);
$user->username = mysqli_real_escape_string($conn, $user->username);

$user->email = stripslashes($_REQUEST['email']);
$user->email = mysqli_real_escape_string($conn, $user->email);

$user->password = stripslashes($_REQUEST['password']);
$user->password = mysqli_real_escape_string($conn, $user->password);

$user->firstname = stripslashes($_REQUEST['firstname']);
$user->firstname = mysqli_real_escape_string($conn, $user->firstname);

$user->lastname = stripslashes($_REQUEST['lastname']);
$user->lastname = mysqli_real_escape_string($conn, $user->lastname);

$user->photo = stripslashes($_REQUEST['photo']);
$user->photo = mysqli_real_escape_string($conn, $user->photo);



  $query = "INSERT into user (username, password, email, firstname, lastname, photo)
            VALUES ('$user->username', '$user->password', '$user->email', '$user->firstname' , '$user->lastname' , '$user->photo')";

  $res = mysqli_query($conn, $query);
  if($res){
    header("Location: index.php");
  }
}else{
?>
<h1 class="title">To-Do List !</h1>
<div class="form-container">
<form class="text-center border border-light p-5" action="" method="post">
    <p class="h4 mb-4 sign">S'inscrire</p>
    <input type="text" class="form-control mb-4" name="firstname" placeholder="Votre Prénom" required />
    <input type="text" class="form-control mb-4" name="lastname" placeholder="Votre Nom" required />
    <input type="text" class="form-control mb-4" name="username" placeholder="Nom d'utilisateur" required />
    <input type="email" class="form-control mb-4" name="email" placeholder="Email" required />
    <input type="password" class="form-control mb-4" name="password" placeholder="Mot de passe" required />
    <input type="text" class="form-control mb-4" name="photo" placeholder="Lien de votre photo" required />
    <input type="submit" name="submit" value="S'inscrire" class="btn btn-info btn-block my-4" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous par ici</a></p>


</div>
<?php } ?>
</body>
</html>


<!--       _
       .__(.)< (SKETCH)
        \___)
 ~~~~~~~~~~~~~~~~~~-->