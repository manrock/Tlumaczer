<?php
    //session_start();
	
    require_once "bazadanych.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
		
    try 
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            //Usunięcie wiersza o podanym id tekstu nie przetłumaczonego
             $idtekstu = $_POST['idtek2'];
             $qry2 = $polaczenie->query("DELETE FROM teksty WHERE id_teksty = '$idtekstu'");
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
        
        <meta name="description" content="Usuń wybrany tekst. Opcja dostępna tylko dla administratora" />
	<meta name="keywords" content="Usuwanie, usuń, tekst" />
        
        <title>Usunięto tekst</title>
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" /> 
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Usunięto!</spam>
        <div class="linia"></div>
        
        Wybrany tekst został usunięty!
        
    </body>   
</html>

