<?php
    include "../../enderecos.php";
    include "../../session.php";

    $campeonato = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM campeonato WHERE codigo = ".$_GET['codigo'].""));
	$organizacao = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM organizacao WHERE codigo = ".$campeonato['cod_organizacao'].""));
	$jogo = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM jogos WHERE codigo = ".$campeonato['cod_jogo']." "));

	$datahora = date("Y-m-d H:i:s");

	if(isset($usuario['codigo'])){
		$pesquisaFuncao = mysqli_query($conexao, "SELECT * FROM jogador_organizacao WHERE cod_organizacao = ".$organizacao['codigo']." AND cod_jogador = ".$usuario['codigo']." ");
		$funcao = mysqli_fetch_array($pesquisaFuncao);	
	}
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

        <title>Inscrição <?php echo $campeonato['nome']; ?> | e-Sports Cups</title>
    </head>
    <body>
        <?php include "../header.php"; ?>
        <?php include "campeonato-perfil.php"; ?>
        <div class="container centralizar">
        <?php	
            switch($campeonato['cod_jogo']){
                case 369: // HEARTHSTONE
                    include "campeonato-inscricao-hearthstone.php";
                    break;
                case 123: // GWENT
                    include "campeonato-inscricao-gwent.php";
                    break;
                case 357: // DOTA 2
                    include "campeonato-inscricao-dota2.php";
                    break;
                default: // INSCRIÇÃO GERAL
                    include "campeonato-inscricao-geral.php";
                    break;
            }
        ?>
        </div>
        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo $js; ?>jquery.js"></script>
        <script src="<?php echo $js; ?>bootstrap.js"></script>
        <script>
            function validar(){
                <?php
                    if(isset($usuario['codigo'])){
                    ?>
                        var valorReal = <?php echo $campeonato['valor_real'] ?>;
                        var valorCoin = <?php echo $campeonato['valor_escoin'] ?>;
                        var saldoReal = <?php echo $usuario['saldo']; ?>;
                        var saldoCoin = <?php echo $usuario['pontos']; ?>;	
                    <?php
                    }
                ?>
                

                if(valorCoin > 0){ 
                    if(saldoCoin < valorCoin){ // NÃO POSSUI SALDO
                        alert("Saldo em e$ insuficiente.");
                        return false;
                    }else{ // POSSUI SALDO
                        var counter = $('.limitado:checked').length;
                        var limit = <?php echo $campeonato['qtd_pick']; ?>;
                        switch("<?php echo $jogo['abreviacao']; ?>"){
                            case "Hearthstone":
                                if(counter < limit){
                                    alert('É obrigatório selecionar '+limit+' heróis!');
                                    return false;
                                }else{
                                    return true;
                                }
                                break;
                            case "GWENT":
                                if(counter < limit){
                                    alert('É obrigatório selecionar '+limit+' facções!');
                                    return false;
                                }else{
                                    return true;
                                }
                                break;
                            default:
                                return true;
                        }
                    }
                }else if(valorReal > 0){
                    if(saldoReal < valorReal){ // NÃO POSSUI SALDO
                        alert("Saldo em R$ insuficiente.");
                        return false;
                    }else{ // POSSUI SALDO
                        var counter = $('.limitado:checked').length;
                        var limit = <?php echo $campeonato['qtd_pick']; ?>;
                        switch("<?php echo $jogo['abreviacao']; ?>"){
                            case "Hearthstone":
                                if(counter < limit){
                                    alert('É obrigatório selecionar '+limit+' heróis!');
                                    return false;
                                }else{
                                    return true;
                                }
                                break;
                            case "GWENT":
                                if(counter < limit){
                                    alert('É obrigatório selecionar '+limit+' facções!');
                                    return false;
                                }else{
                                    return true;
                                }
                                break;
                            default:
                                return true;
                        }		
                    }
                }else{ // INSCRIÇÃO GRATUITA
                    var counter = $('.limitado:checked').length;
                    var limit = <?php echo $campeonato['qtd_pick']; ?>;
                    switch("<?php echo $jogo['abreviacao']; ?>"){
                        case "Hearthstone":
                            if(counter < limit){
                                alert('É obrigatório selecionar '+limit+' heróis!');
                                return false;
                            }else{
                                return true;
                            }
                            break;
                        case "GWENT":
                            if(counter < limit){
                                alert('É obrigatório selecionar '+limit+' facções!');
                                return false;
                            }else{
                                return true;
                            }
                            break;
                        default:
                            return true;
                    }	
                }



            }
            function mudarDraftHs(){
                $(".draft").load("ptbr/campeonatos/draft-hearthstone.php");
                setTimeout(function(){
                    $("#funcao").val("alterar");
                    $("#codCampeonato").val(<?php echo $campeonato['codigo']; ?>);
                }, 300)
            }
            function realizarCheckin(campeonato, jogador){
                $.ajax({
                    type: "POST",
                    url: "scripts/realizar-checkin-campeonato.php",
                    data: "campeonato="+campeonato+"&jogador="+jogador,
                    success: function(resposta){
                        location.reload();
                    }
                })
            }
            function mudarDraftGwent(){
                $(".draft").load("ptbr/campeonatos/draft-gwent.php");
                setTimeout(function(){
                    $("#funcao").val("alterar");
                    $("#codCampeonato").val(<?php echo $campeonato['codigo']; ?>);
                }, 300)
            }
            $(document).on('click', '.limitado', function(){		
                var limit = <?php echo $campeonato['qtd_pick']; ?>;
                var counter = $('.limitado:checked').length;
                if(counter > limit) {
                    this.checked = false;
                    alert('Só é permito selecionar '+limit+'!');
                }
            });	
            jQuery(function($){
                $(".inscricao").addClass("ativo");
            });
        </script>
        
    </body>
</html>