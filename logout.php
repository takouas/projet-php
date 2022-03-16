<?php
	// Initialiser la session
	session_start();
	unset($_SESSION['is_logged_in']) ;
	unset($_SESSION['type']) ;
    unset($_SESSION['user_id'] );
	// Détruire la session.
	if(session_destroy())
	{
		// Redirection vers la page de connexion
		header("Location: client.php");
	}
?>