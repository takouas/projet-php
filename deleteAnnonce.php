<?php
//including the database connection file
include("config.php");
require_once 'includes/classes/Announcement.php';

//getting id of the data from url
$id = intval($_GET['id']);
$db = new Database();
$announcement = new Announcement($db);
$announcement->delete($id);
//redirecting to the display page (index.php in our case)
header("Location:prop.php");
?>