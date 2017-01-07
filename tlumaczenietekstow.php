<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Przetłumacz</title>
        
        <meta name="description" content="Przetłumacz tekst, który został dodany przez użytkownika serwisu" />
	<meta name="keywords" content="tłumaczenie, teksty, społeczność, użytkownicy" />
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Przetłumacz</spam>
        <div class="linia"></div>
    
        <?php
            //session_start();
        
            //Odczytanie POSTA z tlumaczmenu.php
            echo"<form action='index.php?menu=16' method='post'>";
                echo"Użytkownik wystawiający: <br> <input type='text' name='user' readonly='' value='".$_POST['uzy']."'/>"."<br><br>".
                "Użytkownik tłumaczący: <br> <input type='text' name='user2' readonly='' value='".$_SESSION['user']."'/>"."<br><br>".

                "Język oryginalny: <br> <input type='text' name='jezykory' readonly='' value='".$_POST['j1']."'/>"."<br><br>".
                "Język docelowy: <br> <input type='text' name='jezykdoc' readonly='' value='".$_POST['j2']."'/>"."<br><br>".
                "Temat: <br> <input type='text' name='temat' readonly='' value='".$_POST['tem']."'/>"."<br><br>".
                "<input type='hidden' name='idtek' value='".$_POST['idtekstu']."'/>".
                "Tekst: <br> <textarea name='wiadomosc' cols='80' rows='20' readonly='' >".$_POST['wiadom']."</textarea>"."<br><br>".
                "Tekst przetłumaczony: <br> <textarea name='wiadomosc2' cols='80' rows='20' ></textarea>"."<br>"."<br>".
                "<input type='submit' name='tluaczenie' value='Dodaj tłumaczenie'/><br>";
            echo "</form>";
         
            //Czy zalogowany jest admin? Jak tak to pokaż guzik do usuwania
            if ($_SESSION['user'] == 'admin')
            {
		echo"<form action='index.php?menu=18' method='post'>";
                echo "<input type='submit' name='usuntekst' value='Usuń'/><br><br><br>".
                     "<input type='hidden' name='idtek2' value='".$_POST['idtekstu']."'/>";
                echo "</form>";
            }	       
        ?>     
    </body>   
</html>



