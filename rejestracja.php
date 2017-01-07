<?php
    //session_start();
	
    if (isset($_POST['email']))
    {
        //Udana walidacja? Załóżmy, że tak! Ustawienie flagi
	$wszystko_OK=true;
		
	//Sprawdź poprawność nickname'a
	$nick = $_POST['nick'];
		
	//Sprawdzenie długości nicka
	if ((strlen($nick)<3) || (strlen($nick)>20))
	{
            $wszystko_OK=false;
            $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
	}
	
        //Sprawdzenie czy nick składa się tylko z liter i cyfr
	if (ctype_alnum($nick)==false)
	{
            $wszystko_OK=false;
            $_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
	}
		
        // Sprawdź poprawność adresu email
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
	if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
	{
            $wszystko_OK=false;
            $_SESSION['e_email']="Podaj poprawny adres e-mail!";
	}
		
	//Sprawdź poprawność hasła
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
		
	if ((strlen($haslo1)<5) || (strlen($haslo1)>20))
	{
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Hasło musi posiadać od 5 do 20 znaków!";
	}
	
        //Czy podane hasła są identyczne
	if ($haslo1!=$haslo2)
	{
            $wszystko_OK=false;
            $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
        }	
        
        //kodowanie hasła
        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
	//Czy zaakceptowano regulamin?
	if (!isset($_POST['regulamin']))
	{
            $wszystko_OK=false;
            $_SESSION['e_regulamin']="Potwierdź akceptację regulaminu!";
	}				
		
	//Bot or not? Oto jest pytanie!
	$sekret = "6LfBnw8UAAAAAMTYefJfGXKDKBIaAhEElYCoivfs";		
	$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);		
	$odpowiedz = json_decode($sprawdz);
		
	if ($odpowiedz->success==false)
	{
            $wszystko_OK=false;
            $_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
	}
                
        //Sprawdzenie kraju
        $kraj = $_POST['kraj'];
                
        if ((strlen($kraj)<4) || (strlen($kraj)>32))
	{
            $wszystko_OK=false;
            $_SESSION['e_kraj']="Nie poprawna nazwa państwa!";
	}
		
	if (!preg_match ("/^[a-zA-Z\s]+$/",$kraj))
	{
            $wszystko_OK=false;
            $_SESSION['e_kraj']="Nazwa kraju może składać się tylko z liter";
	}
                
        //Sprawdzenie plci
        $plec = $_POST['plec'];
                
        //Sprawdzenie daty urodzenia
        $dataur = date('Y-m-d',strtotime($_POST['dataur']));

        if(!isset($dataur)) 
        {
            $wszystko_OK=false;
            $_SESSION['e_dataur']="Wpisz poprawną datę urodzenia!";
        }
                
	//Zapamiętaj wprowadzone dane
	$_SESSION['fr_nick'] = $nick;
	$_SESSION['fr_email'] = $email;
	$_SESSION['fr_haslo1'] = $haslo1;
	$_SESSION['fr_haslo2'] = $haslo2;
        $_SESSION['fr_kraj'] = $kraj;
        $_SESSION['fr_dataur'] = $dataur;
	if (isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;
		
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
                //Czy email już istnieje?
		$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
		if (!$rezultat) throw new Exception($polaczenie->error);
				
		$ile_takich_maili = $rezultat->num_rows;
		if($ile_takich_maili>0)
		{
                    $wszystko_OK=false;
                    $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
		}		

		//Czy nick jest już zarezerwowany?
		$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE nazwa='$nick'");
				
		if (!$rezultat) throw new Exception($polaczenie->error);
				
		$ile_takich_nickow = $rezultat->num_rows;
		if($ile_takich_nickow>0)
		{
                    $wszystko_OK=false;
                    $_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
		}
				
		if ($wszystko_OK==true)
		{
                    //Hurra, wszystkie testy zaliczone					
                    if ($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email', '$kraj', '$plec', '$dataur')"))
                    {
                        $_SESSION['udanarejestracja']=true;
			header('Location: index.php?menu=10');
                    }
                    else
                    {
                        throw new Exception($polaczenie->error);
                    }					
		}				
		$polaczenie->close();
            }			
        }
	catch(Exception $e)
	{
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            //echo '<br />Informacja developerska: '.$e;
	}		
    }		
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Rejestracja</title>
        
        <meta name="description" content="Zakładanie konta w serwisie po wypełnieniu formularza" />
	<meta name="keywords" content="konto, rejestracja, użytkownik, login, hasło, kraj pochodzenia, płec, data urodzenia, bot, regulamin, formularz" />
        
        <script src="jquery-3.1.1.min.js"></script> 
        <script src='https://www.google.com/recaptcha/api.js'></script>
       
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylelog.css" type="text/css" />       
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
        <style>
		.error
		{
			color:red;
			margin-top: 10px;
		}
	</style>
    </head>
    
    <body>
        <spam class="naglowki">Rejestracja</spam>
        <div class="linia"></div>
        
        <?php if(isset($_POST['plec'])) $selected = true; ?>
        
        <form method="post">
            <input type="text" style="display:none;">
            
            Nazwa użytkownika</br>
            <input type="text" value="<?php
                if (isset($_SESSION['fr_nick']))
		{
                    echo $_SESSION['fr_nick'];
                    unset($_SESSION['fr_nick']);
		}
		?>" name="nick" placeholder="nickname" onfocus="this.placeholder=''" onblur="this.placeholder='nickname'" autocomplete="off"/>
            <?php
                if (isset($_SESSION['e_nick']))
		{
                    echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
		}
            ?>
            </br></br>
            
            Hasło</br>
            <input type="password" value="<?php
                if (isset($_SESSION['fr_haslo1']))
		{
                    echo $_SESSION['fr_haslo1'];
                    unset($_SESSION['fr_haslo1']);
		}
		?>" name="haslo1" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" autocomplete="off"/>
            <?php
                if (isset($_SESSION['e_haslo']))
		{
                    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
                    unset($_SESSION['e_haslo']);
		}
            ?>	
            </br></br>
            
            Powtórz hasło</br>
            <input type="password" value="<?php
                if (isset($_SESSION['fr_haslo2']))
		{
                    echo $_SESSION['fr_haslo2'];
                    unset($_SESSION['fr_haslo2']);
		}
		?>" name="haslo2" placeholder="powtórz hasło" onfocus="this.placeholder=''" onblur="this.placeholder='powtorz hasło'" autocomplete="off"/>
            </br></br>
            
            E-mail</br>
            <input type="text" value="<?php
                if (isset($_SESSION['fr_email']))
		{
                    echo $_SESSION['fr_email'];
                    unset($_SESSION['fr_email']);
		}
		?>" name="email" placeholder="e-mail" onfocus="this.placeholder=''" onblur="this.placeholder='e-mail'" autocomplete="off"/>
            <?php
                if (isset($_SESSION['e_email']))
                {
                    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
                    unset($_SESSION['e_email']);
		}
            ?>
            </br></br>
            
            Kraj pochodzenia</br>
            <input type="text" value="<?php
                if (isset($_SESSION['fr_kraj']))
		{
                    echo $_SESSION['fr_kraj'];
                    unset($_SESSION['fr_kraj']);
		}
		?>" name="kraj" placeholder="kraj" onfocus="this.placeholder=''" onblur="this.placeholder='kraj'" autocomplete="off"/>
            <?php
                if (isset($_SESSION['e_kraj']))
		{
                    echo '<div class="error">'.$_SESSION['e_kraj'].'</div>';
                    unset($_SESSION['e_kraj']);
		}
            ?>
            </br></br>
            
            Płeć</br>            
            <select name="plec">
            <option value="mezczyzna" <?php if(isset($selected) && $selected && $_POST['plec']=='mezczyzna') echo 'selected="selected"'?>>Mężczyzna</option>
            <option value="kobieta" <?php if(isset($selected) && $selected && $_POST['plec']=='kobieta') echo 'selected="selected"'?>>Kobieta</option>
            </select>
            </br><br>
            
            <input type="date" value="<?php
                if (isset($_SESSION['fr_dataur']))
		{
                    echo $_SESSION['fr_dataur'];
                    unset($_SESSION['fr_dataur']);
		}
                ?>" name="dataur" min="1900-01-01" max="2002-12-31" required="wypełnij"/>
            <?php
                if (isset($_SESSION['e_dataur']))
		{
                    echo '<div class="error">'.$_SESSION['e_dataur'].'</div>';
                    unset($_SESSION['e_dataur']);
		}
            ?>            
            </br></br>
            
            <label>
                <input type="checkbox" name="regulamin" <?php
		if (isset($_SESSION['fr_regulamin']))
                    {
                        echo "checked";
                        unset($_SESSION['fr_regulamin']);
                    }
                ?>/>Akceptuję <a href="index.php?menu=11" target="_blank" style="text-decoration: underline; color: #000000;">regulamin</a>
            </label>
                <?php
                    if (isset($_SESSION['e_regulamin']))
                    {
                        echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                        unset($_SESSION['e_regulamin']);
                    }
                ?>
            </br></br>
            
            <div class="g-recaptcha" data-sitekey="6LfBnw8UAAAAAMBWmV8yKswQ-byZLFaXpr41D0jb"></div>
            <?php
                if (isset($_SESSION['e_bot']))
		{
                    echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                    unset($_SESSION['e_bot']);
		}
            ?>
            </br>
           
            <input type="submit" value="Zarejestruj"/>            
        </form>       
    </body>   
</html>




