<?php
    include "../../enderecos.php";
    include "../../session.php";
?>
<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.css">
    <link rel="stylesheet" href="<?php echo $css; ?>esportscups.css">

    <title>Artigos eSC | e-Sports Cups</title>
  </head>
  <body>
    <?php include "../header.php"; ?>
      
    <div id="sideBarJogos" class="sidenav">
        <li>Filtros de Busca</li>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <li onClick="trocarAba(0);"><img src="img/logo.png" height="20px"> e-Sports Cups</li>
        <li onClick="trocarAba(357);"><img src="img/icones/dota2.png" height="20px"> Dota 2</li>
        <li onClick="trocarAba(123);"><img src="img/icones/gwent.png" height="20px" > GWENT</li>
        <li onClick="trocarAba(369);"><img src="img/icones/hs.png" height="20px" > Hearthstone</li>
        <li onClick="trocarAba(147);"><img src="img/icones/lol.png" height="20px" > League of Legends</li>
        <li onClick="trocarAba(258);"><img src="img/icones/overwatch2.png" height="20px" > Overwatch</li>
    </div>
    <div onclick="openNav();" class="botaoMenuJogos">open</div>
      
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="row artigos">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <h2 class="tituloLateral">Nosso <strong>Facebook</strong></h2>
                <div class="detalheTituloLateral"></div>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fescups&tabs&width=500&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                <h2 class="tituloLateral">Fique por <strong>Dentro</strong></h2>
                <div class="detalheTituloLateral"></div>
                <div class="newsletter">
                    <div class="quadroum">
                        Seja sempre o primeiro a saber
                    </div>	
                    Assine nosso <strong>Newsletter</strong> e fique por dentro <br>
                    de tudo que acontece na plataforma!
                    <form action="https://esportscups.us16.list-manage.com/subscribe/post?u=a834600c251090e6177674a3b&amp;id=a145cc8cad" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="seu@email.com.br" required>
                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a834600c251090e6177674a3b_a145cc8cad" tabindex="-1" value=""></div>
                        <div class="clear"><input type="submit" value="CADASTRE-SE" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                        </div>
                    </form>

                    <!--End mc_embed_signup-->
                </div>
            </div>
        </div>           
    </div>

    <?php include "../footer.php"; ?>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo $js; ?>jquery.js"></script>
    <script src="<?php echo $js; ?>bootstrap.js"></script>
    <script>
		function trocarAba(aba){
			$(".active").removeClass("active");
			switch(aba){
				case 0:
					$(".esc").addClass("active");
                    $(".botaoMenuJogos").html("Filtro<br><img src='img/logo.png' height='20px'>");
					break;
				case 357: // DOTA 2
					$(".dota").addClass("active");
                    $(".botaoMenuJogos").html("Filtro<br><img src='img/icones/dota2.png' height='20px'>");
					break;
				case 369: // HEARTHSTONE
					$(".hs").addClass("active");
                    $(".botaoMenuJogos").html("Filtro<br><img src='img/icones/hs.png' height='20px'>");
					break;
				case 147: // LEAGUE OF LEGENDS
					$(".lol").addClass("active");
                    $(".botaoMenuJogos").html("Filtro<br><img src='img/icones/lol.png' height='20px'>");
					break;
				case 258: // OVERWATCH
					$(".ow").addClass("active");
                    $(".botaoMenuJogos").html("Filtro<br><img src='img/icones/overwatch.png' height='20px'>");
					break;
				case 123: // GWENT
					$(".gwent").addClass("active");
                    $(".botaoMenuJogos").html("Filtro<br><img src='img/icones/gwent.png' height='20px'>");
					break;
			}
			$.ajax({
				type: "POST",
				url: "scripts/carregar-artigos.php",
				data: "aba="+aba,
				success: function(resultado){
					$(".artigos").html(resultado);
					return false;
				}
			});	
            closeNav();
		}
		jQuery(function($){
			trocarAba(369);
		});
	</script>
  </body>
</html>