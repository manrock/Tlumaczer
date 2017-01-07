
<?php
    //session_start();
	
    require_once "bazadanych.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
	
    //Łączenie się z bazą danych
    try 
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            //Odebranie danych z POSTA z tlumaczenietekstow.php
            $uzy_tlu = $_SESSION['user'];
            $tekstprzetlumacz = $_POST['wiadomosc2'];
            $idtekstu = $_POST['idtek'];

            $qry = $polaczenie->query("UPDATE teksty SET tlumaczenie='$tekstprzetlumacz', id_uzy_tlu='$uzy_tlu' WHERE id_teksty='$idtekstu'");
            $polaczenie -> commit();
            $polaczenie->close();
                    			
		
        }
    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o dodanie tekstu w innym terminie!</span>';
        //echo '<br />Informacja developerska: '.$e;
    }			
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Przetłumaczono</title>
        
        <meta name="description" content="Dodanie tłumaczenia wybranego tekstu przez użytkownika" />
	<meta name="keywords" content="dodawanie, dodaj, tłumaczenie, użytkoniwk, user, tekst" />
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Dodano tłumaczenie!</spam>
        <div class="linia"></div>
        
        Tłumaczenie tekstu zostało dodane! Możesz je zobaczyć w zakładce <a href="index.php?menu=6" style="color: #000000; text-decoration: underline;">"Przetłumaczone".</a>
        
    </body>   
</html>