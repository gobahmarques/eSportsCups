<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
<footer>
    <div class="container">
        <div class="row">
            <img src="<?php echo $img; ?>logo.png"  class="logo"/>
            <div class="col text-right">
                <a href="https://discord.gg/RTnrWab" target="_blank">
                    <i class="fab fa-discord" style="font-size:26px"></i>
                </a>
                <a href="https://www.facebook.com/escups/" target="_blank">
                    <i class="fab fa-facebook-f" style="font-size:26px"></i>
                </a>
                <a href="https://twitter.com/cups_e" target="_blank">
                    <i class="fab fa-twitter" style="font-size:26px"></i>
                </a>
                <a href="https://www.twitch.tv/esportscups" target="_blank">
                    <i class="fab fa-twitch" style="font-size:26px"></i>
                </a>
                <a href="https://www.youtube.com/channel/UCmOVIphlEpXqg6L4Sa9EW_g" target="_blank">
                    <i class="fab fa-youtube" style="font-size:26px"></i>
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
    function abrirPartidasPendentes(){
        var hPartidasPendentes = $(".partidasPendentesUsuario").height() + 25;
        $(".partidasPendentesUsuario").css("top", "0px");
        $(".partidasPendentesUsuario").css("margin-bottom", "-"+hPartidasPendentes+"px");    
    }
    $(function(){ 
        var hPartidasPendentes = $(".partidasPendentesUsuario").height() + 25;
        $(".partidasPendentesUsuario").css("top", "-"+hPartidasPendentes+"px");
        $(".partidasPendentesUsuario").css("margin-bottom", "-"+hPartidasPendentes+"px");
    });
</script>