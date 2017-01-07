<?php
    //session_start();

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php?menu=17');
	exit();
    }
?>        
       
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        
        <meta name="description" content="Wybierz tekst, ktory chcesz przetłumaczyć na wybrany język" />
	<meta name="keywords" content="tekst, język, tłumacz, tłumaczenie" />
        
        <title>Przetłumacz</title>
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Przetłumacz tekst</spam>
        <div class="linia"></div>

        <?php

	
	require_once "bazadanych.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
        //Łączeie się z bazą danych
	try 
	{
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                //Wybieramy dane potrzebne do przedstawienia tekstów do tłumaczenia
                $wczytajtekst;
                $tekstdotlumaczenia = $polaczenie->query("SELECT id_teksty, temat, tekst, id_jez_ory, nazwa, id_jez_doc FROM teksty, uzytkownicy WHERE teksty.id_uzy = uzytkownicy.id AND tlumaczenie=''");
                if(mysqli_num_rows($tekstdotlumaczenia) > 0)
                {
                    while($rrr = mysqli_fetch_assoc($tekstdotlumaczenia))
                    {
                        $wczytajtemat = $rrr['temat'];
                        $wczytajtekst = $rrr['tekst'];
                        $wczytajnazwa = $rrr['nazwa'];
                        $wczytajidwiersza = $rrr['id_teksty'];
                            
                        $wczytajjezykory = $rrr['id_jez_ory'];
                        $tekstid2 = $polaczenie->query("SELECT jezyk_ory FROM jezyk  WHERE id='$wczytajjezykory'");
                        $rrrrr = mysqli_fetch_assoc($tekstid2);
                        $wczytajidjezory2 = $rrrrr['jezyk_ory'];
                            
                        $wczytajidjezdoc = $rrr['id_jez_doc'];
                        $tekstid = $polaczenie->query("SELECT jezyk_ory FROM jezyk  WHERE id='$wczytajidjezdoc'");
                        $rrrr = mysqli_fetch_assoc($tekstid);
                        $wczytajidjezdoc2 = $rrrr['jezyk_ory'];
    
                        //akcja do tlumaczenietekstow.php
                        echo"<form action='index.php?menu=15' method='post'>";
                            echo"Użytkownik wystawiający: <br> <input type='text' name='uzy' readonly='' value='".$wczytajnazwa."'/>"."<br><br>".
                            "Język oryginalny: <br> <input type='text' name='j1' readonly='' value='".$wczytajidjezory2."'/>"."<br><br>".
                            "Język docelowy: <br> <input type='text' name='j2' readonly='' value='".$wczytajidjezdoc2."'/>"."<br><br>".
                            "Temat: <br> <input type='text' name='tem' readonly='' value='".$wczytajtemat."'/>"."<br><br>".
                            "Tekst: <br> <textarea name='wiadom' cols='80' rows='20' readonly='' >".$wczytajtekst."</textarea>"."<br>"."<br>".
                            "<input type='hidden' name='idtekstu' value='".$wczytajidwiersza."'/>".
                            "<input type='submit' name='tlumacz' value='Przetłumacz'/><br><br><br>";
                        echo "</form>";
                            
                        echo "<div style='text-align: center;'><img src='img/linia.png'/></div><br><br>";
                    }
                    $polaczenie->close();
                }				
            }
        }
	catch(Exception $e)
	{
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o dodanie tekstu w innym terminie!</span>';
            //echo '<br />Informacja developerska: '.$e;
	}			
        ?>
    </body>   
</html>