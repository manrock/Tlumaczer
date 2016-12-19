<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <title>Kontakt</title>
        
        <link rel="stylesheet" href="stylekontakt.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
    </head>
    
    <body>
        <spam class="naglowki">Kontakt</spam>
        <div class="linia"></div>
            
        <input type="text" style="display:none;">
        <input type="text" placeholder="nick" onfocus="this.placeholder=''" onblur="this.placeholder='nick'" autocomplete="off"/>
        </br></br>
        
        <input type="text" placeholder="e-mail" onfocus="this.placeholder=''" onblur="this.placeholder='e-mail'" autocomplete="off"/>
        </br></br>
        
        <input type="text" placeholder="temat" onfocus="this.placeholder=''" onblur="this.placeholder='temat'" autocomplete="off"/>
        </br></br>
        
        <textarea name="trescwiadomosci" placeholder="wiadomość" onfocus="this.placeholder=''" onblur="this.placeholder='wiadomość'" autocomplete="off" cols="60" rows="10" ></textarea>
        </br></br>
        
        <input type="submit" name="wyslij" value="Wyślij wiadomość"/> 
        
        <input type="reset" value="Wyczyść"/>

</form>
    </body>
    
</html>



