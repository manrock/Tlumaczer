<?php
    session_start();

    //Jeżeli nie odebrano loginu i hasła idź do
    if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {
        header('Location: logowaniemenu.php');
        exit();
    }

	require_once "bazadanych.php";
    try
    {
        //Otwieramy baze danych
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
            echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
            $login = $_POST['login'];
            $haslo = $_POST['haslo'];
		
            //znaki specjalne jak np, <> są konwertowane do html
            $login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
            //sprawdzenie loginu
            if ($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM uzytkownicy WHERE nazwa='%s'",
            mysqli_real_escape_string($polaczenie,$login))))
            {
                $ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{
                    $wiersz = $rezultat->fetch_assoc();
                    //Czy wprowadzone hasło zgadza się
                    if (password_verify($haslo, $wiersz['haslo']))
                    {
                        $_SESSION['zalogowany'] = true;
			$_SESSION['id'] = $wiersz['id'];
                        $_SESSION['user'] = $wiersz['nazwa'];
				
			unset($_SESSION['blad']);
			$rezultat->free_result();
			header('Location: index.php?menu=7');
                     }
                    else 
                    {
                        $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                        header('Location: index.php?menu=2');
                    }				
		} 
                else 
                {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php?menu=2');				
		}			
            }
            else
            {
                throw new Exception($polaczenie->error);
            }
            $polaczenie->close();
	}
    }
    catch(Exception $e)
    {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o wizytę w innym terminie!</span>';
        //echo '<br />Informacja developerska: '.$e;
    }	
?>