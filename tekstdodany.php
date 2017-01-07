<?php
    //session_start();
	
    //Usuwanie zmiennych pamiętających wartości wpisane do formularza
    if (isset($_SESSION['fr_temat'])) unset($_SESSION['fr_temat']);
    if (isset($_SESSION['fr_tresc'])) unset($_SESSION['fr_tresc']);
	
    //Usuwanie błędów rejestracji
    if (isset($_SESSION['e_temat'])) unset($_SESSION['e_temat']);
    if (isset($_SESSION['e_tresc'])) unset($_SESSION['e_tresc']);	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Tekst dodany</title>
        
        <meta name="description" content="Dodaj tekst, który chcesz żeby został przetłumaczony" />
	<meta name="keywords" content="tekst, temat, autor, język, tłumaczenie, przetłumaczyć" />
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Tekst dodany!</spam>
        <div class="linia"></div>
        
        Tekst został dodany! Możesz go zobaczyć przechodząć w zakładkę <a href="index.php?menu=5" style="color: #000000; text-decoration: underline;">"Tłumacz".</a>
        
    </body>   
</html>



