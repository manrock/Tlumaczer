<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Przetłumaczone teksty</title>
        
        <meta name="description" content="Tu znajdują się przetłumaczone teksty przez społeczność" />
	<meta name="keywords" content="teksty, tłumaczenie, społeczność, gotowe" />
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Przetłumaczone</spam>
        <div class="linia"></div>

        <?php
            //session_start();

            require_once "bazadanych.php";
            mysqli_report(MYSQLI_REPORT_STRICT);

            //Łączenie z bazą danych
            try 
            {
                $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                if ($polaczenie->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else
                {
                    //wybieramy dane potrzebne do wyświetlenia tekstów przetłumaczonych
                    $wczytajtekst;
                    $tekstprzetłumaczony = $polaczenie->query("SELECT id_teksty, id_uzy_tlu, temat, tekst, id_jez_ory, nazwa, id_jez_doc, tlumaczenie FROM teksty, uzytkownicy WHERE teksty.id_uzy = uzytkownicy.id AND tlumaczenie <> ''");
                    if(mysqli_num_rows($tekstprzetłumaczony) > 0)
                    {
                        while($rrr = mysqli_fetch_assoc($tekstprzetłumaczony))
                        {
                            $wczytajtemat = $rrr['temat'];
                            $wczytajtekst = $rrr['tekst'];
                            $wczytajnazwa = $rrr['nazwa'];
                            $wczytajtlumaczenie = $rrr['tlumaczenie'];
                            $wczytajtlumacza = $rrr['id_uzy_tlu'];
                            $wczytajidwiersza = $rrr['id_teksty'];

                            $wczytajjezykory = $rrr['id_jez_ory'];
                            $tekstid2 = $polaczenie->query("SELECT jezyk_ory FROM jezyk  WHERE id='$wczytajjezykory'");
                            $rrrrr = mysqli_fetch_assoc($tekstid2);
                            $wczytajidjezory2 = $rrrrr['jezyk_ory'];

                            $wczytajidjezdoc = $rrr['id_jez_doc'];
                            $tekstid = $polaczenie->query("SELECT jezyk_ory FROM jezyk  WHERE id='$wczytajidjezdoc'");
                            $rrrr = mysqli_fetch_assoc($tekstid);
                            $wczytajidjezdoc2 = $rrrr['jezyk_ory'];

                            echo"Użytkownik wystawiający: <br> <input type='text' name='user' readonly='' value='".$wczytajnazwa."'/>"."<br><br>".
                            "Przetłumaczył: <br> <input type='text' name='user2' readonly='' value='".$wczytajtlumacza."'/>"."<br><br>".
                            "Język oryginalny: <br> <input type='text' name='jezykory' readonly='' value='".$wczytajidjezory2."'/>"."<br><br>".
                            "Język docelowy: <br> <input type='text' name='jezykdoc' readonly='' value='".$wczytajidjezdoc2."'/>"."<br><br>".
                            "Temat: <br> <input type='text' name='temat' readonly='' value='".$wczytajtemat."'/>"."<br><br>".
                            "Tekst: <br> <textarea name='wiadomosc' cols='80' rows='20' readonly='' >".$wczytajtekst."</textarea>"."<br><br>".
                            "<input type='hidden' name='idtekstu2' value='".$wczytajidwiersza."'/>".
                            "Tekst przetłumaczony: <br> <textarea name='wiadomosc2' cols='80' rows='20' readonly='' >".$wczytajtlumaczenie."</textarea>"."<br>"."<br>";

                            //Jeżeli zalogowany jest admin to pokaż guzik do usuwania
                            if ($_SESSION['user'] == 'admin')
                            {
                                echo"<form action='index.php?menu=19' method='post'>";
                                    echo "<input type='submit' name='usuntlumaczenie' value='Usuń'/><br><br><br>".
                                    "<input type='hidden' name='idtekstu2' value='".$wczytajidwiersza."'/>";
                                echo "</form>";
                            }
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

