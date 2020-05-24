<?php


  // Initialiser la session
  session_start();
  require('config.php');
  require('class.php');
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }


?>

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
<link href="https://fonts.googleapis.com/css2?family=Coming+Soon&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style1.css" />
  </head>
  <body>

  <!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark black">
    <a class="navbar-brand" href="#">TO-DO LIST</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
      aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Accueil
            <span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto nav-flex-icons right">

        <?php
        if(!isset($_SESSION["username"])){

            echo '
            <li class="nav-item">
                <a href="login.php" class="nav-link waves-effect waves-light">
                    Se connecter !
                </a>
              </li>
              ';
        }else {
          $sql = "SELECT * FROM user WHERE id = '{$_SESSION[ "id" ]}'";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
              echo '
        <li class="nav-item">
          <a class="nav-link waves-effect waves-light">
            <img src="'.$row['photo'].'" class="rounded-circle z-depth-0" alt="avatar image" height="55" width="55">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect waves-light">
            '.$row["username"].'
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-default"
            aria-labelledby="navbarDropdownMenuLink-333">
            <a class="dropdown-item" href="updateuser.php?id='.$_SESSION["id"].'">Changer les informations</a>
            <a class="dropdown-item" href="updatephoto.php?id='.$_SESSION["id"].'">Changer la photo de profile</a>
            <a class="dropdown-item" href="updatepassword.php?id='.$_SESSION["id"].'">Changer le mot de passe</a>
            <a class="dropdown-item" href="logout.php">Deconnexion</a>
          </div>
        </li>';
        }
        ?>
      </ul>
    </div>
  </nav>
  <!--/.Navbar -->
<div class="title-container">
  <h1 class="title">My To-do lists !</h1>
  <img src="img/arrow.png" alt="">
</div>

<div class="container">



<?php

if(isset($_GET['update'])){
  $id = $_GET["update"];


  $sql = "SELECT * FROM todolist WHERE id = '$id'";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
?>


<form class="border border-light p-5" method="post">

<p class="h4 mb-4 text-center">Modifier :</p>


<label for="textInput">To-Do</label>
<input type="text" id="textInput" class="form-control mb-4" placeholder="Nom" name="task" value="<?php echo $row["name"] ?>"required>
<input type="hidden" name="id" class="input" value="<?php echo $id; ?>"  >

<label for="select">Couleur</label>
<select class="browser-default custom-select mb-4" id="select" name="color" required>
    <option value="" disabled="" selected="">Choisis la couleur</option>
    <option style='color: rgba(178, 190, 195,1.0)' value="rgba(178, 190, 195,1.0)">Soothing Breeze</option>
    <option style='color: rgba(99, 110, 114,1.0)' value="rgba(99, 110, 114,1.0)">American River</option>
    <option style='color: rgba(45, 52, 54,1.0)' value="rgba(45, 52, 54,1.0)">Deep Cove</option>
    <option style='color: rgba(52, 73, 94,1.0)' value="rgba(52, 73, 94,1.0)">West Asphalt</option>
    <option style='color: rgba(44, 62, 80,1.0)' value="rgba(44, 62, 80,1.0)">Midnight Blue</option>
    <option style='color: rgba(19, 15, 64,1.0)' value="rgba(19, 15, 64,1.0)">Deep Cove</option>
</select>

<button class="btn btn-info btn-block btn-dark" type="submit" name="edit">Modifier</button>
</form>

      <?php } else { ?>

        <form class="border border-light p-5" method="post">

    <p class="h4 mb-4 text-center">Créer :</p>


    <label for="textInput">To-Do</label>
    <input type="text" id="textInput" class="form-control mb-4" placeholder="Nom" name="task" required>

    <label for="select">Couleur</label>
    <select class="browser-default custom-select mb-4" id="select" name="color" required>
        <option value="" disabled="" selected="">Choisis la couleur</option>
        <option style='color: rgba(178, 190, 195,1.0)' value="rgba(178, 190, 195,1.0)">Soothing Breeze</option>
        <option style='color: rgba(99, 110, 114,1.0)' value="rgba(99, 110, 114,1.0)">American River</option>
        <option style='color: rgba(45, 52, 54,1.0)' value="rgba(45, 52, 54,1.0)">Deep Cove</option>
        <option style='color: rgba(52, 73, 94,1.0)' value="rgba(52, 73, 94,1.0)">West Asphalt</option>
        <option style='color: rgba(44, 62, 80,1.0)' value="rgba(44, 62, 80,1.0)">Midnight Blue</option>
        <option style='color: rgba(19, 15, 64,1.0)' value="rgba(19, 15, 64,1.0)">Deep Cove</option>
    </select>

    <button class="btn btn-info btn-block btn-dark" type="submit" name="submit">Ajouter</button>
</form>



        <?php

      } ?>



<div class="row">

<div class="table-responsive text-nowrap">

  <table class="table mytable">
    <thead class="black white-text">
      <tr>
        <th scope="col">N#</th>
        <th scope="col">To-do</th>
        <th scope="col"></th>
        <th scope="col"></th>

      </tr>
    </thead>
    <tbody>
<?php


$sql = "SELECT * FROM todolist WHERE user_id = '{$_SESSION[ "id" ]}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

$i = 1;
while($row = $result->fetch_assoc()) {

    ?>
<tr style="background-color:<?php echo $row['color'] ?>;">
      <th scope="row"><?php echo $i++; ?></th>
      <td > <a  style="color : white" href="task.php?idtask=<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></a> </td>
      <td><a class="delet" href="index.php?del=<?php echo $row['id'] ?>"><i class="fas fa-trash-alt"></i> </a></td>
      <td><a class="delet" href="index.php?update=<?php echo $row['id'] ?>"><i class="far fa-edit "></i> </a></td>

    <?php

  }

}
?>
    </tbody>
</table>

      </div>
    </div>

</div>


<!-- Footer -->
<footer class="page-footer font-small black">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="https://mdbootstrap.com/"> Sketch</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
  </body>
</html>


	<!--       _
       .__(.)< (SKETCH)
        \___)
 ~~~~~~~~~~~~~~~~~~-->