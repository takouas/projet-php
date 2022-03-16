
<?php
//including the database connection file
include("config.php");
require_once 'includes/classes/User.php';

//getting id of the data from url
$id = intval($_GET['id']);
$db = new Database();
$user = new User($db);
$user->deleteUser($id);
//redirecting to the display page (index.php in our case)
header("Location:admin.php");
?>