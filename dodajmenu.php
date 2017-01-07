<?php
    //session_start();

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php?menu=14');
        exit();
    }	

    if (isset($_POST['temat']))
    {
        //Udana walidacja? Załóżmy, że tak! Ustawienie flagi
        $wszystko_OK=true;
		
        $jezyk1 = $_POST['jezyk_ory'];
        $jezyk2 = $_POST['jezyk_doc'];
        $tresc = $_POST['tresc'];
        $temat = $_POST['temat'];
		
        //Sprawdzenie długości treści
        if ((strlen($tresc)<10) || (strlen($tresc)>5000))
        {
            $wszystko_OK=false;
            $_SESSION['e_tresc']="Treść tekstu musi zawierać więcej niż 10 znaków oraz mniej niż 5000!";
        }
	
        //Sprawdzenie długości tematu
        if ((strlen($temat)<5) || (strlen($temat)>20))
        {
            $wszystko_OK=false;
            $_SESSION['e_temat']="Temat musi zawierać od 5 do 20 znaków!";
        }
		
        //Zapamiętaj wprowadzone dane
        $_SESSION['fr_tresc'] = $tresc;
        $_SESSION['fr_temat'] = $temat;
                	
        require_once "bazadanych.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
	
        // Polączenie z bazą danych
        try 
        {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                //Wyciągnięcie id języka oryginalnego tekstu
                $idjezykaory;
                $jezyk_oryginalny = $polaczenie->query("SELECT * FROM jezyk WHERE jezyk_ory='$jezyk1'");
                        
                if(mysqli_num_rows($jezyk_oryginalny) > 0)
                {
                    $r = mysqli_fetch_assoc($jezyk_oryginalny);
                    $idjezykaory = $r['id'];   
                }
                
                //Wyciągnięcie id języka docelowego tekstu
                $idjezykadoc;
                $jezyk_docelowy = $polaczenie->query("SELECT * FROM jezyk WHERE jezyk_ory='$jezyk2'");
                        
                if(mysqli_num_rows($jezyk_docelowy) > 0)
                {
                    $rr = mysqli_fetch_assoc($jezyk_docelowy);
                    $idjezykadoc = $rr['id'];  
                }
                        
                //Czy tekst już istnieje?
                $rezultat = $polaczenie->query("SELECT id_teksty FROM teksty WHERE tekst='$tresc'");
				
                if (!$rezultat) throw new Exception($polaczenie->error);
				
                $ile_takich_tekstow = $rezultat->num_rows;
                if($ile_takich_tekstow>0)
                {
                    $wszystko_OK=false;
                    $_SESSION['e_tresc']="Istnieje już taki tekst!";
                }		
                
                //id użytkownika zalogowanego
                $uzytkownik = $_SESSION['id'];
                
                //jeżeli wszystko dobrze wypełnione
                if ($wszystko_OK==true)
                {
                    $zmienna = "INSERT INTO teksty (id_teksty, id_jez_doc, id_jez_ory, id_uzy, temat, tekst) VALUES (NULL, '$idjezykadoc', '$idjezykaory', '$uzytkownik',  '$temat', '$tresc')";
                    					
                    if ($polaczenie->query($zmienna))
                    {
                        $_SESSION['udanewyslanietekstu']=true;
                        header('Location: index.php?menu=13');
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
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o dodanie tekstu w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
        }	
    }	
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Dodawanie tekstu</title>
        
        <meta name="description" content="Dodawanie swojego własnego tekstu do tłumaczenia" />
	<meta name="keywords" content="dodaj, tekst, języki, autor" />
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="stylelog.css" type="text/css" />  
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
        <spam class="naglowki">Dodaj tekst do tłumaczenia</spam>
        <div class="linia"></div>
        
        <?php if(isset($_POST['jezyk_ory'])) $selected = true; ?>
        <?php if(isset($_POST['jezyk_doc'])) $selected = true; ?>
        
        <input type="text" style="display:none;">

        <form method="post">
            
            Język oryginalny tekstu</br>
            <select name="jezyk_ory">
            <option value="Polski" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Polski') echo 'selected="selected"'?>>Polski</option>
            <option value="Angielski" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Angielski') echo 'selected="selected"'?>>Angielski</option>
            <option value="Niemiecki" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Niemiecki') echo 'selected="selected"'?>>Niemiecki</option>
            <option value="Francuski" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Francuski') echo 'selected="selected"'?>>Francuski</option>
            <option value="Hiszpanski" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Hiszpanski') echo 'selected="selected"'?>>Hiszpański</option>
            <option value="Wloski" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Wloski') echo 'selected="selected"'?>>Włoski</option>
            <option value="Rosyjski" <?php if(isset($selected) && $selected && $_POST['jezyk_ory']=='Rosyjski') echo 'selected="selected"'?>>Rosyjski</option>         
            </select>
            </br><br>
                       
            Język docelowy tekstu</br>
            <select name="jezyk_doc">
            <option value="Polski" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Polski') echo 'selected="selected"'?>>Polski</option>
            <option value="Angielski" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Angielski') echo 'selected="selected"'?>>Angielski</option>
            <option value="Niemiecki" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Niemiecki') echo 'selected="selected"'?>>Niemiecki</option>
            <option value="Francuski" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Francuski') echo 'selected="selected"'?>>Francuski</option>
            <option value="Hiszpanski" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Hiszpanski') echo 'selected="selected"'?>>Hiszpański</option>
            <option value="Wloski" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Wloski') echo 'selected="selected"'?>>Włoski</option>
            <option value="Rosyjski" <?php if(isset($selected) && $selected && $_POST['jezyk_doc']=='Rosyjski') echo 'selected="selected"'?>>Rosyjski</option>         
            </select>
            </br><br>
            
            Tematyka tekstu</br>
            <input type="text" value="<?php
                if (isset($_SESSION['fr_temat']))
		{
                    echo $_SESSION['fr_temat'];
                    unset($_SESSION['fr_temat']);
		}
            ?>" name="temat" placeholder="temat" onfocus="this.placeholder=''" onblur="this.placeholder='język temat'" autocomplete="off"/>
            <?php
                if (isset($_SESSION['e_temat']))
                {
                    echo '<div class="error">'.$_SESSION['e_temat'].'</div>';
                    unset($_SESSION['e_temat']);
		}
            ?>
            </br></br>
            
            Tekst do tłumaczenia</br>
            <textarea name="tresc" placeholder="treść" onfocus="this.placeholder=''" onblur="this.placeholder='treść'" autocomplete="off" cols="80" rows="20" ><?php
                if (isset($_SESSION['fr_tresc']))
		{
                    echo $_SESSION['fr_tresc'];
                    unset($_SESSION['fr_tresc']);
		}
                ?></textarea>
            <?php
                if (isset($_SESSION['e_tresc']))
                {
                    echo '<div class="error">'.$_SESSION['e_tresc'].'</div>';
                    unset($_SESSION['e_tresc']);
		}
            ?>
            </br></br>
            
            <input type="submit" name="wyslij" value="Dodaj tekst"/>
        </form>
    </body>
    
</html>