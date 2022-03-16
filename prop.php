<?php
session_start();
//var_dump($_SESSION['user_id']);
require 'config.php';
require_once 'includes/classes/Announcement.php';
$db = new Database();
$announcement = new Announcement($db);

if ($_SESSION['type'] == "admin") {
    $result = $announcement->getAllAnnoucenments();
} else {
    $uid = $_SESSION['user_id'];
    $result = $announcement->getLoggedInUserAnnoucenments($uid);
}

if (isset($_POST['insert'])) {
    $img_name = $_FILES["uploadedimage"]["name"];
    $img_temp_name = $_FILES["uploadedimage"]["tmp_name"];
    $img_folder = "imge/" . $img_name;
    $user_id = $_SESSION['user_id'];

    $details = $_POST['details'];
    $typeDeBien = $_POST['typeDeBien'];
    if (move_uploaded_file($img_temp_name, $img_folder)) {
        $announcement->insert($user_id,$img_folder, $details, $typeDeBien);
    } else {
        echo "<script>alert('Veuillez réessayer');</script>";
        echo "<script>window.location.href='prop.php'</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>prop</title>
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

      <!-----------------------------------------navbar --------------- -->

      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"><img src ="./imge/logo.png" height="30px"></a>
          </div>

          <div class="nav navbar-nav navbar-right">
          <a href="logout.php"><i class="fas fa-power-off"></i>Log Out</a>
          <!-- <button class="btn-user-cnx"><i class="fas fa-power-off"></i>Log Out</button> -->

        </div>
      </nav>



                                <!--------------------------------- ajouter  ---------------------------->



               <!-- Button trigger modal -->
               <button type="button" class="btn " data-toggle="modal" data-target="#ajouter">
               ajouter
           </button>
                <!-- Modal -->
                <div class="modal fade" id="ajouter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ajouter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <form  method="post"  enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="exampleFormControlFile1">insérer photo </label>
                              <input type="file" class="form-control-file"  id="exampleFormControlFile1" name="uploadedimage">
                            </div>

                        <select class="form-select"  name="typeDeBien" >
                            <option selected>type De Bien menu</option>
                            <option value="maison">maison</option>
                            <option value="Résidance"> Résidance</option>
                            <option value="Foyer">Foyer privé</option>
                            <option value="chambre">chambre</option>
                            <option value="Studio">Studio</option>
                        </select>
                        <p> details </p>
                        <textarea name="details" ></textarea>  <br/><br/>
                        <input type="submit" name="insert" value="ajouter" class="box-button btn btn-search" />
                    </form>
                      </div>

                    </div>
                  </div>
                </div>




       <!-- Liste card -->




    <div class="card-list-client" id="card-list-client">
     <?php
//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
foreach ($result as $res) {?>
    <div class="card">
     <img src="<?php echo htmlentities($res->image); ?>" alt="" style="width:100%">
     <div class="container-card">
       <h4 class="type-de-bien"><b><?php echo htmlentities($res->typeDeBien); ?></b></h4>

                 <!-- Button trigger modal -->
                 <button type="button" class="btn " data-toggle="modal" data-target="#plus-<?php echo htmlentities($res->id); ?>">
                   <i class="fa fa-list"></i>  voir plus
                </button>
                   <!-- Modal -->
                   <div class="modal fade" id="plus-<?php echo htmlentities($res->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">voir plus</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body">

                           <p> <?php echo htmlentities($res->details); ?></p>

                         </div>

                       </div>
                     </div>
                   </div>
                   <?php echo "<a href=\"editAnnonce.php?id=$res->id\"><i class='far fa-edit'></i></a> | <a href=\"deleteAnnonce.php?id=$res->id\" onClick=\"return confirm('Are you sure you want to delete?')\"> <i class='fas fa-trash-alt'></i></a>" ?>
     </div>


   </div>
     <?php }?>



      </div>



 </div>

</div>

      <!-----------------------------------------footer --------------- -->
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
          <a class="text-white aCopyright" href="" >logement</a>
        </div>
        <!-- Copyright -->
      </footer>
</body>
</html>