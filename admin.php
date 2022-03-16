
<?php

require 'config.php';
require_once 'includes/classes/User.php';
$db = new Database();
$user = new User($db);
$result = $user->getAllUsersNoAdmin();
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
            <a class="navbar-brand" href="">Users</a>
            <a class="navbar-brand" href="./annonce.php">annonce</a>
          </div>
         
          <div class="nav navbar-nav navbar-right">
            
          <a href="logout.php"><i class="fas fa-power-off"></i>Log Out</a>
            
        </div>
      </nav> 


     <!-- box chercher  utilisateur -->
     <div id='users' class="container--interface-admine">
      <center>
        <div class="container-btn-search-admin">
          <input type="text" class="form-control"  id="myInput" onkeyup="myFunction()" placeholder="chercher par Nom"/>
            <button class="btn btn-search" type="button">
              <i class="fa fa-search"></i>
            </button>
        </div>
      </center>
        <br/>
        <!-- Liste utilisateur -->
        <h2 class="titre-Liste-users">Liste utilisateur </h2>
        <br/>
      <table id="myTable">
        
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">email</th>
              <th scope="col">type</th>
              <th scope="col">supprimer</th>
            </tr>
          </thead>
         <tbody>
         <?php 
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
    foreach ($result as $res) {?>	
  	<tr>

		<td data-label='Nom' > <?php echo htmlentities($res->username)?></td>
		<td data-label='email'> <?php echo htmlentities($res->email)?></td>	
    <td data-label='type'> <?php echo htmlentities($res->type)?></td>	
    <td data-label='supprimer'>  <?php echo " <a href=\"deleteUser.php?id=$res->id\" onClick=\"return confirm('Are you sure you want to delete?')\"> <i class='fas fa-user-minus'></i></a>" ?>	

    <?php }?>


          </tbody>
      </table>  
    </div>
    <script>
      function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[0];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }       
        }
      }
      </script>
</body>
</html>