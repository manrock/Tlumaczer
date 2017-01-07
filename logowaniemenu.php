<?php
    //session_start();
    
    //Jeżeli użytkownik jest już zalogowany przejdź do
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
        header('Location: zalogowany.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Logowanie</title>
        
        <meta name="description" content="Logowanie do serwisu. Wpisz login i hasło" />
	<meta name="keywords" content="login, hasło, logowanie, serwis, uwierzytelnianie" />
        
        <script src="jquery-3.1.1.min.js"></script>  

        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Logowanie</spam>
        <div class="linia"></div>
        
        <form action="zaloguj.php" method="post" autocomplete="false">
            <input type="text" style="display:none;">
            
            Nazwa użytkownika </br>
            <input type="text" name="login" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" autocomplete="off"/>
            </br></br>
            
            Hasło </br>
            <input type="password" name="haslo" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" autocomplete="off" />
            </br></br>
        
            <input type="submit" value="Zaloguj"/>   
        </form>
        </br>
        
        <a href="index.php?menu=9" style="color: #000000; text-decoration: underline;">Nie masz jeszcze konta? Załóż je!</a>
        </br></br>
        
        <?php
        //Wypisanie błędu jeżeli wprowadzane dane nie są prawidłowe
	if(isset($_SESSION['blad']))	
        echo $_SESSION['blad'];
        unset($_SESSION['blad']);
        ?>
    </body>   
</html>


