<?php
    //session_start();
	
    //Usuwanie zmiennych pamiętających wartości wpisane do formularza
    if (isset($_SESSION['fr_nick'])) unset($_SESSION['fr_nick']);
    if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
    if (isset($_SESSION['fr_temat'])) unset($_SESSION['fr_temat']);
    if (isset($_SESSION['fr_wiadomosc'])) unset($_SESSION['fr_wiadomosc']);
	
    //Usuwanie błędów rejestracji
    if (isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
    if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
    if (isset($_SESSION['e_temat'])) unset($_SESSION['e_temat']);
    if (isset($_SESSION['e_wiadomosc'])) unset($_SESSION['e_wiadomosc']);	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        
        <meta name="description" content="Informacja wysłania wiadomości do admina" />
	<meta name="keywords" content="wiadomość, kontakt, admin, administrator, e-mail" />
        
        <title>Wiadomość wysłana</title>
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Wiadomość wysłana!</spam>
        <div class="linia"></div>
        
        Wiadomość została wysłana do administracji! Proszę cierpliwie czekać na odpowiedź.   
        
    </body>   
</html>

