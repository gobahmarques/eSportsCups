<footer>
</footer>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
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