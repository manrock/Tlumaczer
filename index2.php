<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Strona główna</title>
        
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px&amp;subset=latin-ext" rel="stylesheet">
        
        <script src="jquery-3.1.1.min.js"></script>
        <script src="jquery.scrollTo.min.js"></script>
        
        <script>
        jQuery(function($)
		{
			//zresetuj scrolla
			$.scrollTo(0);
			$('.scrollup').click(function() { $.scrollTo($('body'), 1000); });
		}
		);
		
		//pokaż podczas przewijania
		$(window).scroll(function()
		{
			if($(this).scrollTop()>10) $('.scrollup').fadeIn();
			else $('.scrollup').fadeOut();		
		}
		);
	</script>
    </head>
    
    <body>
        <div class="topp">
            <div id="log">
                <?php 
                    session_start();
                    if (!isset($_SESSION['zalogowany']))
                    {
                        echo"<a href='index.php?menu=2' class='menulink'>Zaloguj się</a>  |  <a href='index.php?menu=9' class='menulink'>Załóż konto</a>";
                        exit();
                    } else
                    {
                        echo "Zalogowano! Witaj ".$_SESSION['user']." |<a href='logout.php' class='menulink'> <b> Wyloguj!</b></a>";
                    }
                ?>
        
            </div>
        </div>
        
        <div id="box">
            <a href="#" class="scrollup"></a>
            
            <div id="logo"><a href="index2.php"><img src="img/tlo.png"/></a></div>
            
            <div id="menu">
                <a href="index2.php?menu=1" class="menulink">
                    <div class="opcje">Strona główna</div>
                </a>
                <a href="index2.php?menu=2" class="menulink">
                    <div class="opcje">Logowanie</div>
                </a>  
                <a href="index2.php?menu=3" class="menulink">
                    <div class="opcje">Kontakt</div>
                </a>
                <a href="index2.php?menu=4" class="menulink">
                    <div class="opcje">Dodaj</div>
                </a>
                <a href="index2.php?menu=5" class="menulink">
                    <div class="opcje">Tłumacz</div>
                </a>
                <a href="index2.php?menu=6" class="menulink">
                    <div class="opcje2">Przetłumaczone</div> 
                </a>    
            </div>

            <div id="news">                
                <?php
               if(isset($_GET['menu'])){
                   switch($_GET['menu']){
                       case 1: include('home.php'); break;
                       case 2: include('zalogowany.php'); break;
                       case 3: include('kontaktmenu.php'); break;
                       case 4: include('dodajmenu.php'); break;
                       case 5: include('tlumaczmenu.php'); break;
                       case 6: include('przetlumaczonemenu.php'); break;
                       case 7: include('zalogowany.php'); break;
                       case 8: include('logowaniemenu2.php'); break;
                       case 9: include('rejestracja.php'); break;
                       case 10: include('witamy.php'); break;
                       case 11: include('regulamin.php'); break;
                       case 12: include('wiadomoscwyslana.php'); break;
                       default: include('home.php'); break;
                 }
              } 
              else 
              {
                  include('home.php');
              }
                ?>  
            </div>

            <div id="media">
                <div id="mediaL"></div>
                <div id="mediaR">
                    <div class="fb">
                        <a href="http://facebook.com" target="_blank" class="medialink"><i class="icon-facebook"></i></a>
                    </div>
                    <div class="yt">
                        <a href="http://youtube.com" target="_blank" class="medialink"><i class="icon-youtube"></i></a>
                    </div>
                    <div class="gplus">
                        <a href="http://plus.google.com" target="_blank" class="medialink"><i class="icon-gplus"></i></a>
                    </div>
                    <div class="tw">
                        <a href="http://twitter.com" target="_blank" class="medialink"><i class="icon-twitter"></i></a>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>

            <div id="stopka">Copyright &copy; by Przemysław Mackiewicz 2016-2017. Wszystkie prawa zastrzeżone.</div>
        </div>
        
        <script>
	$(document).ready(function() {
	var NavY = $('.topp').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('.topp').addClass('sticky');
	} else {
		$('.topp').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
        </script>    
    </body>
</html>
