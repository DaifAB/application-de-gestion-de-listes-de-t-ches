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


require('class.php');
require('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {

  $user = new USER();


$user->username = stripslashes($_REQUEST['username']);
$user->username = mysqli_real_escape_string($conn, $user->username); 

$user->email = stripslashes($_REQUEST['email']);
$user->email = mysqli_real_escape_string($conn, $user->email);

$user->firstname = stripslashes($_REQUEST['firstname']);
$user->firstname = mysqli_real_escape_string($conn, $user->firstname);

$user->lastname = stripslashes($_REQUEST['lastname']);
$user->lastname = mysqli_real_escape_string($conn, $user->lastname);

$user->UpdateInfromation($_GET['id'], $user->username, $user->email, $user->firstname, $user->lastname,$conn);



  }

?>

<h1 class="title">To-Do List !</h1>
<div class="form-container">
<form class="text-center border border-light p-5" action="" method="post">
    <p class="h4 mb-4 sign">Modifier Votre profile</p>
    <input type="text" class="form-control mb-4" name="firstname" placeholder="Votre Prénom" required />
    <input type="text" class="form-control mb-4" name="lastname" placeholder="Votre Nom" required />
    <input type="text" class="form-control mb-4" name="username" placeholder="Nom d'utilisateur" required />
    <input type="email" class="form-control mb-4" name="email" placeholder="Email" required />
    <input type="submit" name="submit" value="Modifier" class="btn btn-info btn-block my-4" />


</div>

</body>
</html>


<!--       _
       .__(.)< (SKETCH)
        \___)   
 ~~~~~~~~~~~~~~~~~~-->