<?php

	session_start();
	
	if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
	
	//Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_haslo1'])) unset($_SESSION['fr_haslo1']);
	if (isset($_SESSION['fr_haslo2'])) unset($_SESSION['fr_haslo2']);
        if (isset($_SESSION['fr_kraj'])) unset($_SESSION['fr_kraj']);
        if (isset($_SESSION['fr_plec'])) unset($_SESSION['fr_plec']);
        if (isset($_SESSION['fr_dataur'])) unset($_SESSION['fr_dataur']);
	if (isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);
	
	//Usuwanie błędów rejestracji
	if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_haslo'])) unset($_SESSION['e_haslo']);
        if (isset($_SESSION['e_kraj'])) unset($_SESSION['e_kraj']);
        if (isset($_SESSION['e_plec'])) unset($_SESSION['e_plec']);
        if (isset($_SESSION['e_dataur'])) unset($_SESSION['e_dataur']);
	if (isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Witamy</title>
        <script src="jquery-3.1.1.min.js"></script>  
       
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Witamy!</spam>
        <div class="linia"></div>
        Dziękujemy za rejestrację w serwisie! Możesz już zalogować się na swoje konto!<br/><br/>
	
        <a href="index.php?menu=2"><span style="color: #000000; text-decoration: underline;">Zaloguj się na swoje konto!</span>
        </a>
        
    </body>
    
</html>




