<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Strona główna</title>
        <script src="jquery-3.1.1.min.js"></script>  
       
        <link rel="stylesheet" href="stylelog.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Logowanie</spam>
        <div class="linia"></div>
        
        <input type="text" style="display:none;">
        
        <input type="text" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" autocomplete="off"/>
        </br></br>

        <input type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" autocomplete="off" />
        </br></br>
        
        <input type="submit" value="Zaloguj"/>
    </body>
    
</html>


