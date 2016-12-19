<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: logowaniemenu.php');
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Zalogowano!</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
    <spam class="naglowki">Zalogowano!</spam>
        <div class="linia"></div>
        
        <?php
            echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php" style="font-size: 15px; font-weight: 600; text-decoration: none; color: #078AB5;">Wyloguj się!</a> ]</p>';
            echo "Możesz teraz swobodnie dodawać lub tumaczyć teksty!"
        ?>
        
    </body>
    
</html>