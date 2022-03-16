<?php

include_once "config.php";
require_once 'includes/classes/Announcement.php';
require_once 'includes/classes/User.php';


// if(isset($GET['username'])){
//   $query = "SELECT 'type' FROM `users` WHERE username='$username' ";
//   if ($query['type'] == 'admin') {
//     header('location: admin.php');      
//   }else{
//     header('location: prop.php');
//   }
// }else{
//   $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";

// }
// affichage annonce
$db = new Database();
$announcements = new Announcement($db);

$result = $announcements->getAllAnnoucenments();

//ajout user 
$user = new User($db);

if (isset($_POST['inscription'])) {
 
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $resultUsers = $user->inscription($username,$password,$email);
    
}

$resultUsers = $user->getAllUsers();
//login 

if (isset($_POST['login'])) {
 
  $username = $_POST['username'];
  $password = $_POST['password'];
  $resultUsers = $user->login($username,$password);

  //die(htmlentities($resultUsers->type));
  if ($resultUsers['type']) {    
    // vérifier si l'utilisateur est un administrateur ou un utilisateur
    if ($resultUsers['type'] == 'admin') {
      header('location: admin.php');      
    }else{
      header('location: prop.php');
    }
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    echo "<script> alert('invalide champes')</script>";
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>client</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- my css -->
  <link rel="stylesheet" href="tableau.css">
   <!-- fontawsom link -->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
  <!-- Bootstrap link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body>
      <!-----------------------------------------navbar -------------------------------------------------------------------------------- -->
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src ="./imge/logo.png" height="30px"></a>
    </div>

    <div class="nav navbar-nav navbar-right">

               <!------------------------inscription -------------------------- -->


<button type="button"  class="btn btn-user-cnx" data-toggle="modal" data-target="#inscription">
        <span class="glyphicon glyphicon-user"></span> inscription
   </button>
        <!-- Modal -->
        <div class="modal fade" id="inscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">S'inscrire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
			  <form class="box" action="" method="post">


<center>
<input type="text" class="box-input form-control"   name="username" placeholder="Nom d'utilisateur" required /> <br/> <br/>
<input type="text" class="box-input form-control"  name="email" placeholder="Email" required /> <br/> <br/>
<input type="password"class="box-input form-control" name="password" placeholder="Mot de passe" required /> <br/> <br/>
<input type="submit"  class="btn btn-search" type="button" name="inscription" value="S'inscrire" class="box-button" />
</center>
</form>
              </div>

            </div>
          </div>
        </div>



     <!-------------------------Login --------------------- -->

    
  <button type="button"  class="btn btn-user-cnx" data-toggle="modal" data-target="#Login">
          <span class="glyphicon glyphicon-log-in"></span> Login</a>
     </button>
          <!-- Modal -->
          <div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">


				<form class="box" action="" method="post" >
<center>

<input type="text" class="box-input form-control" name="username" placeholder="Nom d'utilisateur" required> <br/><br/>
<input type="password" class="box-input form-control" name="password" placeholder="Mot de passe" required> <br/><br/>
<input type="submit" value="Connexion " name="login" class="btn btn-search">

<?php if (!empty($message)) {?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php }?>
</center>
</form>

                </div>

              </div>
            </div>
          </div>

  </div>
</nav>


     <!----------------------------------------------------------------------- box chercher  card ---------------------------------->
    <center>
        <div class="container-btn-search-admin">
          <input type="text" class="form-control" id="input-chercher-type-de-bien" onkeyup="myFunction()" placeholder="chercher.."/>
            <button class="btn btn-search" type="button">
              <i class="fa fa-search"></i>
            </button>
        </div>
      </center>
       <!--------------------------------------------------------------- Liste card ---------------------------------------------------->




    <div class="card-list-client" id="card-list-client">
     <?php


foreach ($result as $res) {?>
       <div class="card">
        <img  class="card-imge-annonce" src="<?php echo htmlentities($res->image)?>" alt="" style="width:100%" >
        <div class="container-card">
          <h4 class="type-de-bien"><b><?php echo htmlentities($res->typeDeBien)?></b></h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn " data-toggle="modal" data-target="#plus-<?php echo htmlentities($res->id)?>">
                      <i class="fa fa-list"></i>  voir plus
                   </button>
                      <!-- Modal -->
                      <div class="modal fade" id="plus-<?php echo htmlentities($res->id)?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">voir plus</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p><?php echo htmlentities($res->details)?></p>
                            </div>

                          </div>
                        </div>
                      </div>

        </div>
        </div>
        <?php }?>



      </div>


           <!----------------------------------------------------------------------- services  ------------------------------------------->

           <div class="container ">
            <div class="row ">
                <div class="col-md-4 col-sm-6">
                    <div class="serviceBox">
                        <div class="service-icon"><i class="fas fa-bed"></i> </div>
                        <h3 class="title">disponabilité</h3>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur, deleniti eaque excepturi.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                  <div class="serviceBox">
                      <div class="service-icon"><i class="fas fa-house-user"></i></div>
                      <h3 class="title">inexpensive</h3>

                      <p class="description">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur, deleniti eaque excepturi.
                      </p>
                  </div>
              </div>

              <div class="col-md-4 col-sm-6">
                <div class="serviceBox">
                    <div class="service-icon"><i class="fas fa-search-location"></i></div>
                    <h3 class="title">simple recherche </h3>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium consequuntur, deleniti eaque excepturi.
                    </p>
                </div>
            </div>
            </div>
        </div>




      <!------------------------------------------------------------- box slogan ------------------------------------------------------->
      <div  class="container-slogan">
        <h2  class="titre-slogan" >“ Bien logé dans un bon logement ” </h2>
      </div>



      <!-----------------------------------------footer ---------------------------------------------------------------------------- -->
      <footer class=" container-footer  text-center text-lg-start footer">
        <!-- Grid container -->
        <div class="container p-4">
          <!--Grid row-->
          <div class="row">

            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">


                <img src ="./imge/Logement (1).png" >

            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
              <h5 class="text-uppercase">service</h5>
              <p>
                Trouver un logement , c’est simple sur ....
              </p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
              <h5 class="text-uppercase mb-0">Contactez nous </h5>

              <p>E-mail:takoua.saadaouii@gmail.com</p>
                  <p > tel:225255</p>

            </div>

          </div>

        </div>



      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2021 Copyright:
        <a class="text-white aCopyright" href="">logement</a>
      </div>
      <!-- Copyright -->
    </footer>

<script>
  function myFunction() {
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById("input-chercher-type-de-bien");
      filter = input.value.toUpperCase();
      ul = document.getElementById("card-list-client");
      li = ul.getElementsByClassName("card");
      for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByClassName("type-de-bien")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
          } else {
              li[i].style.display = "none";
          }
      }
  }
  </script>
</body>
</html>