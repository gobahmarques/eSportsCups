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

        <title>Partidas <?php echo $campeonato['nome']; ?> | e-Sports Cups</title>
    </head>
    <body>
        <?php include "../header.php"; ?>
        <?php include "campeonato-perfil.php"; ?>
        
        <div class="container">
            <div class="row-fluid">
            <?php
                $etapas = mysqli_query($conexao, "SELECT * FROM campeonato_etapa WHERE cod_campeonato = ".$campeonato['codigo']." ORDER BY cod_etapa");
                while($etapa = mysqli_fetch_array($etapas)){
                ?>
                    <div class="col-6 col-md-3 centralizar thumbEtapa float-left">
                        <div class="row-fluid">
                            <a href="ptbr/campeonato/<?php echo $campeonato['codigo']; ?>/etapa/<?php echo $etapa['cod_etapa']; ?>/">
                                <div class="col-12 col-md-12">
                                <?php
                                    switch($etapa['tipo_etapa']){
                                        case 1: // ELIMINAÇÃO SIMPLES
                                            ?>
                                                <img src="img/icones/eliminacao-simples.png">
                                            <?php
                                            break;
                                        case 2: // GRUPOS PONTOS CORRIDOS
                                            ?>
                                                <img src="img/icones/grupo-pontos-corridos.png">
                                            <?php
                                            break;
                                        case 3: // ELIMINAÇÃO DUPLA
                                            ?>
                                                <img src="img/icones/eliminacao-dupla.png">
                                            <?php
                                            break;
                                    }
                                ?>
                                </div>
                                <div class="col-12 col-md-12 centralizar">                                
                                        <h3><?php echo $etapa['cod_etapa'].". ".$etapa['nome']; ?></h3> 
                                </div>
                            </a> 
                        </div>
                    </div>
                <?php
                    echo "";
                }
            ?>
            </div>        
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php echo $js; ?>jquery.js"></script>
        <script src="<?php echo $js; ?>bootstrap.js"></script>
        <script>
            jQuery(function($){
                $(".tabelas").addClass("ativo");
            });
        </script>
        
    </body>
</html>