<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<footer>
    <div class="container">
        <div class="row">
            <img src="<?php echo $img; ?>logo.png"  class="logo"/>
            <div class="col text-right">
                <a href="https://twitter.com/cups_e" target="_blank">
                    <i class="fa fa-facebook-f" style="font-size:26px"></i>
                </a>
                <a href="https://twitter.com/cups_e" target="_blank">
                    <i class="fa fa-twitter" style="font-size:26px"></i>
                </a>
                <a href="https://twitter.com/cups_e" target="_blank">
                    <i class="fa fa-twitch" style="font-size:26px"></i>
                </a>
                <a href="https://twitter.com/cups_e" target="_blank">
                    <i class="fa fa-youtube-play" style="font-size:26px"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-64433449-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-64433449-2');
</script>

<script src="<?php echo $js; ?>jquery.js"></script>
<script src="<?php echo $js; ?>bootstrap.js"></script>
<script src="<?php echo $js; ?>jquery.countdown.js" type="text/javascript"></script>
<script src="<?php echo $js; ?>jquery.carouFredSel.js" type="text/javascript"></script>
<script src="<?php echo $js; ?>jquery.mask.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $css; ?>jquery.countdown.css"> 
<script type="text/javascript" src="<?php echo $js; ?>jquery.plugin.js"></script> 
<script type="text/javascript" src="<?php echo $js; ?>jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo $js; ?>jquery.countdown-pt-BR.js"></script>


<script>
    function openNav() {
        document.getElementById("sideBarJogos").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("sideBarJogos").style.width = "0";
    }
    $(function(){ 
        /*
        var nav = $('#menuHeader');   
        $(window).scroll(function () { 
            if ($(this).scrollTop() > 150) { 
                nav.addClass("menu-fixo"); 
            } else { 
                nav.removeClass("menu-fixo"); 
            } 
        });  
        */
    });
</script>