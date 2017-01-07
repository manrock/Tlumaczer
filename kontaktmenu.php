<?php
    //session_start();
	
    if (isset($_POST['nick']))
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
		
	//Sprawdź poprawność tematu
	$temat = $_POST['temat'];
		
	if ((strlen($temat)<5) || (strlen($temat)>30))
	{
            $wszystko_OK=false;
            $_SESSION['e_temat']="Temat musi posiadać od 5 do 30 znaków!";
	}
                
        //Sprawdź poprawność wiadomosci
	$wiadomosc = $_POST['wiadomosc'];
		
	if ((strlen($wiadomosc)<10) || (strlen($wiadomosc)>1000))
	{
            $wszystko_OK=false;
            $_SESSION['e_wiadomosc']="Wiadomość musi posiadać od 10 do 1000 znaków!";
	}
		
        //Zapamiętaj wprowadzone dane
        $_SESSION['fr_nick'] = $nick;
	$_SESSION['fr_email'] = $email;
	$_SESSION['fr_temat'] = $temat;
	$_SESSION['fr_wiadomosc'] = $wiadomosc;
	
        //jeżeli wszystko dobrze wypełnione
	if ($wszystko_OK==true)
        {
            $do = 'prze.m.alcatras@gmail.com'; //mój email
            
            //w $header tworzymy nagłówek e-mail (dane o kodowaniu, gdzie ma być e-mail wysłany itp.
            $header = "From: $email \nContent-Type:".
                            ' text/plain;charset="UTF-8"'.
                            "\nContent-Transfer-Encoding: 8bit";
            if (mail($do, $temat, $wiadomosc, $header))
                {
                    $_SESSION['wiadomoscwyslana']=true;
                    header('Location: index.php?menu=12');
                }
            else
            {
                $_SESSION['e_bladw']="Wystąpił błąd podczas wysyłania wiadomości! Sprobój ponownie za kilka chwil.";
            }
        }	
    }	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Kontakt</title>
        
        <meta name="description" content="Wyślij wiadomość do administratora. Kontakt z administracją" />
	<meta name="keywords" content="administracja, administrator, admin, kontakt, wiadomość, e-mail, temat" />
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" />
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
        <spam class="naglowki">Kontakt</spam>
        <div class="linia"></div>
        
        <?php
            if (isset($_SESSION['e_bladw']))
            {
                echo '<div class="error">'.$_SESSION['e_bladw'].'</div>';
                unset($_SESSION['e_bladw']);
            }
        ?>
        
        <input type="text" style="display:none;">
        
        <form method="post">
            <input type="text" value="<?php
                if (isset($_SESSION['fr_nick']))
		{
                    echo $_SESSION['fr_nick'];
                    unset($_SESSION['fr_nick']);
		}
		?>" name="nick" placeholder="nick" onfocus="this.placeholder=''" onblur="this.placeholder='nick'" autocomplete="off"/>
            <?php
                if (isset($_SESSION['e_nick']))
                {
                    echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
                    unset($_SESSION['e_nick']);
		}
            ?>
            </br></br>
        
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
        
            <input type="text" value="<?php
                if (isset($_SESSION['fr_temat']))
                {
                    echo $_SESSION['fr_temat'];
                    unset($_SESSION['fr_temat']);
                }
		?>" name="temat" placeholder="temat" onfocus="this.placeholder=''" onblur="this.placeholder='temat'" autocomplete="off"/>
            <?php
		if (isset($_SESSION['e_temat']))
		{
                    echo '<div class="error">'.$_SESSION['e_temat'].'</div>';
                    unset($_SESSION['e_temat']);
		}
            ?>
            </br></br>
        
            <textarea name="wiadomosc" placeholder="wiadomość" onfocus="this.placeholder=''" onblur="this.placeholder='wiadomość'" autocomplete="off" cols="60" rows="10" ><?php
                if (isset($_SESSION['fr_wiadomosc']))
		{
                    echo $_SESSION['fr_wiadomosc'];
                    unset($_SESSION['fr_wiadomosc']);
		}
		?></textarea>
            <?php
		if (isset($_SESSION['e_wiadomosc']))
		{
                    echo '<div class="error">'.$_SESSION['e_wiadomosc'].'</div>';
                    unset($_SESSION['e_wiadomosc']);
		}
            ?>
            </br></br>
        
            <input type="submit" name="wyslij" value="Wyślij wiadomość"/> 
        
            <input type="reset" value="Wyczyść"/>
        </form>
    </body> 
</html>



