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
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="script.js"></script>
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
<h1 class="title">Mes Tâches !</h1>
<img src="img/arrow.png" alt="">
</div>

<div class="container">


<?php

if(isset($_GET['update'])){
  $id = $_GET["update"];


  $sql = "SELECT * FROM task WHERE id = '$id'";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
?>


<form class="border border-light p-5" method="post">

<p class="h4 mb-4 text-center">Modifier :</p>


<label for="textInput">Tâches</label>
<input type="text" id="textInput" class="form-control mb-4" placeholder="Nom" name="tasktext" value="<?php echo $row["taskText"] ?>" required>
<input type="hidden" name="id" class="input" value="<?php echo $id; ?>" >


<button class="btn btn-info btn-block btn-dark" type="submit" name="edittask">Modifier</button>
</form>

      <?php } else { ?>

        <form class="border border-light p-5" method="post">

    <p class="h4 mb-4 text-center">Créer :</p>


    <label for="textInput">Tâche :</label>
    <input type="text" id="textInput" class="form-control mb-4" placeholder="Nom" name="tasktext" required>
    <input type="hidden" name="idtask" class="input" value="<?php echo $_GET['idtask']; ?>"  >

    <button class="btn btn-info btn-block btn-dark" type="submit" name="addtask">Ajouter</button>
</form>



        <?php

      } ?>



<div class="row">

<div class="table-responsive text-nowrap">

  <table class="table mytable">
    <thead class="black white-text">
      <tr>
        <th scope="col">N#</th>
        <th scope="col">Finie ?</th>
        <th scope="col">Tâches</th>
        <th scope="col"></th>
        <th scope="col"></th>

      </tr>
    </thead>
    <tbody>
<?php


$sql = "SELECT * FROM task WHERE todolist_id = '{$_GET["idtask"]}'";
$result = $conn->query($sql);


$i = 1;
while($row = $result->fetch_assoc()) {

    ?>
<tr style="background-color : black">
      <th scope="row"><?php echo $i++; ?></th>
      <td>
      <input name="<?php echo $row['id'] ?>" class="checkboox " id="check" onclick="cheeck('1','<?php echo $row['id'] ?>')" type="checkbox" value="<?php echo $row['done'] ?>" ></td>
      <td>
      <p class="text"><?php echo $row['taskText']; ?></p>
      </td>
     
      <td><a class="delet" href="task.php?deltask=<?php echo $row['id'] ?>&idtask=<?php echo $_GET["idtask"] ?>"><i class="fas fa-trash-alt"></i> </a></td>
      <td><a class="delet" href="task.php?update=<?php echo $row['id'] ?>&idtask=<?php echo $_GET["idtask"] ?>"><i class="far fa-edit "></i> </a></td>

    <?php

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
    <a> Sketch</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->


<div id="result"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="script.js"></script>

<script>

var checkBox = document.getElementsByClassName("checkboox");
var text= document.getElementsByClassName("text");

for (let i = 0 ; i<checkBox.length ; i++){
        if (checkBox[i].value == 1){

          text[i].style.textDecoration = 'line-through';
          checkBox[i].checked = true;

        }else{
          text[i].style.textDecoration = 'none';
          checkBox[i].checked = false;
        }

      }



</script>
  </body>
</html>


	<!--       _
       .__(.)< (SKETCH)
        \___)
 ~~~~~~~~~~~~~~~~~~-->