
<?php
// including the database connection file
include_once "config.php";
require_once 'includes/classes/Announcement.php';

$db = new Database();
$announcement = new Announcement($db);
$options = [
    "Studio",
    "chambre",
    "Foyer",
    "Résidance",
    "maison",
];
$id = intval($_GET['id']);

//selecting data associated with this particular id
$result = $announcement->getAnnouncement($id);

if (isset($_POST['update'])) {
   if(!is_uploaded_file($_FILES['file']['tmp_name']) || !file_exists($_FILES['file']['tmp_name'])){
    $id = $_POST['id'];   
    $img_folder = $_POST['image'];

    $typeDeBien = $_POST['typeDeBien'];
    $details = $_POST['details'];

    $announcement->update($id, $img_folder, $details, $typeDeBien);
   
   }else{
    $id = $_POST['id'];
    $img_name = $_FILES["file"]["name"];
    $img_temp_name = $_FILES["file"]["tmp_name"];
    $img_folder = "imge/" . $img_name;

    $typeDeBien = $_POST['typeDeBien'];
    $details = $_POST['details'];

    if (move_uploaded_file($img_temp_name, $img_folder)) {
        $announcement->update($id, $img_folder, $details, $typeDeBien);
    } else {
        echo "<script>alert('Veuillez réessayer');</script>";
        echo "<script>window.location.href='prop.php'</script>";
    }
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


</head>
<body>
  <?php
foreach ($result as $data) {?>
       <form  name="form1" method="post" action="editAnnonce.php" enctype="multipart/form-data">
               <h2> vous povez modifiez votre annonce</h2>
               <br/><br/>
                          <label for="exampleFormControlFile1">modifier  photo </label>
                          <input type="hidden" name="image" id="image"  value="<?php echo htmlentities($data->image); ?>">
                          <input type="file" class="form-control-file" id="file" name="file" >

              <br/><br/>
                          <select class="form-select" name="typeDeBien"  >
                              <option selected>type De Bien menu</option>
                              <?php
                                  foreach ($options as $key => $op) {
                                      echo '<option value="' . $op . '"';
                                      if ($op == $data->typeDeBien) {
                                          echo ' selected';
                                      }
                                      echo ' >' . $op . '</option>';
                                  }?>
                          </select>
                          <br/><br/>
                    <p> details </p>
                    <textarea name="details"  ><?php echo htmlentities($data->details); ?></textarea>   <br/><br/>
                    <input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
                          <input type="submit"  class="btn btn-search" name="update" value="modifier">
                </form>

                <?php }?>
</body>
</html>