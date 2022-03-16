<?php

require 'config.php';
require_once 'includes/classes/Announcement.php';

$db = new Database();
$announcement = new Announcement($db);
$result = $announcement->getAllAnnoucenments();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Liste utilisateur</title>
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
</head>
<body>
      <!-----------------------------------------navbar --------------- -->

      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#"><img src ="./imge/logo.png" height="30px"></a>
            <a class="navbar-brand" href="./admin.php">Users</a>
            <a class="navbar-brand" href="">annonce</a>
          </div>
         
          <div class="nav navbar-nav navbar-right">
            
          <a href="logout.php"><i class="fas fa-power-off"></i>Log Out</a>
            
        </div>
      </nav> 
      <!-- Liste card -->
       

 <div id='annone' class="card-list-client">
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


</body>
</html>